<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.sliders', [
            'title_bar' => 'Slider',
            'sliders'   => Slider::latest()->get(),
            'roles'     =>  $roles
        ]);
    }

    public function create()
    {
        return view('dashboard.slidercreate', [
            'title_bar' => 'Slider Baru'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'unique:sliders'],
            'desktop' => ['image', 'file', 'max:2048'],
            'mobile' => ['image', 'file', 'max:2048']
        ]);

        if ($request->hasFile('desktop')) {
            $data['desktop'] = $request->desktop->store('uploads');
        }
        if ($request->hasFile('mobile')) {
            $data['mobile'] = $request->mobile->store('uploads');
        }

        Slider::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Slider $slider)
    {
        return response()->json($slider);
    }

    public function edit(Slider $slider)
    {
        return view('dashboard.slideredit', [
            'title_bar' => 'Perbarui Slider',
            'slider'    => $slider
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'name' => $request->name !== $slider->name ? ['required', 'unique:sliders'] : ['required'],
            'desktop' => ['image', 'file', 'max:2048'],
            'mobile' => ['image', 'file', 'max:2048']
        ]);

        if ($request->hasFile('desktop')) {
            if ($slider->desktop) {
                Storage::delete($slider->desktop);
            }
            $data['desktop'] = $request->desktop->store('uploads');
        }
        if ($request->hasFile('mobile')) {
            if ($slider->mobile) {
                Storage::delete($slider->mobile);
            }
            $data['mobile'] = $request->mobile->store('uploads');
        }
        Slider::where('id', $slider->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Slider $slider)
    {
        Slider::destroy($slider->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
