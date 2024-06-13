<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Province;
use App\Models\Jenisdana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dana;
use App\Models\Danafund;
use App\Models\Jenisdanafund;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DanaController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.danas', [
            'title_bar' => 'Dana',
            'danas'     => Dana::with('danacategory')->orderBy('name', 'ASC')->latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => ['required'],
            'code'              => ['required'],
            'danacategory_id'   => ['required']
        ]);

        $data['description'] = $request->description;
        $data['slug'] = SlugService::createSlug(Dana::class, 'slug', $request->name);
        $dana = Dana::create($data);

        $danafund['dana_id'] = $dana->id;
        $danafund['danacategory_id'] = $request->danacategory_id;
        Danafund::create($danafund);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Dana $dana)
    {
        return response()->json($dana);
    }

    public function update(Request $request, Dana $dana)
    {
        $data = $request->validate([
            'name'              => ['required'],
            'code'              => ['required'],
            'danacategory_id'   => ['required']
        ]);

        $data['description'] = $request->description;
        $data['slug'] = $request->name !== $dana->name ? SlugService::createSlug(Dana::class, 'slug', $request->name) : $dana->slug;
        Dana::where('id', $dana->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil diperbarui!</div>');
    }

    public function destroy(Dana $dana)
    {
        Dana::destroy($dana->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
