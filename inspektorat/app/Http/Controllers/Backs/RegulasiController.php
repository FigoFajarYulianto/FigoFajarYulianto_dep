<?php

namespace App\Http\Controllers\Backs;

use App\Models\Regulasi;
use App\Http\Controllers\Controller;
use App\Models\Categoriperaturan;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $regulasis    = Regulasi::latest()->paginate(100);

        $title_bar = 'Regulasi';

        return view('dashboard.regulasis', compact('regulasis', 'title_bar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createregulasis', [
            'title_bar' => 'Regulasi Baru',
            'categoriperaturan'    => Categoriperaturan::orderBy('name', 'ASC')->get(),
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
            'judul' => ['required', 'unique:regulasis', 'min:3', 'max:255'],
            'peraturan_id' => [''],
            'keterangan' => [''],
            // 'unduh' => ['file', 'max:10048']
            'unduh' => ['file', 'max:10048']
        ]);

        // if ($request->hasFile('unduh')) {
        //     $data['unduh'] = $request->unduh->store('uploads');
        // }

        if ($request->hasFile('unduh')) {
            $data['unduh'] = $request->unduh->store('uploads');
        }


        Regulasi::create($data);

        return redirect('/dashboard/regulasis')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $regulasi
     * @return \Illuminate\Http\Response
     */
    public function show(Regulasi $regulasi)
    {
        return response()->json($regulasi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regulasi  $regulasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Regulasi $regulasi)
    {
        return view('dashboard.editregulasis', [
            'title_bar' => 'Perbarui Regulasi',
            'regulasi'    => $regulasi,
            'categoriperaturan'    => Categoriperaturan::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Regulasi  $regulasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regulasi $regulasi)
    {
        $data = $request->validate([
            'judul' => $request->judul !== $regulasi->judul ? ['required', 'unique:regulasis', 'min:3', 'max:255'] : ['required', 'min:3', 'max:255'],
            'peraturan_id' => [''],
            'keterangan' => [''],
            'unduh' => ['file', 'max:10048']
        ]);

        if ($request->hasFile('unduh')) {
            $data['unduh'] = $request->unduh->store('uploads');
        }


        Regulasi::where('id', $regulasi->id)->update($data);
        return redirect('/dashboard/regulasis')->with('success', 'Data Berhasil Diperbarui');
    }




    public function destroy(Regulasi $regulasi)
    {
        // if ($slider->desktop) {
        //     Storage::delete($slider->desktop);
        // }
        // if ($slider->mobile) {
        //     Storage::delete($slider->mobile);
        // }
        Regulasi::destroy($regulasi->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}