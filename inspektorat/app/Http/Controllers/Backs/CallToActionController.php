<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\CallToAction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CallToActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cta = CallToAction::firstWhere('id', 1);
        return view('dashboard.callToAction', [
            'title_bar'         => $cta->name,
            'callToActions'      => $cta
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function show(CallToAction $callToAction)
    {
        return response()->json($callToAction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function edit(CallToAction $callToAction)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallToAction $callToAction)
    {
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
        return back()->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CallToAction  $callToAction
     * @return \Illuminate\Http\Response
     */
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