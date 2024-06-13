<?php

namespace App\Http\Controllers\Fronts;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Carbon;
use App\Helpers\WhatsApp;
use App\Models\Walog;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $category = Category::all();
        $menus = Menu::latest()->get()->where('aktif', 1);


        return view('fronts.home', [
            'title_bar' => $setting->name,
            'category'   => $category,
            'setting'   => $setting,
            'menus'   => $menus,
        ]);
    }

    public function search(Request $request)
    {
        $setting = Setting::where('id', 1)->first();
        $category = Category::all();
        $menus = Menu::latest()->where('aktif', 1);
        if ($request->category_id) {
            $menus = $menus->where('category_id', 'LIKE', "%" . $request->category_id . "%");
        }

        $menus = $menus->paginate(100);

        return view('fronts.home', compact('setting', 'category', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'faktur'       => 'required',
            'nama'    => '',
            'meja'          => 'required'
        ]);

        $order['faktur'] = $request->faktur;
        $order['nama'] = $request->nama;
        $order['whatsapp'] = $request->whatsapp;
        $order['meja'] = $request->meja;
        $order['keterangan'] = $request->keterangan;
        $order['total'] = $request->grandtotal;
        $order['total_order'] = $request->grandtotal;
        $order['status_id'] = '1';



        $queryOrder = Order::create($order);
        if ($queryOrder) {
            // insert item penjualan
            foreach ($request->data as $row) {
                $orders_items = [
                    'order_id'  => $queryOrder->id,
                    'menu_id'  =>  $row['id'],
                    'qty'     => $row['quantity'],
                    'harga' => $row['price']
                ];
                $queryOrderItem = Orderitem::create($orders_items);
            }
        }

        $LaporanWaOrder = Order::firstWhere('id', $queryOrder->id);

        // kirim wa ke Pengguna
        $pesanKeUser = 'Selamat order telah kami terima, segera akan kami proses, silahkan lakukan pembayaran di kasir, berikut detail order anda :
' . url('/detail/orders/' . $LaporanWaOrder->id . '/detail') . '';


        if ($LaporanWaOrder->whatsapp) {
            $sendwa = WhatsApp::sendmessage($LaporanWaOrder->whatsapp, $pesanKeUser);
            $walog = [
                'name'      => $LaporanWaOrder->nama,
                'number'    => $LaporanWaOrder->whatsapp,
                'message'   => $pesanKeUser
            ];

            if ($sendwa) {
                $walog['status'] = true;
                Walog::create($walog);
            } else {
                $walog['status'] = false;
                Walog::create($walog);
            }
        }

        return response()->json(['status' => true, 'msg' => 'Berhasil disimpan!']);
    }

    public function createinv(Request $request)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y-m-d');
        return response()->json(['number' => Order::generateInv($tanggal)]);
    }
}
