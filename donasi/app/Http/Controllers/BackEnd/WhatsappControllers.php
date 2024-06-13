<?php

namespace App\Http\Controllers\BackEnd;

use App\Helpers\WhatsApp;
use App\Http\Controllers\Controller;
use App\Models\Walog;
use Illuminate\Http\Request;

class WhatsappControllers extends Controller
{

    public function index()
    {
        $histories = Walog::latest()->paginate(100);
        return view('dashboard.whatsapphistories', [
            'title_bar' => 'Histori Pesan WhatsApp',
            'histories' => $histories
        ]);
    }

    public function scan()
    {
        return view('dashboard.whatsapp', [
            'title_bar' => 'WhatsApp Status & Scan'
        ]);
    }

    public function getqr()
    {
        return response()->json(WhatsApp::auth());
    }

    public function reset()
    {
        WhatsApp::reset();
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Berhasil! Silahkan logout pada perangkat HP Anda dan server akan melakukan restart layanan. Silahkan tunggu beberapa saat sampai QRCode muncul dan siap untuk scan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function resend(Walog $walog)
    {
        $sendwa = WhatsApp::sendmessage($walog->number, $walog->message);
        if ($sendwa) {
            Walog::where('id', $walog->id)->update(['status' => true]);
            return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Pesan berhasil terkirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        } else {
            Walog::where('id', $walog->id)->update(['status' => false]);
            return back()->with('msg', '<div class="alert small alert-danger alert-dismissible fade show" role="alert">Oopps! Pesan gagal terkirim.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        }
    }

    public function destroy(Walog $walog)
    {
        Walog::destroy($walog->id);
        return back()->with('success', 'Data Berhasil Dihapus');
        // return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
