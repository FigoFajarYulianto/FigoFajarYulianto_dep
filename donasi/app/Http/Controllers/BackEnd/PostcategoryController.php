<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Postcategory;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Http\Controllers\Controller;

class PostcategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.postcategories', [
            'title_bar'     => 'Kategori Berita',
            'categories'    => Postcategory::withCount('posts')->latest()->paginate(100),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:categories']
        ]);
        $data['slug'] = SlugService::createSlug(Postcategory::class, 'slug', $request->name);
        Postcategory::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Postcategory $postcategory)
    {
        return response()->json($postcategory);
    }

    public function update(Request $request, Postcategory $postcategory)
    {
        $data = $request->validate([
            'name' => $request->name !== $postcategory->name ? ['required', 'unique:categories'] : ['required']
        ]);

        if ($request->name != $postcategory->name) {
            $data['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        }
        Postcategory::where('id', $postcategory->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Postcategory $postcategory)
    {
        if ($postcategory->posts->count()) {
            abort(403);
        }

        Postcategory::destroy($postcategory->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
