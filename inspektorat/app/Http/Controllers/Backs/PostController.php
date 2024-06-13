<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->level_id === 1) {
            $posts = Post::with(['user', 'category'])->latest();
        } else {
            $posts = Post::with(['user', 'category'])->withCount('comments')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC');
        }
        return view('dashboard.posts', [
            'title_bar' => 'Berita',
            'posts'     => $posts->paginate(100)
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.createpost', [
            'title_bar'     => 'Berita Baru',
            'categories'    => Category::orderBy('name', 'ASC')->get(),
            'tags'          => Tag::orderBy('name', 'ASC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validate([
            'title'         => ['required', 'min:5', 'max:255', 'unique:pages'],
            'image'         => ['image', 'file', 'max:2048'],
            'body'          => ['required'],
            'category_id'   => ['required']
        ]);
        $data['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        $data['image'] = $request->hasFile('image') ? $request->image->store('uploads') : NULL;
        $data['tag_id'] = $request->tag_id ? $request->tag_id : NULL;
        $data['user_id'] = auth()->user()->id;
        $data['status'] = $request->status ?? 0;

        Post::create($data);
        return redirect('dashboard/posts')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = auth()->user();
        if (($user->id !== $post->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        return view('dashboard.editpost', [
            'title_bar'     => 'Perbarui Berita',
            'categories'    => Category::orderBy('name', 'ASC')->get(),
            'tags'          => Tag::orderBy('name', 'ASC')->get(),
            'post'          => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $user = auth()->user();
        if (($user->id !== $post->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        $data = $request->validate([
            'title'         => $request->title !== $post->title ? ['required', 'min:5', 'max:255', 'unique:posts'] : ['required', 'min:5', 'max:255'],
            'image'         => ['image', 'file', 'max:2048'],
            'body'          => ['required'],
            'category_id'   => ['required']
        ]);
        $data['slug'] = $request->title !== $post->title ? SlugService::createSlug(Post::class, 'slug', $request->title) : $post->slug;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $data['image'] = $request->image->store('uploads');
        }
        $data['tag_id'] = $request->tag_id ? $request->tag_id : $post->tag_id;

        if (auth()->user()->level_id === 1) {
            $data['status'] = $request->status;
        }

        Post::where('id', $post->id)->update($data);
        return redirect('/dashboard/posts')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $user = auth()->user();
        if (($user->id !== $post->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        // if ($post->image) {
        //     Storage::delete($post->image);
        // }
        Post::destroy($post->id);
        Comment::where('post_id', $post->id)->delete();
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
