<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Models\Servicecategory;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServicecategoryController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.servicecategories', [
            'title_bar'             => 'Manajemen Layanan Kategori',
            'servicecategories'     => Servicecategory::with('service')->orderBy('id', 'ASC')->get(),
            'services'              => Service::get(),
            'roles'                 => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required'],
            'service_id'    => ['required']
        ]);
        $data['image'] = $request->hasFile('image') ? $request->image->store('uploads') : NULL;
        $data['slug'] = SlugService::createSlug(Servicecategory::class, 'slug', $request->name);

        Servicecategory::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Servicecategory $servicecategory)
    {
        return response()->json($servicecategory);
    }

    public function update(Request $request, Servicecategory $servicecategory)
    {
        $data = $request->validate([
            'name'  => ($request->name !== $servicecategory->name ? ['required'] : ['required'])
        ]);

        $data['slug'] = $request->name !== $servicecategory->name ? SlugService::createSlug(Servicecategory::class, 'slug', $request->name) : $servicecategory->slug;
        if ($request->hasFile('image')) {
            if ($servicecategory->image) {
                Storage::delete($servicecategory->image);
            }
            $data['image'] = $request->image->store('uploads');
        }

        Servicecategory::where('id', $servicecategory->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Servicecategory $servicecategory)
    {
        Servicecategory::destroy($servicecategory->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
