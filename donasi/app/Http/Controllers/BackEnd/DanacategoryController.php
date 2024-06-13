<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dana;
use App\Models\Danacategory;

class DanacategoryController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.danacategories', [
            'title_bar'         => 'Data Kategori Dana',
            'danacategories'    => Danacategory::withCount(['danas'])->latest()->paginate(100),
            'roles'             => $roles
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'unique:danacategories'],
        ]);

        Danacategory::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function show(Danacategory $danacategory)
    {
        return response()->json($danacategory);
    }

    public function update(Request $request, Danacategory $danacategory)
    {
        $data = $request->validate([
            'name'      => $request->name !== $danacategory->name ? ['required', 'unique:danacategories'] : ['required'],
        ]);

        Danacategory::where('id', $danacategory->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil diperbarui!</div>');
    }

    public function destroy(Danacategory $danacategory)
    {
        Danacategory::destroy($danacategory->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
