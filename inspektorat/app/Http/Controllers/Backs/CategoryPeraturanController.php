<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Categoriperaturan;

use Illuminate\Http\Request;

class CategoryPeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
            $categoriperaturans    = Categoriperaturan::latest()->paginate(100);

        $title_bar = 'Kategori Peraturan';

        return view('dashboard.categoriperaturans', compact('categoriperaturans', 'title_bar'));

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
            'name' => ['required', 'min:3', 'max:255', 'unique:categoriperaturans']
        ]);
        Categoriperaturan::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoriperaturan  $categoriperaturan
     * @return \Illuminate\Http\Response
     */
    public function show(Categoriperaturan $categoriperaturan)
    {
        return response()->json($categoriperaturan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoriperaturan  $categoriperaturan
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoriperaturan $categoriperaturan)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Categoriperaturan  $categoriperaturan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $categoriperaturan = Categoriperaturan::where('id', $id)->first();

        $data = $request->validate([
            'name' => $request->name !== $categoriperaturan->name ? ['required', 'min:3', 'max:255', 'unique:categoriperaturans'] : ['required', 'min:3', 'max:255']
        ]);

        if ($request->name != $categoriperaturan->name) {
        }
        Categoriperaturan::where('id', $categoriperaturan->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoriperaturan  $categoriperaturan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoriperaturan $categoriperaturan)
    {

        Categoriperaturan::destroy($categoriperaturan->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function show($id)
    // {
    //     $getcategory = Categorysahabat::where('id', $id)->first();
    //     return response()->json($getcategory);
    // }
}
