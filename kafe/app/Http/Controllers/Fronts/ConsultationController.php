<?php

namespace App\Http\Controllers\Fronts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Categoryconsultation;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Statusconsultation;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Carbon;
use App\Helpers\WhatsApp;
use App\Models\Walog;
use App\Models\User;

class ConsultationController extends Controller
{


    public function createconsultation(Request $request)
    {
        $nama = $request->input('nama');
        $whatsapp = $request->input('whatsapp');
        $category = Categoryconsultation::orderBy('nama', 'ASC')->get();
        $status = Statusconsultation::orderBy('nama', 'ASC')->get();
        $data['nama'] = $nama; //assign the name variable data to be pass to registration page view
        $data['whatsapp'] = $whatsapp; //assign the whatsapp number variable data to be pass to registration page view
        $data['category'] = $category;
        $data['status'] = $status;
        return view('fronts.registerconsultation', $data);  //pass the data to the view

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('fronts.registerconsultation', [
            'title_bar' => 'Registrasi Konsultasi',
            'category'    => Categoryconsultation::orderBy('nama', 'ASC')->get(),
            'status'    => Statusconsultation::orderBy('nama', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => ['required', 'min:4', 'max:100'],
            'nomor'  => ['required'],
            'whatsapp'      => ['required'],
            'judul'      => ['required'],
            'alamat'      => ['required'],
            'lampiran'      => [''],
            'categoryconsultation_id'   => ['required'],
            'statusconsultation_id'   => ['required'],
            'pesan'   => ['required'],
        ]);

        $queryConsultation = Consultation::create($data);

        $dataLaporan = Consultation::firstWhere('id', $queryConsultation->id);

        // kirim wa ke Admin
        $admin  = User::where('level_id', 1)->get();
        foreach ($admin as $row) {
            $pesanKeAdmin = 'Halo Admin pada hari ini tanggal dan jam ' . $dataLaporan->created_at->format('d/m/Y') . ' ' . $dataLaporan->created_at->format('h:i') . '  telah ada customer atas nama ' . $dataLaporan->nama . ' , Melakukan konsultasi hukum segera cek di dashboard ';

            if ($row->whatsapp) {
                $sendwa = WhatsApp::sendmessage($row->whatsapp, $pesanKeAdmin);
                $walog = [
                    'name'      => $row->name,
                    'number'    => $row->whatsapp,
                    'message'   => $pesanKeAdmin
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

        return redirect('/')->with('success', 'Konsultasi Anda Sudah Diterima Tunggu Informasi Lebih Lanjut Melalui WhatsApp');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('dashboard.editmenu', [
            'title_bar' => 'Perbarui Menu',
            'categorys'    => Category::orderBy('nama', 'ASC')->get(),
            'menu'    => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'nama'  => ['required', 'min:4', 'max:100'],
            'photo	' => ['image', 'file', 'max:2048'],
            'category_id'      => ['required'],
            'harga'      => ['required'],
            'diskon'      => [''],
            'deskripsi'      => ['required'],
            'aktif'      => ['required'],
        ]);
        $data['slug'] = SlugService::createSlug(Menu::class, 'slug', $request->nama);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->photo->store('uploads');
        }

        Menu::where('id', $menu->id)->update($data);
        return redirect('/dashboard/menus')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return back()->with('success', 'Data Berhasil Dihapus');
    }

    public function createinv(Request $request)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d', $request->tanggal)->format('Y-m-d');
        return response()->json(['number' => Consultation::generateInv($tanggal)]);
    }
}
