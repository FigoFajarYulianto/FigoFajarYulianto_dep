<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function index(Request $request)
    {

        $staffs    = Staff::where('status', 1)->latest()->paginate(100);

        $title_bar = 'STAFF';

        return view('fronts.staff', compact('staffs', 'title_bar'));
    }

    public function detail(Staff $staff)
    {

        return view('fronts.detailstaff', [
            'title_bar' => 'Staff',
            'staff'    => $staff,
        ]);
    }
}
