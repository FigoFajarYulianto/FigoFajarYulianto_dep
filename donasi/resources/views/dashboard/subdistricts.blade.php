@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addSubdistrict" data-bs-toggle="modal"
                        data-bs-target="#subdistrictModal">
                        <?= in_array('subdistricts.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
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
                                <th>NAMA</th>
                                <th>KABUPATEN</th>
                                <th>PROVINSI</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subdistricts as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editSubdistrict" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#subdistrictModal"
                                            <?= in_array('subdistricts.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>{{ $row->district->name ?? '-' }}</td>
                                    <td>{{ $row->province->name ?? '-' }}</td>
                                    <td>
                                        <form action="/dashboard/subdistrict/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('subdistricts.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $subdistricts->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="subdistrictModal" tabindex="-1" aria-labelledby="subdistrictModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subdistrictModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Kecamatan</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="province_id">Provinsi</label>
                            <select name="province_id" id="province_id"
                                class="form-control mt-1 @error('province_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach (\App\Models\Province::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district_id">Kabupaten</label>
                            <select name="district_id" id="district_id"
                                class="form-control mt-1 @error('district_id') is-invalid @enderror">
                                <option value="">:: Pilih ::</option>
                                @foreach (\App\Models\District::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('district_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.addSubdistrict').on('click', function() {
            $('#subdistrictModalLabel').html('Kecamatan Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/subdistricts');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#province_id option').prop('selected', false);
            $('#district_id option').prop('selected', false);
        });

        $('.editSubdistrict').on('click ', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#subdistrictModalLabel').html('Perbarui Kecamatan');
            $('.modal form').prop('action', '/dashboard/subdistricts/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/subdistricts/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#province_id option[value=' + response.province_id + ']').prop('selected',
                        true);
                    $('#district_id option[value=' + response.district_id + ']').prop('selected',
                        true);
                }
            });
        });
    </script>
@endsection
