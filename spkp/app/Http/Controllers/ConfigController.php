<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function clearRoute()
    {
        \Illuminate\Support\Facades\Artisan::call('route:cache');
    }

    public function storageLink()
    {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
    }
}