<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $orderitems    = Orderitem::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $orderitems    = Orderitem::latest()->Paginate(10);
        }

        $title_bar = 'Item Makanan';



        return view('dashboard.orderitems', compact('orderitems', 'title_bar'));

        // return view('dashboard.menus', [
        //     'title_bar' => 'Manajemen Menu',
        //     'menus'     => Menu::orderBy('sort', 'ASC')->get(),
        //     'mainMenus' => Menu::where('child', NULL)->get()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('dashboard.buatorders', [
            'title_bar' => 'Order Item Baru',
            'menus'    => Menu::orderBy('nama', 'ASC')->get(),
            'order'    => Order::orderBy('nama', 'ASC')->get(),
            'order'    => $order

        ]);
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
            'order_id'       => 'required',
            'menu_id'    => 'required',
            'harga'          => 'required',
            'diskon'          => 'required',
            'qty'          => 'required',
            'keterangan'          => ''
        ]);

        $order['order_id'] = $request->order_id;
        $order['menu_id'] = $request->menu_id;
        $order['harga'] = $request->harga;
        $order['diskon'] = $request->diskon;
        $order['qty'] = $request->qty;
        $order['keterangan'] = $request->keterangan;

        $cekmenu = Orderitem::where('order_id', $request->order_id)
            ->where('menu_id', $request->menu_id)->first();
        if ($cekmenu) {
            $queryOrder = Orderitem::where('id', $cekmenu->id)->update($order);
        } else {
            $queryOrder = Orderitem::create($order);
        }

        if ($queryOrder) {
            $items = Orderitem::where('order_id', $request->order_id)->get();
            $total = 0;
            $totaldiskon = 0;
            $grandtotal  = 0;
            $seluruhtotal  = 0;
            foreach ($items as $item) {
                $total += $item->harga * $item->qty;
                $totaldiskon += $item->diskon * $item->qty;
                $grandtotal += ($item->harga * $item->qty) - ($item->diskon * $item->qty);
            }
            Order::where('id', $request->order_id)->update([
                'total' => $total,
                'total_diskon' => $totaldiskon,
                'total_order' => $grandtotal,

            ]);
        }

        return redirect('/dashboard/orders')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orderitem  $orderitem
     * @return \Illuminate\Http\Response
     */
    public function show(Orderitem $orderitem)
    {
        return response()->json($orderitem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orderitem  $orderitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Orderitem $orderitem)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orderitem  $orderitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $orderitem = Orderitem::where('id', $id)->first();

        $data = $request->validate([
            'qty' => $request->qty !== $orderitem->qty ? ['required'] : ['required']
        ]);

        if ($request->qty != $orderitem->qty) {
        }

        Orderitem::where('id', $orderitem->id)->update($data);

        $items = Orderitem::where('order_id', $orderitem->order_id)->get();
        $total = 0;
        $totaldiskon = 0;
        $grandtotal  = 0;
        foreach ($items as $item) {
            $total += $item->harga * $item->qty;
            $totaldiskon += $item->diskon * $item->qty;
            $grandtotal += ($item->harga * $item->qty) - ($item->diskon * $item->qty);
        }

        Order::where('id', $orderitem->order_id)->update([
            'total' => $total,
            'total_diskon' => $totaldiskon,
            'total_order' => $grandtotal,
        ]);


        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orderitem  $orderitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orderitem $orderitem)
    {
        Orderitem::destroy($orderitem->id);

        $items = Orderitem::where('order_id', $orderitem->order_id)->get();
        $total = 0;
        $totaldiskon = 0;
        $grandtotal  = 0;
        foreach ($items as $item) {
            $total += $item->harga * $item->qty;
            $totaldiskon += $item->diskon * $item->qty;
            $grandtotal += ($item->harga * $item->qty) - ($item->diskon * $item->qty);
        }

        Order::where('id', $orderitem->order_id)->update([
            'total' => $total,
            'total_diskon' => $totaldiskon,
            'total_order' => $grandtotal,
        ]);

        return back()->with('success', 'Data Berhasil Dihapus');
    }
}