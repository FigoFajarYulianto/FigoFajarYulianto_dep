<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Program;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class PengawasanController extends Controller
{
    public function index($slug)
    {
        // $sectionPosts = Section::getSection('posts');
        $program = Program::firstWhere('slug', $slug);
        $categories = Category::where('program_id', $program->id)->get();
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
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

        if (!request('category') && !request('author')) {
            // $title = $sectionPosts->name;
        }

        return view('fronts.pengawasan', [
            'title_bar' => $program->name,
            'pengawasan'    => Post::with(['category', 'user'])
                ->whereRelation('category', 'program_id', '=', $program->id)
                ->latest()->filter(request(['q', 'category', 'author']))->paginate(9)->withQueryString(),
            'categories'      => $categories,
            'slug'      => $slug
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
}