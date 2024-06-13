<?php

namespace App\Http\Controllers\Backs;

use App\Models\User;
use App\Models\Kopij;
use App\Models\Walog;
use App\Helpers\WhatsApp;
use App\Models\Kopijitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class KopijController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kopijs', [
            'title_bar' => 'KOPI-J',
            'kopijs'    => Kopij::with('kopijitems', 'status')->withCount('kopijitems')->latest()->paginate(100)
        ]);
    }

    public function create()
    {
        return view('dashboard.createkopij', [
            'title_bar'    => 'Buat Konsultasi (KOPI-J)',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'                  => 'required',
            'nik'                   => 'required',
            'jenis_kelamin'         => 'required',
            'nomor_wa'              => 'required',
            'judul'                 => 'required',
            'deskripsi'             => 'required',
            'file_ktp'              => 'required|image|file|max:2048',
            'file_kk'               => 'image|file|max:2048',
            'file_lain1'            => 'image|file|max:2048',
            'file_lain2'            => 'image|file|max:2048',
            'status_id'             => 'required'
        ]);

        $data['nomor'] = Kopij::generateNomor(date('Y-m-d'));
        $data['nama'] = $request->nama;
        $data['nik'] = $request->nik;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['nomor_wa'] = $request->nomor_wa;
        $data['judul'] = $request->judul;
        $data['deskripsi'] = $request->deskripsi;
        $data['file_ktp'] = $request->hasFile('file_ktp') ? $request->file_ktp->store('uploads') : NULL;
        $data['file_kk'] = $request->hasFile('file_kk') ? $request->file_kk->store('uploads') : NULL;
        $data['file_lain1'] = $request->hasFile('file_lain1') ? $request->file_lain1->store('uploads') : NULL;
        $data['file_lain2'] = $request->hasFile('file_lain2') ? $request->file_lain2->store('uploads') : NULL;
        $data['status_id'] = $request->status_id ?? 0;

        $query = Kopij::create($data);
        if ($query) {

            $kopij = Kopij::with('kopijitems', 'status')->firstWhere('id', $query->id);
            $hari = date_format($kopij->created_at, 'l');
            $hariname = $hari == 'Monday' ? 'Senin' : ($hari == 'Tuesday' ? 'Selasa' : ($hari == 'Wednesday' ? 'Rabu' : ($hari == 'Thursday' ? 'Kamis' : ($hari == 'Friday' ? 'Jumat' : ($hari == 'Saturday' ? 'Sabtu' : 'Sunday')))));

            // kirim WA ke User
            $pesanKeUser = 'Yth. *' . $kopij->nama . '*, terimakasih telah menggunakan layanan *KOPI-J*
 
 *I. PADA:*
 - Nomor: ' . $kopij->nomor  . '
 - Hari: ' .  $hariname . '
 - Tanggal: ' . date_format($kopij->created_at, 'd') . '
 - Bulan: ' . date_format($kopij->created_at, 'F') . '
 - Jam: ' . date_format($kopij->created_at, 'H:i:s') . '
 
 *II. KONSULTASI:*
 ' . $kopij->judul . '
 
 Silahkan klik link berikut untuk melihat detail atau membalas:
 ' . url('/kopij?nomor=' . $kopij->nomor) . '
 
 Terimakasih. ';

            if ($kopij->nomor_wa) {
                $sendwa = WhatsApp::sendmessage($kopij->nomor_wa, $pesanKeUser);
                $walog = [
                    'name'      => $kopij->nama,
                    'number'    => $kopij->nomor_wa,
                    'message'   => $pesanKeUser
                ];
                if ($sendwa) {
                    $walog['status'] = true;
                    Walog::create($walog);
                } else {
                    $walog['status'] = false;
                    Walog::create($walog);
                }
            }

            return back()->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('info', 'Data gagal tersimpan');
        }
    }

    public function edit(Kopij $kopij)
    {
        return view('dashboard.editkopij', [
            'title_bar'    => 'Perbarui Konsultasi (KOPI-J)',
            'kopij'         => $kopij
        ]);
    }

    public function update(Request $request, Kopij $kopij)
    {
        $request->validate([
            'nama'                  => 'required',
            'nik'                   => 'required',
            'jenis_kelamin'         => 'required',
            'nomor_wa'              => 'required',
            'judul'                 => 'required',
            'deskripsi'             => 'required',
            'file_ktp'              => 'image|file|max:2048',
            'file_kk'               => 'image|file|max:2048',
            'file_lain1'            => 'image|file|max:2048',
            'file_lain2'            => 'image|file|max:2048',
            'status_id'             => 'required'
        ]);

        $data['nama'] = $request->nama;
        $data['nik'] = $request->nik;
        $data['jenis_kelamin'] = $request->jenis_kelamin;
        $data['nomor_wa'] = $request->nomor_wa;
        $data['judul'] = $request->judul;
        $data['deskripsi'] = $request->deskripsi;

        if ($request->hasFile('file_ktp')) {
            if ($kopij->file_ktp) {
                Storage::delete($kopij->file_ktp);
            }
            $data['file_ktp'] = $request->file_ktp->store('uploads');
        } else {
            $data['file_ktp'] = $kopij->file_ktp;
        }

        if ($request->hasFile('file_kk')) {
            if ($kopij->file_kk) {
                Storage::delete($kopij->file_kk);
            }
            $data['file_kk'] = $request->file_kk->store('uploads');
        } else {
            $data['file_kk'] = $kopij->file_kk;
        }

        if ($request->hasFile('file_lain1')) {
            if ($kopij->file_lain1) {
                Storage::delete($kopij->file_lain1);
            }
            $data['file_lain1'] = $request->file_lain1->store('uploads');
        } else {
            $data['file_lain1'] = $kopij->file_lain1;
        }

        if ($request->hasFile('file_lain2')) {
            if ($kopij->file_lain2) {
                Storage::delete($kopij->file_lain2);
            }
            $data['file_lain2'] = $request->file_lain2->store('uploads');
        } else {
            $data['file_lain2'] = $kopij->file_lain2;
        }

        $data['status_id'] = $request->status_id ?? 0;

        $query = Kopij::where('id', $kopij->id)->update($data);
        if ($query) {
            return back()->with('success', 'Data berhasil disimpan');
        } else {
            return back()->with('info', 'Data gagal tersimpan');
        }
    }

    public function show(Kopij $kopij)
    {
        // return $kopij->load('kopijitems', 'status');
        return view('dashboard.detailkopij', [
            'title_bar' => 'Detail Konsultasi (KOPI-J) No. ' . $kopij->nomor,
            'kopij'     => $kopij->load('kopijitems', 'status')
        ]);
    }

    public function destroy(Kopij $kopij)
    {
        if ($kopij->file_ktp) {
            Storage::delete($kopij->file_ktp);
        }
        if ($kopij->file_kk) {
            Storage::delete($kopij->file_kk);
        }
        if ($kopij->file_lain1) {
            Storage::delete($kopij->file_lain1);
        }
        if ($kopij->file_lain2) {
            Storage::delete($kopij->file_lain2);
        }

        Kopij::destroy($kopij->id);
        Kopijitem::where('kopij_id', $kopij->id)->delete($kopij->id);
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function reply(Request $request)
    {
        $data = $request->validate([
            'kopij_id'  => 'required',
            'pesan'     => 'required'
        ]);

        $data['user_id'] = auth()->user()->id;
        $query = Kopijitem::create($data);
        if ($query) {

            $kopij = Kopij::with('kopijitems', 'status')->firstWhere('id', $request->kopij_id);
            $hari = date_format($kopij->created_at, 'l');
            $hariname = $hari == 'Monday' ? 'Senin' : ($hari == 'Tuesday' ? 'Selasa' : ($hari == 'Wednesday' ? 'Rabu' : ($hari == 'Thursday' ? 'Kamis' : ($hari == 'Friday' ? 'Jumat' : ($hari == 'Saturday' ? 'Sabtu' : 'Sunday')))));

            // kirim WA ke User
            $pesanKeUser = 'Yth. *' . $kopij->nama . '*, jawaban atas konsultasi Anda
 
 *I. PADA:*
 - Nomor: ' . $kopij->nomor  . '
 - Hari: ' .  $hariname . '
 - Tanggal: ' . date_format($kopij->created_at, 'd') . '
 - Bulan: ' . date_format($kopij->created_at, 'F') . '
 - Jam: ' . date_format($kopij->created_at, 'H:i:s') . '
 
 *II. KONSULTASI:*
 ' . $kopij->judul . '
 
 *III. JAWABAN:*
 ' . $request->pesan . '
 
 Silahkan klik link berikut untuk melihat detail atau membalas:
 ' . url('/kopij?nomor=' . $kopij->nomor) . '
 
 Terimakasih. ';

            if ($kopij->nomor_wa) {
                $sendwa = WhatsApp::sendmessage($kopij->nomor_wa, $pesanKeUser);
                $walog = [
                    'name'      => $kopij->nama,
                    'number'    => $kopij->nomor_wa,
                    'message'   => $pesanKeUser
                ];
                if ($sendwa) {
                    $walog['status'] = true;
                    Walog::create($walog);
                } else {
                    $walog['status'] = false;
                    Walog::create($walog);
                }
            }

            return back()->with('success', 'Pesan berhasil terkirim');
        } else {
            return back()->with('info', 'Pesan gagal terkirim');
        }
    }

    public function trash($id)
    {
        $kopijitem = Kopijitem::firstWhere('id', $id);
        if ($kopijitem) {
            Kopijitem::destroy($kopijitem->id);
            return back()->with('success', 'Pesan berhasil dihapus');
        } else {
            return back()->with('info', 'Pesan gagal dihapus');
        }
    }
}
