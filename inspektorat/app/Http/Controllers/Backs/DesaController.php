<?php

namespace App\Http\Controllers\Backs;

use App\Models\Desa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.desas', [
            'title_bar' => 'Desa/Kelurahan',
            'desas'     => Desa::with('kecamatan')->latest()->paginate(50)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'min:1', 'max:255'],
            'kecamatan_id'  => ['required']
        ]);
        Desa::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        return response()->json($desa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Category  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $data = $request->validate([
            'name' => ['required', 'min:1', 'max:255'],
            'kecamatan_id'  => ['required']
        ]);

        Desa::where('id', $desa->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        if ($desa->officers->count() || $desa->reports->count()) {
            abort(403);
        }

        Desa::destroy($desa->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}