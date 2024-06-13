<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        if ($page->status !== 1) {
            abort(404);
        }

        Page::where('id', $page->id)->update(['views' => ($page->views + 1)]);
        return view('frontend.detailpage', [
            'title_bar' => $page->title,
            'page'      => $page,
            'posts'     => Post::latest()->paginate(3),
        ]);
    }
}
