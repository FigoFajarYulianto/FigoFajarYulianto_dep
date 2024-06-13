@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <form action="/dashboard/datadanas" method="get" class="bg-light p-3 rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="name" class="small">Pencarian</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-sm mt-1" value="{{ request('name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="danacategory" class="small">Nama Kategori Dana</label>
                                <select name="danacategory" id="danacategory" class="form-control form-control-sm mt-1">
                                    <option value="">:: Semua ::</option>
                                    @foreach ($danacategory as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('danacategory') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="dana" class="small">Nama Dana</label>
                                <select name="dana" id="dana" class="form-control form-control-sm mt-1">
                                    <option value="">:: Semua ::</option>
                                    @foreach ($danas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('dana') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    {{-- <button type="button" class="btn btn-sm btnReset btn-outline-dark">Reset</button> --}}
                </form>

                <div class="table-responsive mt-3">
                    <table id="" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>KATEGORI DANA</th>
                                <th>TERKUMPUL</th>
                                <th>SISA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($danafunds as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->dana->name }}</td>
                                    <td>{{ $row->dana->danacategory->name }}</td>
                                    <td>
                                        <a href="/dashboard/danafunds/{{ $row->dana->id }}">
                                            @currency($row->total_fund)</a>
                                    </td>
                                    <td>
                                        <a href="/dashboard/danafundwithdrawals/{{ $row->dana->id }}">
                                            @currency($row->sisa_fund)</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $danafunds->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
