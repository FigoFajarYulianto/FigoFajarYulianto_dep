<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        Page::where('id', $page->id)->update(['views' => ($page->views + 1)]);
        return view('fronts.detailpage', [
            'title_bar' => $page->title,
            'page'      => $page
        ]);
    }

    public function statistics()
    {
        return view('fronts.statistics', [
            'title_bar' => 'Statistik Inspektorat'
        ]);
    }
}