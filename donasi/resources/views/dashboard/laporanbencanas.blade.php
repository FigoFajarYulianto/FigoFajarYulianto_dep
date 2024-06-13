@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <form action="/dashboard/laporanbencanas" method="get" class="bg-light p-3 rounded">
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
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima
                                </option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
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

                <div class="table-responsive mt-3">
                    <table id="" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>KEJADIAN</th>
                                <th>TELEPON</th>
                                <th>PUKUL</th>
                                <th>TANGGAL</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>KECAMATAN</th>
                                <th>TEMPAT KEJADIAN</th>
                                <th>LOKASI</th>
                                <th>STATUS</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporanbencanas as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a
                                            href="/dashboard/laporanbencanas/{{ $row->id }}/edit">{{ $row->kejadian }}</a>
                                    </td>
                                    <td>{{ $row->telepon }}</td>
                                    <td>{{ $row->pukul }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($row->tanggal))->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $row->province->name }}</td>
                                    <td>{{ $row->district->name }}</td>
                                    <td>{{ $row->subdistrict->name }}</td>
                                    <td>{{ $row->kejadian }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>
                                        <form action="/dashboard/laporanbencanas/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data ini?');"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $laporanbencanas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
