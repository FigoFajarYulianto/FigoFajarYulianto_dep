<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubdistrictController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.subdistricts', [
            'title_bar'     => 'Data Kabupaten',
            'subdistricts'  => Subdistrict::with('province', 'district')->withCount(['campaigns'])->latest()->paginate(100),
            'roles'         => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'unique:provinces'],
            'province_id'  => ['required'],
            'district_id'  => ['required']
        ]);

        Subdistrict::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Subdistrict $subdistrict)
    {
        return response()->json($subdistrict);
    }

    public function update(Request $request, Subdistrict $subdistrict)
    {
        $data = $request->validate([
            'name'      => $request->name !== $subdistrict->name ? ['required', 'unique:provinces'] : ['required'],
            'province_id'  => ['required'],
            'district_id'  => ['required']
        ]);

        Subdistrict::where('id', $subdistrict->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Subdistrict $subdistrict)
    {
        if ($subdistrict->users->count() === 0) {
            Subdistrict::destroy($subdistrict->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }
}
