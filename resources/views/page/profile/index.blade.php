@extends('masterBackend')
@section('title', 'DATA | PROFILE')

@section('backend')
    <br>
    <div class="container-fluid">
        <div class="font-weight-bold text-black">
            <p class="fs-30 mb-0">Profile</p>
            <span></span>
        </div>
        <div class="mt-2">
            <div class="row">
                <div class="col-sm-5 mb-2 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <img width="130" src="{{ asset('assets/img/adminnn.png') }}">
                                <div class="mt-3">
                                    <h4 class="text-black font-weight-bold"></h4>
                                    <p>PT.ARTHAWENA SAKTI GEMILANG</p>
                                    <p><span class="font-weight-bold">{{ Auth::user()->name }}</span></p>
                                </div>
                                <hr>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Ganti Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card">
                        <h5 class="card-header fs-18 font-weight-bold text-white bg-warning">Edit Profile</h5>
                        <div class="card-body">
                            <form action="{{ route('profile-edit', Auth::user()->id) }}" class="fs-14 needs-validation"
                                novalidate method="post">
                                @csrf
                                <div>
                                    <label class="form-label font-weight-bold">Nama</label>
                                    <input type="text" name="name" value="{{ $data->name }}" class="form-control"
                                        autocomplete="off" required />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label class="form-label font-weight-bold">Email</label>
                                    <input type="email" name="email" value="{{ $data->email }}" class="form-control"
                                        autocomplete="off" required />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2">
                                    <label class="form-label font-weight-bold">Username</label>
                                    <input type="text" name="username" value="{{ $data->username }}" class="form-control"
                                        autocomplete="off" required />
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-dark btn-sm"><i
                                            class="fa fa-redo mr-2"></i>Perbarui Akun</button>
                                    <a href="{{ route('dashboard') }}" type="submit"
                                        class="btn btn-outline-danger btn-sm"><i class="fa fa-redo mr-2"></i>Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white fs-18">Ganti Password</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-profile-password', Auth::user()->id) }}" class="fs-14 needs-validation"
                        novalidate method="post">
                        @csrf
                        <div>
                            <label for="password" class="form-label font-weight-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off"
                                required />
                        </div>
                        <div class="mt-2">
                            <label for="confirm_password" class="form-label font-weight-bold">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                autocomplete="off" required />
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-redo mr-2"></i>Perbarui
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
