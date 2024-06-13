<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $request->file('upload')->storeAs('attachments', $filenametostore);
            // $request->file('upload')->storeAs('attachments/thumbnail', $filenametostore);
            // $thumbnailpath = 'storage/attachments/thumbnail/' . $filenametostore;
            // $img = Image::make($thumbnailpath)->resize(500, 150, function ($constraint) {
            //     $constraint->aspectRatio();
            // });
            // $img->save($thumbnailpath);
            return response()->json([
                'default' => asset('storage/attachments/' . $filenametostore)
                // '500' => asset('storage/attachments/thumbnail/' . $filenametostore)
            ]);
        }
    }
}
