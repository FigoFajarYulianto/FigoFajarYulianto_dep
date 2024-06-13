<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Categorystatus;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CategoryStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
            $status    = Categorystatus::latest()->paginate(100);

        $title_bar = 'Status Pengaduan';
        return view('dashboard.categoriesstatus', compact('status', 'title_bar'));

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
            'name' => ['required', 'min:3', 'max:255', 'unique:categorystatuses']
        ]);
        Categorystatus::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorystatus  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Categorystatus $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorystatus  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorystatus $category)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Categorystatus  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $getcategory = Categorystatus::where('id', $id)->first();

        $data = $request->validate([
            'name' => $request->name !== $getcategory->name ? ['required', 'min:3', 'max:255', 'unique:categorystatuses'] : ['required', 'min:3', 'max:255']
        ]);

        if ($request->name != $getcategory->name) {
        }
        Categorystatus::where('id', $getcategory->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorystatus  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorystatus $category)
    {

        Categorystatus::destroy($category->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    // public function show($id)
    // {
    //     $getcategory = Categorysahabat::where('id', $id)->first();
    //     return response()->json($getcategory);
    // }
}
