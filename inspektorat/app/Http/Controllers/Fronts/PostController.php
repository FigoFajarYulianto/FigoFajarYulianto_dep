<?php

namespace App\Http\Controllers\Fronts;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Section;
use App\Http\Helpers\ApiPPID;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $sectionPosts = Section::getSection('posts');
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            if (request('q')) {
                $title = $category->name . ' : ' . request('q');
            } else {
                $title = $category->name ?? '';
            }
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            if (request('q')) {
                $title = $author->name . ' : ' . request('q');
            } else {
                $title = $author->name ?? '';
            }
        }

        if (!request('category') && !request('author')) {
            $title = $sectionPosts->name;
        }

        return view('fronts.posts', [
            'title_bar' => $title,
            'posts'     => Post::with(['category', 'user'])->latest()->filter(request(['q', 'category', 'author']))->paginate(9)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        if ($post->status !== 1) {
            abort(404);
        }

        Post::where('id', $post->id)->update(['views' => ($post->views + 1)]);
        return view('fronts.detailnews', [
            'title_bar' => $post->title,
            'post'      => $post
        ]);
    }

    public function postcomment(Request $request)
    {
        $data = $request->validate([
            'post_id'   => ['required'],
            'name'      => ['required', 'min:3', 'max:255'],
            'email'     => ['required', 'email:dns'],
            'comment'   => ['required', 'min:3', 'max:255']
        ]);
        Comment::create($data);
        return back()->with('success', 'Komentar Berhasil Terkirim');
    }


    public function ppid()
    {
        $sectionPPID = Section::getSection('ppid');
        return view('fronts.ppid', [
            'title_bar' => $sectionPPID->name,
            'ppid'      => ApiPPID::getNews()
        ]);
    }
}