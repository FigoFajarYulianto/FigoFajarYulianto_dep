<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use App\Models\Terpilih;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $title_bar = 'Terpilih';
        $terpilihs = Terpilih::all()->sortByDesc('nilai');
        return view('admin.riwayat', compact('terpilihs', 'title_bar'));
    }

    public function create()
    {
        return view('admin.createriwayat', [
            'title_bar' => 'Terpilih Baru'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'unique:terpilihs', 'min:3', 'max:255'],
            'tahun' => [''],
            'nilai' => [''],

        ]);

        Terpilih::create($data);

        return redirect('/admin/riwayats')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(Terpilih $terpilih)
    {
        return response()->json($terpilih);
    }

    public function edit(Terpilih $terpilih)
    {
        return view('admin.editriwayat', [
            'title_bar' => 'Perbarui Terpilih',
            'terpilih'    => $terpilih
        ]);
    }


    public function update(Request $request, Terpilih $terpilih)
    {
        $data = $request->validate([
            'nama' => ['required', 'min:3', 'max:255'],
            'tahun' => [''],
            'nilai' => [''],

        ]);



        Terpilih::where('id', $terpilih->id)->update($data);
        return redirect('/admin/riwayats')->with('success', 'Data Berhasil Diperbarui');
    }

    public function destroy(Terpilih $terpilih)
    {

        Terpilih::destroy($terpilih->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
