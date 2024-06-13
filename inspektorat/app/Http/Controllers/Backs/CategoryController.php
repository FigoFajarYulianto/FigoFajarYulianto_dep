<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories    = Category::withCount('posts')->latest()->Paginate(100);
        $programs = Program::all();
        $title_bar = 'Kategori Berita';

        return view('dashboard.categories', compact('categories', 'programs', 'title_bar'));

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
    public function store(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:categories'],
        ]);
        $data['program_id'] = $request->program_id;
        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        Category::create($data);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => $request->name !== $category->name ? ['required', 'min:3', 'max:255', 'unique:categories'] : ['required', 'min:3', 'max:255'],
            'program_id' => $request->program_id !== $category->program_id ? [''] : ['']
        ]);

        if ($request->name != $category->name) {
            $data['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        }

        Category::where('id', $category->id)->update($data);
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->posts->count()) {
            abort(403);
        }

        Category::destroy($category->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
