<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.categories', [
            'title_bar' => 'Data Kategori Kampanye',
            'categories'     => Category::latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|unique:categories',
        ]);

        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        Category::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'      => $request->name !== $category->name ? ['required', 'unique:categories'] : ['required'],
        ]);

        $data['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        Category::where('id', $category->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
