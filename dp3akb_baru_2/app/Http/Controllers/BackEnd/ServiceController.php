<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Service;
use App\Models\Postcategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->has('search')) {
            $services    = Service::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $services    = Service::latest()->Paginate(10);
        }

        $title_bar = 'Layanan';

        return view('dashboard.services', compact('services', 'title_bar'));


        // return view('dashboard.services', [
        //     'title_bar' => 'Layanan',
        //     'services'  => Service::latest()->get()
        // ]);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createservice', [
            'title_bar'     => 'Layanan Baru',
            'categories'    => Postcategory::orderBy('name', 'ASC')->get(),
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
            'name'              => ['required', 'min:4', 'max:255', 'unique:services'],
            'image'             => ['image', 'file', 'max:2048'],
            'postcategory_id'   => ['required']
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads');
        }
        $data['slug'] = SlugService::createSlug(Service::class, 'slug', $request->name);
        // $data['link'] = $request->link;
        $data['description'] = $request->description;
        Service::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return response()->json($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('dashboard.editservice', [
            'title_bar'     => 'Perbarui Layanan',
            'service'       => $service,
            'categories'    => Postcategory::orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'              => $request->name !== $service->name ? ['required', 'min:4', 'max:255', 'unique:services'] : ['required', 'min:4', 'max:255'],
            'image'             => ['image', 'file', 'max:2048'],
            'postcategory_id'   => ['required']
        ]);
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete($service->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['slug'] = $request->name !== $service->name ? SlugService::createSlug(Service::class, 'slug', $request->name) : $service->slug;
        $data['description'] = $request->description;
        Service::where('id', $service->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil Diperbarui.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // if ($service->image) {
        //     Storage::delete($service->image);
        // }
        Service::destroy($service->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
