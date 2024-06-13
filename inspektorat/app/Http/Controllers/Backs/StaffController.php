<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function index(Request $request)
    {

            $staffs    = Staff::latest()->paginate(100);

        $title_bar = 'STAFF';

        return view('dashboard.staffs', compact('staffs', 'title_bar'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createstaffs', [
            'title_bar' => 'Staff Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'min:3', 'max:255'],
            'nip' => ['min:3', 'max:255'],
            'status' => ['required'],
            'jabatan' => ['min:3', 'max:255'],
            'kualifikasi' => ['min:3', 'max:255'],
            // 'unduh' => ['file', 'max:10048']
            'foto' => ['image', 'file', 'max:2048']
        ]);

        // if ($request->hasFile('unduh')) {
        //     $data['unduh'] = $request->unduh->store('uploads');
        // }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->foto->store('uploads');
        }


        Staff::create($data);

        return redirect('/dashboard/staffs')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return response()->json($staff);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        return view('dashboard.editstaffs', [
            'title_bar' => 'Perbarui Staff',
            'staff'    => $staff
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'nama' => ['required', 'min:3', 'max:255'],
            'nip' => ['min:3', 'max:255'],
            'status' => ['required'],
            'jabatan' => ['min:3', 'max:255'],
            'kualifikasi' => ['min:3', 'max:255'],
            // 'unduh' => ['file', 'max:10048']
            'foto' => ['image', 'file', 'max:2048']
        ]);

        // if ($request->hasFile('unduh')) {
        //     $data['unduh'] = $request->unduh->store('uploads');
        // }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->foto->store('uploads');
        }
        Staff::where('id', $staff->id)->update($data);
        return redirect('/dashboard/staffs')->with('success', 'Data Berhasil Diperbarui');
    }




    public function destroy(Staff $staff)
    {
        // if ($slider->desktop) {
        //     Storage::delete($slider->desktop);
        // }
        // if ($slider->mobile) {
        //     Storage::delete($slider->mobile);
        // }
        Staff::destroy($staff->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}