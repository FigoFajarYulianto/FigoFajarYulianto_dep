<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Subdistrict;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function district($id)
    {
        // return response()->json($iddistrict);
        $district = District::with('province')->where('province_id', $id)->orderBy('name', 'ASC')->get();
        return response()->json($district);
    }

    public function subdistrict($id)
    {
        // return response()->json($iddistrict);
        $subdistrict = Subdistrict::with('district')->where('district_id', $id)->orderBy('name', 'ASC')->get();
        return response()->json($subdistrict);
    }
}
