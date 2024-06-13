<?php

namespace App\Http\Controllers\Api;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::with('desas')->orderBy('name', 'ASC')->get();
        return response()->json($kecamatan);
    }
}
