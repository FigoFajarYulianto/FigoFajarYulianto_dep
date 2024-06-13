<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\StorePageRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePageRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pages', [
            'title_bar' => 'Halaman',
            'pages'     => Page::with('user')->latest()->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createpage', [
            'title_bar' => 'Halaman Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:3', 'max:255', 'unique:pages'],
            'image' => ['image', 'file', 'max:2048'],
            'body'  => ['required']
        ]);
        $data['slug'] = SlugService::createSlug(Page::class, 'slug', $request->title);
        $data['image'] = $request->hasFile('image') ? $request->image->store('uploads') : NULL;
        $data['user_id'] = auth()->user()->id;
        $data['status'] = true;

        Page::create($data);
        return redirect('/dashboard/pages')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return response()->json($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $user = auth()->user();
        if (($user->id !== $page->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        return view('dashboard.editpage', [
            'title_bar' => 'Perbarui Halaman',
            'page'      => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $user = auth()->user();
        if (($user->id !== $page->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        $data = $request->validate([
            'title' => $request->title !== $page->title ? ['required', 'min:3', 'max:255', 'unique:pages'] : ['required', 'min:3', 'max:255'],
            'image' => ['image', 'file', 'max:2048'],
            'body'  => ['required']
        ]);
        $data['slug'] = $request->title !== $page->title ? SlugService::createSlug(Page::class, 'slug', $request->title) : $page->slug;
        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::delete($page->image);
            }
            $data['image'] = $request->image->store('uploads');
        }

        Page::where('id', $page->id)->update($data);
        return redirect('/dashboard/pages')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $user = auth()->user();
        if (($user->id !== $page->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        // if ($page->image) {
        //     Storage::delete($page->image);
        // }
        Page::destroy($page->id);
        return back()->with('success', 'Data Berhasil Dihapus');
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