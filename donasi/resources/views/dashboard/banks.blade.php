@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header text-uppercase">
                {{ $title_bar }}
                <span class="ml-5">
                    <a href="javascript:void(0)" class="ms-2 addBank" data-bs-toggle="modal" data-bs-target="#bankModal">
                        <?= in_array('banks.store', $roles) ? "<i class='fas fa-plus-circle fa-lg'></i>" : '' ?>
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
                                <th>BANK</th>
                                <th>ATAS NAMA</th>
                                <th>NO. REKENING</th>
                                <th>USER</th>
                                <th>HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banks as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="editBank" data-id="{{ $row->id }}"
                                            data-bs-toggle="modal" data-bs-target="#bankModal"
                                            <?= in_array('banks.show', $roles) ? '' : "style='pointer-events: none; color:rgb(88, 88, 88)'" ?>>
                                            {{ $row->name }}
                                        </a>
                                    </td>
                                    <td>{{ $row->bank }}</td>
                                    <td>{{ $row->nomor }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        <form action="/dashboard/bank/{{ $row->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-datatable btn-icon btn-transparent-dark"
                                                onclick="return confirm('Yakin ingin melanjutkan?')"
                                                <?= in_array('banks.destroy', $roles) ? '' : 'Disabled' ?>><i
                                                    data-feather="trash-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-3">
                    {{ $banks->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="_method" id="_method">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bankModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control mt-1 @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="bank">Bank</label>
                            <input type="text" name="bank" id="bank"
                                class="form-control mt-1 @error('bank') is-invalid @enderror">
                            @error('bank')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="nomor">Nomor</label>
                            <input type="text" name="nomor" id="nomor"
                                class="form-control mt-1 @error('nomor') is-invalid @enderror">
                            @error('nomor')
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
        $('.addBank').on('click', function() {
            $('#bankModalLabel').html('Bank Baru');
            $('input[name=_method]').val('POST');
            $('.modal form').prop('action', '/dashboard/banks');
            $('.modal-footer button[type=submit]').html('Simpan');
            $('#id').val('');
            $('#name').val('');
            $('#bank').val('');
            $('#nomor').val('');
            $('#user_id option').prop('selected', false);
        });

        $('.editBank').on('click ', function() {
            const id = $(this).data('id');
            $('input[name=_method]').val('PUT');
            $('#bankModalLabel').html('Perbarui Bank');
            $('.modal form').prop('action', '/dashboard/banks/' + id);
            $('.modal-footer button[type=submit]').html('Perbarui');
            $.ajax({
                url: '/dashboard/banks/' + id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#bank').val(response.bank);
                    $('#nomor').val(response.nomor);
                    $('#user_id option[value=' + response.user_id + ']').prop('selected',
                        true);
                }
            });
        });
    </script>
@endsection
