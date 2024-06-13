<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.districts', [
            'title_bar' => 'Data Kabupaten',
            'districts'     => District::with('province')->withCount(['subdistricts'])->latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'unique:provinces'],
            'province_id'  => ['required']
        ]);

        District::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(District $district)
    {
        return response()->json($district);
    }

    public function update(Request $request, District $district)
    {
        $data = $request->validate([
            'name'      => $request->name !== $district->name ? ['required', 'unique:provinces'] : ['required'],
            'province_id'  => ['required']
        ]);

        District::where('id', $district->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(District $district)
    {
        if ($district->users->count() === 0) {
            District::destroy($district->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }
}
