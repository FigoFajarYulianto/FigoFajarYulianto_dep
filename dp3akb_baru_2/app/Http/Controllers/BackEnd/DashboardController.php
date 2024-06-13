<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Postcategory;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title_bar' => 'Dashboard',
            'totalPages'            => Page::count(),
            'totalPosts'            => auth()->user()->level_id === 1 ? Post::count() : Post::where('user_id', auth()->user()->id)->count(),
            'totalPostCategories'   => Postcategory::count(),
            'totalUsers'            => User::count()
        ]);
    }
}
