<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $links    = Link::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $links    = Link::latest()->Paginate(10);
        }

        $title_bar = 'Link Terkait';

        return view('dashboard.links', compact('links', 'title_bar'));

        // return view('dashboard.links', [
        //     'title_bar' => 'Link Terkait',
        //     'links'     => Link::latest()->get()
        // ]);
    }

    public function create()
    {
        return view('dashboard.createlink', [
            'title_bar' => 'Link Baru'
        ]);
    }

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

    public function show(Link $link)
    {
        return response()->json($link);
    }

    public function edit(Link $link)
    {
        return view('dashboard.editlink', [
            'title_bar' => 'Perbarui Link',
            'link'      => $link
        ]);
    }

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

    public function destroy(Link $link)
    {
        Link::destroy($link->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}
