<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Section;
use App\Helpers\ApiPPID;
use App\Models\Category;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postcategory;

class PostController extends Controller
{
    public function index()
    {
        $sectionPosts = Section::getSection('posts');
        $title = '';
        if (request('category')) {
            $category = Postcategory::firstWhere('slug', request('category'));
            if (request('q')) {
                $title = $category->name . ' : ' . request('q');
            } else {
                $title = $category->name;
            }
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            if (request('q')) {
                $title = $author->name . ' : ' . request('q');
            } else {
                $title = $author->name;
            }
        }

        if (!request('category') && !request('author') && request('q')) {
            $title = $sectionPosts->name . ': ' . request('q');
        }

        if (!request('category') && !request('author') && !request('q')) {
            $title = $sectionPosts->name;
        }

        return view('frontend.posts', [
            'title_bar' => $title,
            'posts'     => Post::with(['postcategory', 'user'])->latest()->filter(request(['q', 'category', 'author']))->paginate(9)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        if ($post->status_id !== 2) {
            abort(404);
        }

        Post::where('id', $post->id)->update(['views' => ($post->views + 1)]);
        return view('frontend.detailnews', [
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
            'comment'   => ['required', 'min:3', 'max:255'],
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        Comment::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Terimakasih! Komentar berhasil terkirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
