<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postcategory;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.categories', [
            'title_bar'     => 'Data Kategori Kampanye',
            'categories'     => Postcategory::latest()->paginate(100),
            'roles'         => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|unique:postcategories',
        ]);

        $data['slug'] = SlugService::createSlug(Postcategory::class, 'slug', $request->name);
        dd($data);
        Postcategory::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Postcategory $postcategory)
    {
        return response()->json($postcategory);
    }

    public function update(Request $request, Postcategory $postcategory)
    {
        $data = $request->validate([
            'name'      => $request->name !== $postcategory->name ? ['required', 'unique:postcategories'] : ['required'],
        ]);

        $data['slug'] = SlugService::createSlug(Postcategory::class, 'slug', $request->name);
        Postcategory::where('id', $postcategory->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Postcategory $postcategory)
    {
        Postcategory::destroy($postcategory->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
