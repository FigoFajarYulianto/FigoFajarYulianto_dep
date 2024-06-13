<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Irbanwilayah;
use Illuminate\Http\Request;

class IrbanwilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.irbanwilayahs', [
            'title_bar' => 'Wilayah IRBAN',
            'irbanwilayahs' => Irbanwilayah::with('irban')->latest()->paginate(100)
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
            'nama'  => 'required',
            'irban_id'  => 'required',
        ]);

        Irbanwilayah::create($data);
        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Irbanwilayah  $irbanwilayah
     * @return \Illuminate\Http\Response
     */
    public function show(Irbanwilayah $irbanwilayah)
    {
        return response()->json($irbanwilayah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Irbanwilayah  $irbanwilayah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Irbanwilayah $irbanwilayah)
    {
        $data = $request->validate([
            'nama'  => 'required',
            'irban_id'  => 'required',
        ]);

        Irbanwilayah::where('id', $irbanwilayah->id)->update($data);
        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Irbanwilayah  $irbanwilayah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Irbanwilayah $irbanwilayah)
    {
        Irbanwilayah::destroy($irbanwilayah->id);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
