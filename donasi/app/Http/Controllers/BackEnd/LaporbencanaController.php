<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Laporbencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporbencanaController extends Controller
{
    public function index()
    {
        // $section = Section::firstWhere('slug', 'call-to-action');
        $laporbencana = Laporbencana::firstWhere('id', 1);
        return view('dashboard.lapor', [
            'title_bar'     => 'Lapor Bencana',
            'laporbencana'  => $laporbencana
        ]);
    }

    public function create()
    {
        abort(403);
    }

    public function store(Request $request)
    {
        abort(403);
    }

    public function show(Laporbencana $laporbencana)
    {
        return response()->json($laporbencana);
    }

    public function edit(Laporbencana $laporbencana)
    {
        abort(403);
    }

    public function update(Request $request, Laporbencana $laporbencana)
    {
        $data = $request->validate([
            'name'  => ['required', 'min:3', 'max:255'],
            'image' => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            if ($laporbencana->image) {
                Storage::delete($laporbencana->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        Laporbencana::where('id', $laporbencana->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
