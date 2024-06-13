<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Payment;
use App\Models\Statusorder;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OrderkasirController extends Controller
{
    public function index(Request $request)
    {

        // if ($request->has('search')) {
        //     $orders    = Order::where('nama', 'LIKE', '%' . $request->search . '%')->Paginate(50);
        // } else {
        //     $orders    = Order::orderBy('nama', 'ASC')->Paginate(50);
        // }

        // return view('dashboard.orders', compact('orders'));


        $orders = Order::where('status_id', 2)->orderBy('id', 'DESC')->filter(request(['faktur', 'meja', 'status_id', 'startdate', 'enddate']))->paginate(1500);
        return view('dashboard.orderskasir', [
            'orders'    => $orders,
        ]);
    }



    // public function advance(Request $request)
    // {
    //     $orders    = Order::latest();
    //     if ($request->faktur) {
    //         $orders = $orders->where('faktur', 'LIKE', "%" . $request->faktur . "%");
    //     }

    //     if ($request->meja) {
    //         $orders = $orders->where('meja', 'LIKE', "%" . $request->meja . "%");
    //     }

    //     if ($request->status_id) {
    //         $orders = $orders->where('status_id', 'LIKE', "%" . $request->status_id . "%");
    //     }

    //     $orders = $orders->paginate(50);
    //     return view('dashboard.orders', compact('orders'));
    // }


    // return view('dashboard.menus', [
    //     'title_bar' => 'Manajemen Menu',
    //     'menus'     => Menu::orderBy('sort', 'ASC')->get(),
    //     'mainMenus' => Menu::where('child', NULL)->get()


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createorders', [
            'title_bar' => 'Data Baru',
            'orderitem'    => Orderitem::latest()->get(),
            'order'    => Order::orderBy('nama', 'ASC')->get(),
            'payment'    => Payment::latest()->get(),
            'status'    => Statusorder::orderBy('nama', 'ASC')->get()



        ]);
    }

    public function edit(Order $order)
    {

        return view('dashboard.editorderskasir', [
            'title_bar' => 'Perbarui Data',
            'orderitem'    => Orderitem::latest()->get()->where('order_id', $order->id),
            'order'    => Order::orderBy('nama', 'ASC')->get(),
            'payment'    => Payment::latest()->get(),
            'statusorder'    => Statusorder::orderBy('nama', 'ASC')->get(),
            'order'    => $order
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status_id'  => [''],

        ]);

        Order::where('id', $order->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }







    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Menu  $menu
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Menu $menu)
    // {
    //     return response()->json($menu);
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Menu  $menu
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Menu $menu)
    // {
    //     return view('dashboard.editmenu', [
    //         'title_bar' => 'Perbarui Menu',
    //         'menu'    => $menu
    //     ]);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Menu  $menu
    //  * @return \Illuminate\Http\Response
    //  */


    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Menu  $menu
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        Orderitem::where('order_id', $order->id)->delete();
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
