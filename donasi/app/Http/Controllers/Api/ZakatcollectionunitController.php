<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subdistrict;
use App\Models\Zakatcollectionunit;
use Illuminate\Http\Request;

class ZakatcollectionunitController extends Controller
{
    public function show(Zakatcollectionunit $zakatcollectionunit)
    {
        return response()->json($zakatcollectionunit);
    }
}
