<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Http\Request;
use App\Models\Zakatcollectionunit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ZakatcollectionunitController extends Controller
{
    public function index()
    {
        return view('dashboard.zakatcollectionunits', [
            'title_bar'             => 'Unit Pengumpulan Zakat',
            'zakatcollectionunits'  => Zakatcollectionunit::with(['user'])->filter(request(['search']))->latest()->paginate(50)
        ]);
    }

    public function create()
    {
        return view('dashboard.zakatcollectionunitcreate', [
            'title_bar' => 'Unit Pengumpulan Zakat Baru',
            'provinces'     => Province::all(),
            'districts'     => District::all(),
            'subdistricts'  => Subdistrict::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => ['required'],
            'alamat'            => ['required'],
            'kontak'            => ['required'],
        ]);
        $data['slug'] = SlugService::createSlug(Zakatcollectionunit::class, 'slug', $request->name);
        $data['user_id'] = auth()->user()->id;
        $data['lokasi'] = $request->lokasi;
        $data['province_id'] = $request->province_id;
        $data['district_id'] = $request->district_id;
        $data['subdistrict_id'] = $request->subdistrict_id;

        Zakatcollectionunit::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Zakatcollectionunit $zakatcollectionunit)
    {
        return response()->json($zakatcollectionunit);
    }

    public function edit(Zakatcollectionunit $zakatcollectionunit)
    {
        return view('dashboard.zakatcollectionunitedit', [
            'title_bar'                => 'Perbarui Unit Pengumpulan Zakat',
            'zakatcollectionunit'      => $zakatcollectionunit,
            'provinces'     => Province::all(),
            'districts'     => District::all(),
            'subdistricts'  => Subdistrict::all(),
        ]);
    }

    public function update(Request $request, Zakatcollectionunit $zakatcollectionunit)
    {
        $data = $request->validate([
            'name'      => ['required'],
            'alamat'    => ['required'],
            'kontak'    => ['required'],
        ]);
        $data['slug'] = $request->title !== $zakatcollectionunit->title ? SlugService::createSlug(Zakatcollectionunit::class, 'slug', $request->title) : $zakatcollectionunit->slug;
        $data['lokasi'] = $request->lokasi;
        $data['province_id'] = $request->province_id;
        $data['district_id'] = $request->district_id;
        $data['subdistrict_id'] = $request->subdistrict_id;

        Zakatcollectionunit::where('id', $zakatcollectionunit->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Zakatcollectionunit $zakatcollectionunit)
    {
        Zakatcollectionunit::destroy($zakatcollectionunit->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function upload(Request $request)
    {
        $request->validate(['file' => 'image|file|max:2048']);
        if ($request->hasFile('file')) {
            $filenamewithextension = $request->file->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            $request->file->storeAs('attachments', $filenametostore);
            $path = asset('storage/attachments/' . $filenametostore);
            return $path;
        } else {
            abort(403);
        }
    }
}
