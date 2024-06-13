<?php

namespace App\Http\Controllers\Backs;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kecamatans', [
            'title_bar'     => 'Kecamatan',
            'kecamatans'    => Kecamatan::withCount(['desas'])->latest()->paginate(50)
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
            'name' => ['required', 'min:1', 'max:255', 'unique:kecamatans']
        ]);
        Kecamatan::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        return response()->json($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Category  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $data = $request->validate([
            'name' => $request->name !== $kecamatan->name ? ['required', 'min:1', 'max:255', 'unique:kecamatans'] : ['required', 'min:1', 'max:255']
        ]);

        Kecamatan::where('id', $kecamatan->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        if ($kecamatan->desas->count()) {
            abort(403);
        }

        Kecamatan::destroy($kecamatan->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}