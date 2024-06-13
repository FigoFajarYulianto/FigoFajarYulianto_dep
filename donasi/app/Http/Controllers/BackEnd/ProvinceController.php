<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.provinces', [
            'title_bar' => 'Data Provinsi',
            'provinces'     => Province::withCount(['districts'])->latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'unique:provinces'],
        ]);

        Province::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Province $province)
    {
        return response()->json($province);
    }

    public function update(Request $request, Province $province)
    {
        $data = $request->validate([
            'name'      => $request->name !== $province->name ? ['required', 'unique:provinces'] : ['required'],
        ]);

        Province::where('id', $province->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Province $province)
    {
        if ($province->users->count() === 0) {
            Province::destroy($province->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }
}
