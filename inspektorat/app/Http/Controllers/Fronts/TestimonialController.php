<?php

namespace App\Http\Controllers\Fronts;

use App\Models\User;
use App\Models\Walog;
use App\Helpers\WhatsApp;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{

    public function index()
    {
        return view('fronts.testimonials', [
            'title_bar'     => 'Survey Warga',
            'testimonials'  => Testimonial::latest()->paginate(100),
            'totalStar'     => Testimonial::sum('star'),
            'totalTesti'    => Testimonial::count()
        ]);
    }

    public function create()
    {
        return view('fronts.createtestimonial', [
            'title_bar'     => 'Tulis Survey Warga'
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'image'         => 'image|file|max:2048',
            'star'          => 'numeric'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('testimonials');
        }
        $data['star'] = $request->rateStar;
        $query = Testimonial::create($data);

        if ($query) {
            foreach (User::where('level_id', 1)->get() as $row) {
                $pesan = 'Hai *' . $row->name . '*, Warga an. *' . $query->name . '* telah memberikan testimoni kepada Inspektorat Jember melalui Website, berikut testimoninya:

_"' . $query->description . '"_

Cek Ya.. !!!';
                $sendwa = WhatsApp::sendmessage($row->hp, $pesan);
                $walog = [
                    'name'      => $row->name,
                    'number'    => $row->hp,
                    'message'   => $pesan
                ];
                if ($sendwa) {
                    $walog['status'] = true;
                    Walog::create($walog);
                } else {
                    $walog['status'] = false;
                    Walog::create($walog);
                }
            }
        }

        return back()->with('success', 'Terimakasih! Pesan berhasil terkirim');
    }
}