@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="/dashboard/goals/create" class="ms-2">
                        <?= in_array('goals.create', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
                    </a>
                </span>
            </div>
            <div class="card-body">
                {!! session('msg') !!}
                <div class="table-responsive">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead class="text-uppercase bg-light text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>JUDUL</th>
                                <th>DESKRIPSI</th>
                                <th>IKON</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($goals as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="/dashboard/goals/{{ $row->id }}/edit"
                                            <?= in_array('goals.edit', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>{{ $row->title }}</a>
                                    </td>
                                    <td>{!! $row->description !!}</td>
                                    <td>
                                        <img src="{{ $row->image ? '/storage/' . $row->image : '/assets/img/noimage.jpeg' }}"
                                            class="img-thumbnail" width="100px">
                                    </td>
                                    <td>
                                        <form action="/dashboard/goals/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('goals.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
