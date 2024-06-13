<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Kandidat;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title_bar = 'Kandidat';
        $kandidats = Kandidat::get();
        return view('admin.kandidat', compact('kandidats', 'title_bar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createkandidat', [
            'title_bar' => 'Kandidat Baru'
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
        $validation = \Validator::make($request->all(), [
            "nama" => "required|min:3|max:30",
            "telp" => "required|digits_between:9,13",
            "jk" => "",
            "alamat" => "",
            "tanggal_lahir" => ""
        ])->validate();
        $new_kandidat = new \App\Models\Kandidat;
        $new_kandidat->nama = $request->get('nama');
        $new_kandidat->jk = $request->get('jk');
        $new_kandidat->alamat = $request->get('alamat');
        $new_kandidat->tanggal_lahir = $request->get('tanggal_lahir');
        $new_kandidat->telp = $request->get('telp');
        if ($request->file('foto')) {
            $file = $request->file('foto')->store('gambars', 'public');
            $new_kandidat->foto = $file;
        }
        $new_kandidat->save();
        // Alert::success('BERHASIL', 'Data Berhasil Disimpan');
        return redirect('/admin/kandidats')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kandidat = \App\Models\Kandidat::findOrFail($id);
        return view('kandidat.show', ['kandidat' => $kandidat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        return view('admin.editkandidat', compact('kandidat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            "nama" => "required|min:3|max:30",
            "telp" => "",
            "jk" => "",
            "alamat" => "",
            "tanggal_lahir" => ""
        ])->validate();

        $ubah_kandidat = \App\Models\Kandidat::findOrFail($id);
        $ubah_kandidat->nama = $request->get('nama');
        $ubah_kandidat->jk = $request->get('jk');
        $ubah_kandidat->alamat = $request->get('alamat');
        $ubah_kandidat->tanggal_lahir = $request->get('tanggal_lahir');
        $ubah_kandidat->telp = $request->get('telp');
        if ($request->file('foto')) {
            if ($ubah_kandidat->foto && file_exists(storage_path('app/public/' . $ubah_kandidat->foto))) {
                Storage::delete('public/' . $ubah_kandidat->foto);
            }
            $file = $request->file('foto')->store('gambars', 'public');
            $ubah_kandidat->foto = $file;
        }
        $ubah_kandidat->save();
        // Alert::success('BERHASIL', 'Data Berhasil di Ubah');
        return redirect('/admin/kandidats')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kandidat $kandidat)
    {
        Kandidat::destroy($kandidat->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
