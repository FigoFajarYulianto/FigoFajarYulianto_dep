<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Galery;

class GaleryController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.galeries', [
            'title_bar' => 'Data Galeri',
            'galeries'  => Galery::latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'     => ['required'],
            'path'      => ['required'],
        ]);

        Galery::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Galery $galery)
    {
        return response()->json($galery);
    }

    public function update(Request $request, Galery $galery)
    {
        $data = $request->validate([
            'type'     => ['required'],
            'path'      => ['required'],
        ]);

        Galery::where('id', $galery->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Galery $galery)
    {
        if ($galery->users->count() === 0) {
            Galery::destroy($galery->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }
}
