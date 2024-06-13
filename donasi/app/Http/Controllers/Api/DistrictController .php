<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index($id)
    {
        return response()->json($id);

        $province = District::with('province')->where('province_id', $id)->orderBy('name', 'ASC')->get();
    }
}
