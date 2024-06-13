<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Payment;
use App\Models\Statusorder;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DetailOrderController extends Controller
{
    public function detail(Order $orders)
    {

        return view('fronts.detailorder', [
            'orderitem'    => Orderitem::latest()->get()->where('order_id', $orders->id),
            'status'    => Statusorder::orderBy('nama', 'ASC')->get(),
            'order'    => $orders

        ]);
    }
}
