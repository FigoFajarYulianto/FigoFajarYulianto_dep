<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Post;
use App\Models\Status;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->level_id === 1) {
            $posts = Post::with('user', 'postcategory', 'status')->latest();
        } else {
            $posts = Post::with('user', 'postcategory', 'status')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC');
        }

        return view('dashboard.posts', [
            'title_bar' => 'Berita',
            'posts'     => $posts->paginate(50)
        ]);
    }

    public function create()
    {
        return view('dashboard.createpost', [
            'title_bar'     => 'Berita Baru',
            'categories'    => Postcategory::orderBy('name', 'ASC')->get(),
            'statuses'      => Status::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => ['required', 'min:5', 'max:255', 'unique:pages'],
            'image'             => ['image', 'file', 'max:2048'],
            'body'              => ['required'],
            'postcategory_id'   => ['required']
        ]);
        $data['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        $data['image'] = $request->hasFile('image') ? $request->image->store('uploads') : NULL;
        $data['user_id'] = auth()->user()->id;
        if (auth()->user()->level_id === 1) {
            $data['status_id'] = 2;
        } else {
            $data['status_id'] = 1;
        }
        Post::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function edit(Post $post)
    {
        $user = auth()->user();
        if (($user->id !== $post->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        return view('dashboard.editpost', [
            'title_bar'         => 'Perbarui Berita',
            'postcategories'    => Postcategory::orderBy('name', 'ASC')->get(),
            'statuses'          => Status::orderBy('name', 'ASC')->get(),
            'post'              => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $user = auth()->user();
        if (($user->id !== $post->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        $data = $request->validate([
            'title'             => $request->title !== $post->title ? ['required', 'min:5', 'max:255', 'unique:posts'] : ['required', 'min:5', 'max:255'],
            'image'             => ['image', 'file', 'max:2048'],
            'body'              => ['required'],
            'postcategory_id'   => ['required']
        ]);
        $data['slug'] = $request->title !== $post->title ? SlugService::createSlug(Post::class, 'slug', $request->title) : $post->slug;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $data['image'] = $request->image->store('uploads');
        }

        Post::where('id', $post->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Post $post)
    {
        $user = auth()->user();
        if (($user->id !== $post->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }
        Post::destroy($post->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
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
