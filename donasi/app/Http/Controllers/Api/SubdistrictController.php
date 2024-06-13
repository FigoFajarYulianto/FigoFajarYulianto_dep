<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class SubdistrictController extends Controller
{
    public function index($iddistrict)
    {
        $district = Subdistrict::with('district')->where('district_id', $iddistrict)->orderBy('name', 'ASC')->get();
        return response()->json($district);
    }
}
