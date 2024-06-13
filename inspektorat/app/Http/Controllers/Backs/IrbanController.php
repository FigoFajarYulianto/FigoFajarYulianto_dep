<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;

use App\Models\Irban;
use Illuminate\Http\Request;

class IrbanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.irbans', [
            'title_bar' => 'IRBAN',
            'irbans'    => Irban::latest()->paginate(100)
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
            'nama' => 'required:unique:irbans',
        ]);

        $data['keterangan'] = $request->keterangan;
        $data['inspektur'] = $request->inspektur;
        $data['nip'] = $request->nip;

        Irban::create($data);
        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Irban  $irban
     * @return \Illuminate\Http\Response
     */
    public function show(Irban $irban)
    {
        return response()->json($irban);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Irban  $irban
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Irban $irban)
    {
        $data = $request->validate([
            'nama' => $request->nama !== $irban->nama ? 'required:unique:irbans' : 'required',
        ]);

        $data['keterangan'] = $request->keterangan;
        $data['inspektur'] = $request->inspektur;
        $data['nip'] = $request->nip;

        Irban::where('id', $irban->id)->update($data);
        return back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Irban  $irban
     * @return \Illuminate\Http\Response
     */
    public function destroy(Irban $irban)
    {
        Irban::destroy($irban->id);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
