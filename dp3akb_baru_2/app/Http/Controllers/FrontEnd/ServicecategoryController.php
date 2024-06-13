<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Page;
use App\Models\Service;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use App\Models\Servicecategory;
use App\Http\Controllers\Controller;

class ServicecategoryController extends Controller
{
    public function show(Servicecategory $servicecategory)
    {
        return view('frontend.detailservicecategories', [
            'title_bar'         => $servicecategory->name,
            'servicecategory'   => $servicecategory
        ]);
    }
}
