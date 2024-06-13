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
                                <div class="page-header-icon"><i data-feather="user"></i></div>
                                Profile User
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
                    <a href="/dashboard/users" class="me-2"><i class="fa fa-arrow-circle-left"></i></a>
                    <h4 class="card-title">Profile User</h4>
                    <form class="form-sample" action="/dashboard/profile/{{ $user->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $user->name) }}" />
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username', $user->username) }}" />
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" placeholder="" id="email" value="{{ old('email', $user->email) }}" />
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Whatsapp</label>
                                    <div class="col-sm-9">
                                        <input class="form-control @error('hp') is-invalid @enderror" name="whatsapp" placeholder="" type="number" id="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" />
                                        @error('hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" rows="5" class="form-control mt-1 @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                </div> --}}
                <div class="row mt-3">
                    <div class="col-md-2 mb-3">
                        <img src="{{ $user->photo ? '/storage/' . $user->photo : '/assets/images/profile.png' }}" class="img-thumbnail imagePreview" width="100px">
                    </div>
                    <div class="col-md-10 mb-3">
                        <div class="form-group">
                            <label for="photo">Photo Profil</label>
                            <div class="input-group">
                                <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" onchange="previewImage('photo', 'imagePreview')">
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <div class="form-group row">
                            <label class="col mr-5">Password</label>
                            <div class="col-sm-12">
                                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="password" value="{{ old('password') }}" />
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
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
</div>
@endsection