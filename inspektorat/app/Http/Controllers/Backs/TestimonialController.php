<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $testimonials    = Testimonial::latest()->paginate(100);

        $title_bar     = 'Survey Kepuasan Masyarakat (SKM)';

        return view('dashboard.testimonials', compact('testimonials', 'title_bar'));


        // return view('dashboard.testimonials', [
        //     'title_bar'     => 'Testimonial',
        //     'testimonials'  => Testimonial::latest()->get()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createtestimonial', [
            'title_bar'     => 'SKM Baru',
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
        return redirect('/dashboard/testimonials')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return response()->json($testimonial);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('dashboard.edittestimonial', [
            'title_bar'     => 'Perbarui SKM',
            'testimonial'   => $testimonial
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
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
        return redirect('/dashboard/testimonials')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        // if ($testimonial->image) {
        //     Storage::delete($testimonial->image);
        // }
        Testimonial::destroy($testimonial->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
