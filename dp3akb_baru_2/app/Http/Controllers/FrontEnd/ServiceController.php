<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\Servicecategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        return view('frontend.detailservice', [
            'title_bar'     => $service->name,
            'services'      => Servicecategory::where('service_id', $service->id)->get(),
            'title_post'    => $service->postcategory($service->postcategory_id)->first(),
            'posts'         => Post::where('postcategory_id', $service->postcategory_id)->get(),
        ]);
    }
}
