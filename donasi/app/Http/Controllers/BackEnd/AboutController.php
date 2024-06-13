<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::firstWhere('id', 1);
        return view('dashboard.about', [
            'title_bar' => $about->name,
            'about'     => $about
        ]);
    }

    public function show(About $about)
    {
        return response()->json($about);
    }

    public function update(Request $request, About $about)
    {
        $data = $request->validate([
            'name'          => ['required'],
            'image'         => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::delete($about->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        About::where('id', $about->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'image|file|max:2048']);
        if ($request->hasFile('file')) {
            $filenamewithextension = $request->file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $request->file->storeAs('attachments', $filenametostore);
            $path = asset('storage/attachments/' . $filenametostore);
            return $path;
        } else {
            abort(403);
        }
    }
}
