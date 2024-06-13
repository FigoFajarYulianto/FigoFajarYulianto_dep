@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/campaignwithdrawals/{{ $campaign->id }}" class="me-2"><i
                                class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/campaignwithdrawals/{{ $campaign->id }}/store" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="bank_id" id="bank_id" value="{{ $banks->id }}">
                            <input type="hidden" name="campaign_id" id="campaign_id" value="{{ $campaign->id }}">
                            <div class="form-group mb-3">
                                <label for="user_id">Nama</label>
                                <input type="hidden" name="user_id" value="{{ old('user_id', auth()->user()->id) }}" />
                                <input class="form-control mt-1" type="text"
                                    value="{{ old('user_id', auth()->user()->name) }}" readonly />
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="transaction_type">Jenis Transaksi</label>
                                        <input type="text" class="form-control" name="transaction_type" value="Penarikan"
                                            readonly>
                                        @error('transaction_type')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="gross_amount">Nominal</label>
                                        <input class="form-control mt-1 @error('gross_amount') is-invalid @enderror"
                                            name="gross_amount" type="text" id="gross_amount"
                                            value="{{ old('gross_amount') }}" onkeyup="strToNum('gross_amount')" />
                                        @error('gross_amount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="bank">Bank</label>
                                        <input class="form-control mt-1 @error('bank') is-invalid @enderror" name="bank"
                                            type="text" id="bank" value="{{ old('bank', $banks->bank ?? '') }}"
                                            readonly />
                                        @error('bank')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="nomor_rekening">Nomor Rekening</label>
                                        <input class="form-control mt-1 @error('nomor_rekening') is-invalid @enderror"
                                            name="nomor_rekening" type="text" id="nomor_rekening"
                                            value="{{ old('nomor_rekening', $banks->nomor ?? '') }}" readonly />
                                        @error('nomor_rekening')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="description">Deskripsi</label>
                                        <textarea class="form-control mt-1 @error('description') is-invalid @enderror" name="description" id="description"
                                            cols="30" rows="10">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        formatStrNum('gross_amount');

        function previewImage(fieldId, previewClass) {
            const image = document.querySelector('#' +
                fieldId);
            const imgPreview = document.querySelector('.' + previewClass);

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(img) {
                imgPreview.src = img.target.result;
            }
        }
    </script>
@endsection
