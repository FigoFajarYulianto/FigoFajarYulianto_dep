<?php

namespace App\Http\Controllers\Api;

use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubdistrictController extends Controller
{
    public function index($idkecamatan)
    {
        $desa = Desa::with('kecamatan')->where('kecamatan_id', $idkecamatan)->orderBy('name', 'ASC')->get();
        return response()->json($desa);
    }
}