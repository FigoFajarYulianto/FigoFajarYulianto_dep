<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Categoryconsultation;
use Illuminate\Http\Request;

class CategoryConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('search')) {
            $categoryconsultations    = Categoryconsultation::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $categoryconsultations    = Categoryconsultation::latest()->Paginate(10);
        }

        return view('dashboard.categoryconsultations', compact('categoryconsultations'));

        // return view('dashboard.categories', [
        //     'title_bar'     => 'Kategori',
        //     // 'categories'    => Category::withCount('posts')->latest()->get()

        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
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
            'nama' => ['required', 'min:3', 'max:255']
        ]);
        Categoryconsultation::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statusconsultation  $categoryconsultation
     * @return \Illuminate\Http\Response
     */
    public function show(Categoryconsultation $categoryconsultation)
    {
        return response()->json($categoryconsultation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoryconsultation  $categoryconsultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoryconsultation $categoryconsultation)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Categoryconsultation  $categoryconsultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $categoryconsultation = Categoryconsultation::where('id', $id)->first();

        $data = $request->validate([
            'nama' => $request->nama !== $categoryconsultation->nama ? ['required', 'min:3', 'max:255',] : ['required', 'min:3', 'max:255']
        ]);

        if ($request->nama != $categoryconsultation->nama) {
        }
        Categoryconsultation::where('id', $categoryconsultation->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorystatus  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categoryconsultation = Categoryconsultation::where('id', $id)->first();

        Categoryconsultation::destroy($categoryconsultation->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function show($id)
    // {
    //     $getcategory = Categorysahabat::where('id', $id)->first();
    //     return response()->json($getcategory);
    // }
}