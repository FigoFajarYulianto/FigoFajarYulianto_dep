<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Status;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Support\Str;
use App\Models\Campaignfund;
use Illuminate\Http\Request;
use App\Models\Campaignfunditem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CampaignController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $campaigns = Campaign::with([
            'province', 'district', 'subdistrict', 'status', 'campaign_fund', 'campaign_fund_items'
        ])
            ->filter(request(['name', 'province', 'district', 'subdistrict', 'status', 'startdate', 'enddate']))
            ->latest()
            ->paginate(50);

        return view('dashboard.campaigns', [
            'title_bar'     => 'Penggalangan Dana',
            'campaigns'     => $campaigns,
            'roles'         => $roles,
            'provinces'     => Province::orderBy('name', 'ASC')->get(),
            'districts'     => District::orderBy('name', 'ASC')->get(),
            'subdistricts'  => Subdistrict::orderBy('name', 'ASC')->get(),
            'statuses'      => Status::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function create()
    {
        return view('dashboard.campaigncreate', [
            'title_bar'     => 'Galang Dana Baru',
            'categories'    => Category::all(),
            'provinces'     => Province::all(),
            'districts'     => District::all(),
            'subdistricts'  => Subdistrict::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'       => ['required'],
            'province_id'       => ['required'],
            'district_id'       => ['required'],
            'subdistrict_id'    => ['required'],
            'title'             => ['required'],
            'nominal'           => ['required'],
            'waktu_tenggat'     => ['required'],
            'description'       => ['required'],
        ]);

        $data['nominal'] = $request->nominal ? Str::replace(['.', ','], ['', '.'], $request->nominal) : 0;
        $data['slug'] = SlugService::createSlug(Campaign::class, 'slug', $request->title);
        $data['image'] = $request->hasFile('image') ? $request->image->store('uploads') : NULL;
        $data['user_id'] = auth()->user()->id;
        $data['status_id'] = 1;

        Campaign::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function show(Campaign $campaign)
    {
        return response()->json($campaign);
    }

    public function edit(Campaign $campaign)
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $user = auth()->user();
        if (($user->id !== $campaign->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        return view('dashboard.campaignedit', [
            'title_bar'     => 'Perbarui Galang Dana',
            'campaign'      => $campaign,
            'categories'    => Category::all(),
            'provinces'     => Province::all(),
            'districts'     => District::all(),
            'subdistricts'  => Subdistrict::all(),
            'statuses'      => Status::all(),
            'roles'         => $roles
        ]);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $user = auth()->user();
        if (($user->id !== $campaign->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }

        $data = $request->validate([
            'category_id'       => ['required'],
            'province_id'       => ['required'],
            'district_id'       => ['required'],
            'subdistrict_id'    => ['required'],
            'title'             => ['required'],
            'nominal'           => ['required'],
            'waktu_tenggat'     => ['required'],
            'description'       => ['required'],
        ]);

        $data['nominal'] = $request->nominal ? Str::replace(['.', ','], ['', '.'], $request->nominal) : 0;

        $data['slug'] = $request->title !== $campaign->title ? SlugService::createSlug(Campaign::class, 'slug', $request->title) : $campaign->slug;
        if ($request->hasFile('image')) {
            if ($campaign->image) {
                Storage::delete($campaign->image);
            }
            $data['image'] = $request->image->store('uploads');
        }

        $data['status_id'] = auth()->user()->level_id == 1 ? $request->status_id : $campaign->status_id;

        Campaign::where('id', $campaign->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    public function destroy(Campaign $campaign)
    {
        $user = auth()->user();
        if (($user->id !== $campaign->user_id) && ($user->level_id !== 1)) {
            abort(403);
        }
        Campaign::destroy($campaign->id);
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
