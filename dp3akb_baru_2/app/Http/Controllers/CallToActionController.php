<?php

namespace App\Http\Controllers;

use App\Models\CallToAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CallToActionController extends Controller
{
    public function index()
    {
        $cta = CallToAction::firstWhere('id', 1);
        return view('dashboard.callToAction', [
            'title_bar'         => $cta->name,
            'callToAction'      => $cta
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

    public function show(CallToAction $callToAction)
    {
        return response()->json($callToAction);
    }

    public function edit(CallToAction $callToAction)
    {
        abort(403);
    }

    public function update(Request $request, $id)
    {
        $callToAction = CallToAction::firstWhere('id', $id);
        $data = $request->validate([
            'name'  => ['required', 'min:4', 'max:255'],
            'image' => ['image', 'file', 'max:2048']
        ]);
        if ($request->hasFile('image')) {
            if ($callToAction->image) {
                Storage::delete($callToAction->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['link'] = $request->link;
        $data['description'] = $request->description;
        CallToAction::where('id', $callToAction->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(CallToAction $callToAction)
    {
        abort(403);
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
