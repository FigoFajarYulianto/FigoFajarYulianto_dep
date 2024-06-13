@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/campaigns/create" class="ms-2"><i class="fas fa-plus-circle fa-lg"></i></a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <form action="/dashboard/campaigns" method="get" class="bg-light p-3 rounded">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="name" class="small">Pencarian</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm mt-1"
                                value="{{ request('name') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="province" class="small">Provinsi</label>
                            <select name="province" id="province" class="form-control form-control-sm mt-1">
                                <option value="">:: Semua ::</option>
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('province') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="district" class="small">Kabupaten</label>
                            <select name="district" id="district" class="form-control form-control-sm mt-1">
                                <option value="">:: Semua ::</option>
                                @foreach ($districts as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('district') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="subdistrict" class="small">Kecamatan</label>
                            <select name="subdistrict" id="subdistrict" class="form-control form-control-sm mt-1">
                                <option value="">:: Semua ::</option>
                                @foreach ($subdistricts as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('subdistrict') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="small">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm mt-1">
                                <option value="">:: Semua ::</option>
                                @foreach ($statuses as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('status') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startdate" class="small">Mulai Tanggal</label>
                            <input type="date" name="startdate" id="startdate" class="form-control form-control-sm mt-1"
                                value="{{ request('startdate') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="enddate" class="small">Sampai Tanggal</label>
                            <input type="date" name="enddate" id="enddate" class="form-control form-control-sm mt-1"
                                value="{{ request('enddate') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </form>

                <div class="table-responsive mt-2">
                    <table id="" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>TANGGAL</th>
                                <th>JUDUL</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>KECAMATAN</th>
                                <th>NOMINAL</th>
                                <th>TERKUMPUL</th>
                                <th>SISA</th>
                                <th>BATAS WAKTU</th>
                                <th>STATUS</th>
                                <th>LIHAT</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ date_format($row->created_at, 'd/m/Y') }}
                                    </td>
                                    <td>
                                        <a href="/dashboard/campaigns/{{ $row->id }}/edit">{{ $row->title }}</a>
                                    </td>
                                    <td>{{ $row->province->name }}</td>
                                    <td>{{ $row->district->name }}</td>
                                    <td>{{ $row->subdistrict->name }}</td>
                                    <td>@currency($row->nominal)</td>
                                    <td>
                                        @if ($row->campaign_fund == '')
                                            0
                                        @else
                                            <a href="/dashboard/campaigndonations/{{ $row->id }}">
                                                @currency($row->campaign_fund->total_fund)</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->campaign_fund == '')
                                            0
                                        @else
                                            <a
                                                href="/dashboard/campaignwithdrawals/{{ $row->id }}">@currency($row->campaign_fund->sisa_fund)</a>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y', strtotime($row->waktu_tenggat)) }}</td>
                                    <td>{{ $row->status->name }}</td>
                                    <td><a href="/campaigns/{{ $row->slug }}" target="_blank"><i
                                                class="fas fa-external-link"></i></a></td>
                                    <td>
                                        <form action="/dashboard/campaigns/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                {{ auth()->user()->id !== $row->user_id && auth()->user()->level_id !== 1 ? 'disabled' : '' }}
                                                type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3 mb-0">
                    {{ $campaigns->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
