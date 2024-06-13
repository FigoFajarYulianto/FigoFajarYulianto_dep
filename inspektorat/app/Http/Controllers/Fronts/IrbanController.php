<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;
use App\Models\Irban;
use Illuminate\Http\Request;

class IrbanController extends Controller
{
    public function index()
    {
        if (request('id')) {
            $irban = Irban::with('irbanwilayah')->where('id', request('id'))->first();
        } else {
            $irban = Irban::with('irbanwilayah')->where('id', 1)->first();
        }

        return view('fronts.irban', [
            'title_bar' => 'WILAYAH IRBAN',
            'irban'     => $irban
        ]);
    }
}
