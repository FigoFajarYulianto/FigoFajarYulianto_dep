<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.sections', [
            'title_bar' => 'Section',
            'sections'  => Section::orderBy('name', 'ASC')->get(),
            'roles'     => $roles
        ]);
    }

    public function show(Section $section)
    {
        return response()->json($section);
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'name'      => $request->name !== $section->name ? ['required', 'unique:sections'] : ['required'],
            'status'    => ['required']
        ]);
        Section::where('id', $section->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
