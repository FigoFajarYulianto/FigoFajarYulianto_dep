<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        // $section = Section::firstWhere('slug', 'testimonials');
        return view('dashboard.testimonials', [
            'title_bar'     => 'Testimonial',
            'testimonials'  => Testimonial::latest()->simplePaginate(25)
        ]);
    }

    public function create()
    {
        // $section = Section::firstWhere('slug', 'testimonials');
        return view('dashboard.createtestimonial', [
            'title_bar'     => 'Testimonial Baru',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => ['required', 'min:3', 'max:255', 'unique:testimonials'],
            'image'         => ['image', 'file', 'max:2048'],
            'title'         => ['required'],
            'description'   => ['required']
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads');
        }
        $data['star'] = $request->rateStar;
        Testimonial::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Testimonial $testimonial)
    {
        return response()->json($testimonial);
    }

    public function edit(Testimonial $testimonial)
    {
        // $section = Section::firstWhere('slug', 'testimonials');
        return view('dashboard.edittestimonial', [
            'title_bar'     => 'Perbarui Testimonial',
            'testimonial'   => $testimonial
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'          => $request->name !== $testimonial->name ? ['required', 'min:3', 'max:255', 'unique:testimonials'] : ['required', 'min:3', 'max:255'],
            'image'         => ['image', 'file', 'max:2048'],
            'title'         => ['required'],
            'description'   => ['required']
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads');
        }
        $data['star'] = $request->rateStar;
        Testimonial::where('id', $testimonial->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::delete($testimonial->image);
        }
        Testimonial::destroy($testimonial->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
