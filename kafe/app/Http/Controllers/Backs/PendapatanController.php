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

class PendapatanController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::orderBy('nama', 'ASC')->filter(request(['startdate', 'enddate']))->paginate(1500);
        return view('dashboard.pendapatans', [
            'orders'    => $orders,
        ]);
    }

    public function detail()
    {

        $orders = Order::orderBy('nama', 'ASC')->filter(request(['startdate', 'enddate']))->paginate(1500);
        return view('dashboard.detailpendapatans', [
            'orders'    => $orders,
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
