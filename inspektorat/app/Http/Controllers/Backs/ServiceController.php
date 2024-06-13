<?php

namespace App\Http\Controllers\Backs;

use App\Models\Service;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $services    = Service::latest()->paginate(100);

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
            'title_bar' => 'Layanan Baru'
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
            'name'          => ['required', 'min:4', 'max:255', 'unique:services'],
            'image'         => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        Service::create($data);
        return redirect('dashboard/services')->with('success', 'Data Berhasil Ditambahkan');
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
            'title_bar' => 'Perbarui Layanan',
            'service'   => $service
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
            'name'          => $request->name !== $service->name ? ['required', 'min:4', 'max:255', 'unique:services'] : ['required', 'min:4', 'max:255'],
            'image'         => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete($service->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        Service::where('id', $service->id)->update($data);
        return redirect('dashboard/services')->with('success', 'Data Berhasil Diperbarui');
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
