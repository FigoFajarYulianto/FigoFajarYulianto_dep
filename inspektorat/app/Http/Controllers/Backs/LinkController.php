<?php

namespace App\Http\Controllers\Backs;

use App\Models\Link;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $links    = Link::latest()->paginate(100);

        $title_bar = 'Link Terkait';

        return view('dashboard.links', compact('links', 'title_bar'));

        // return view('dashboard.links', [
        //     'title_bar' => 'Link Terkait',
        //     'links'     => Link::latest()->get()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createlink', [
            'title_bar' => 'Link Baru'
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
            'name'  => ['required', 'unique:links', 'min:4', 'max:255'],
            'image' => ['image', 'file', 'max:2048'],
            'link'  => ['required']
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('uploads');
        }

        Link::create($data);
        return redirect('dashboard/links')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        return response()->json($link);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('dashboard.editlink', [
            'title_bar' => 'Perbarui Link',
            'link'      => $link
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        $data = $request->validate([
            'name'  => $request->name !== $link->name ? ['required', 'unique:links', 'min:4', 'max:255'] : ['required', 'min:4', 'max:255'],
            'image' => ['image', 'file', 'max:2048'],
            'link'  => ['required']
        ]);

        if ($request->hasFile('image')) {
            if ($link->image) {
                Storage::delete($link->image);
            }
            $data['image'] = $request->image->store('uploads');
        }

        Link::where('id', $link->id)->update($data);
        return redirect('dashboard/links')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        // if ($link->image) {
        //     Storage::delete($link->image);
        // }
        Link::destroy($link->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}