@extends('dashboard.template')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="settings"></i></div>
                                Pengaturan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/settings/{{ $setting->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name">Judul</label>
                            <input class="form-control mt-1 @error('name') is-invalid @enderror" name="name" type="text" id="name" value="{{ old('name', $setting->name) }}" />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name_company">Nama</label>
                            <input class="form-control mt-1 @error('name_company') is-invalid @enderror" name="name_company" type="text" id="name_company" value="{{ old('name_company', $setting->name_company) }}" />
                            @error('name_company')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <img src="{{ $setting->main_logo ? '/storage/' . $setting->main_logo : '/assets/img/noimage.jpeg' }}" class="img-thumbnail main_logoPreview" width="100px">
                            </div>
                            <div class="col-md-10 mb-3">
                                <div class="form-group">
                                    <label for="main_logo">Logo Utama (Header)</label>
                                    <div class="input-group">
                                        <input type="file" name="main_logo" id="main_logo" class="form-control @error('main_logo') is-invalid @enderror" onchange="previewImage('main_logo', 'main_logoPreview')">
                                        @error('main_logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $setting->sec_logo ? '/storage/' . $setting->sec_logo : '/assets/img/noimage.jpeg' }}" class="img-thumbnail sec_logoPreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="sec_logo">Logo Kedua (Footer)</label>
                                        <div class="input-group">
                                            <input type="file" name="sec_logo" id="sec_logo" class="form-control @error('sec_logo') is-invalid @enderror" onchange="previewImage('sec_logo', 'sec_logoPreview')">
                                            @error('sec_logo')
        <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
    @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <img src="{{ $setting->favicon ? '/storage/' . $setting->favicon : '/assets/img/noimage.jpeg' }}" class="img-thumbnail faviconPreview" width="100px">
                            </div>
                            <div class="col-md-10 mb-3">
                                <div class="form-group">
                                    <label for="favicon">Favicon</label>
                                    <div class="input-group">
                                        <input type="file" name="favicon" id="favicon" class="form-control @error('favicon') is-invalid @enderror" onchange="previewImage('favicon', 'faviconPreview')">
                                        @error('favicon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" id="description" rows="5"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $setting->description) }}</textarea>
                                @error('description')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror
                            </div> -->
                        <!-- <div class="form-group mb-3">
                                <label for="address">Alamat</label>
                                <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $setting->address) }}</textarea>
                                @error('address')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror
                            </div> -->
                        <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $setting->email) }}">
                                        @error('email')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="telp">Telp</label>
                                        <input type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp', $setting->telp) }}">
                                        @error('telp')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                            </div> -->
                        <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="facebook">Facebook (URL)</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $setting->facebook) }}">
                                        @error('facebook')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="instagram">Instagram (URL)</label>
                                        <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $setting->instagram) }}">
                                        @error('instagram')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                            </div> -->
                        <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="youtube">Youtube (URL)</label>
                                        <input type="text" name="youtube" id="youtube" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube', $setting->youtube) }}">
                                        @error('youtube')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="twitter">Twitter (URL)</label>
                                        <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $setting->twitter) }}">
                                        @error('twitter')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                            </div> -->
                        <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="whatsapp">WhatsApp</label>
                                        <input type="number" name="whatsapp" id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', $setting->whatsapp) }}">
                                        @error('whatsapp')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="telegram">Telegram (URL)</label>
                                        <input type="text" name="telegram" id="telegram" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram', $setting->telegram) }}">
                                        @error('telegram')
        <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
    @enderror
                                    </div>
                                </div>
                            </div> -->
                        <!-- <div class="form-group mb-3">
                                <label for="map">iFrame Google Map</label>
                                <textarea name="map" id="map" rows="10" class="form-control @error('map') is-invalid @enderror">{{ old('map', $setting->map) }}</textarea>
                                @error('map')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror
                            </div> -->
                        <!-- <div class="form-group mb-3">
                                <label for="code">Script Tag</label>
                                <textarea name="code" id="code" rows="10" class="form-control @error('code') is-invalid @enderror">{{ old('code', $setting->code) }}</textarea>
                                @error('code')
        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
    @enderror
                            </div> -->
                        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Create group modal-->
        <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-0">
                                <label class="mb-1 small text-muted" for="formGroupName">Group Name</label>
                                <input class="form-control" id="formGroupName" type="text" placeholder="Enter group name..." />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary-soft text-primary" type="button">Create New Group</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit group modal-->
        <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGroupModalLabel">Edit Group</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-0">
                                <label class="mb-1 small text-muted" for="formGroupName">Group Name</label>
                                <input class="form-control" id="formGroupName" type="text" placeholder="Enter group name..." value="Sales" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger-soft text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary-soft text-primary" type="button">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer-admin mt-auto footer-light">
        <div class="container-xl px-4">
            <div class="row">
                <div class="col-md-6 small">Copyright &copy; Your Website 2021</div>
                <div class="col-md-6 text-md-end small">
                    <a href="#!">Privacy Policy</a>
                    &middot;
                    <a href="#!">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection