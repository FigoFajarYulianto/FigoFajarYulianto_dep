<?php

namespace App\Http\Controllers\Backs;

use App\Http\Controllers\Controller;
use App\Models\Consultationreply;
use Illuminate\Http\Request;

class ConsultationrepliesController extends Controller
{

    public function index(Request $request)
    {

        if ($request->has('search')) {
            $consultationreplies    = Consultationreply::where('name', 'LIKE', '%' . $request->search . '%')->Paginate(10);
        } else {
            $consultationreplies    = Consultationreply::latest()->Paginate(10);;
        }

        $title_bar = 'Balasan Konsultasi';



        return view('dashboard.consultationreplies', compact('consultationreplies', 'title_bar'));
    }

    public function create()
    {
        return view('dashboard.createconsultationreplies', [
            'title_bar' => 'Tambah Data',


        ]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'consultation_id'  => ['required'],
            'user_id' => ['required'],
            'lampiran'      => ['required'],
            'pesan'      => ['required'],


        ]);


        Consultationreply::create($data);
        return redirect('/dashboard/consultationreplies')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function show(Consultationreply $consultationreplie)
    {
        return response()->json($consultationreplie);
    }


    public function edit(Consultationreply $consultationreplie)
    {
        return view('dashboard.editconsultationreplies', [
            'title_bar' => 'Perbarui',

            'consultationreplie'    => $consultationreplie
        ]);
    }


    public function update(Request $request, Consultationreply $consultationreplie)
    {
        $data = $request->validate([
            'consultation_id'  => ['required'],
            'user_id' => ['required'],
            'lampiran'      => ['required'],
            'pesan'      => ['required'],


        ]);


        Consultationreply::where('id', $consultationreplie->id)->update($data);
        return redirect('/dashboard/consultationreplies')->with('success', 'Data Berhasil Diperbarui');
    }


    public function destroy(Consultationreply $consultationreplie)
    {
        Consultationreply::destroy($consultationreplie->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }
}