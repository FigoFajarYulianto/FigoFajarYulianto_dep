<?php

namespace App\Http\Controllers\Api;

use App\Models\Bencana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiBencanaController extends Controller
{
    public function index($sahabat)
    {

        // $getcategory = Bencana::where('id', $id)->first();

        $bencana = Bencana::with('sahabat')->where('id', $sahabat)->get();
        return response()->json($bencana);
    }
}
