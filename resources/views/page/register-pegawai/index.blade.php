@extends('masterBackend')
@section('title', 'REGISTER PEGAWAI ')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data Pegawai</h1>
        <hr>
        <button class="btn btn-primary btn-icon-split mb-4" data-toggle="modal" data-target="#exampleModal">
            <span class="icon text-white-50">
                <i class="menu-icon fa fa-plus-square"></i>
            </span>
            <span class="text">Register Pegawai</span>
        </button>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Register Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('register-user-store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') ins-invalid @enderror"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="username">Username</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') ins-invalid @enderror"
                                        value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label>User Role</label>
                                    <select class="custom-select" id="inputGroupSelect01" name="position">
                                        <option selected>Pilih Option</option>
                                        <option value="sales">Sales</option>
                                        <option value="produksi">Produksi</option>
                                        <option value="warehouse">Warehouse</option>
                                        <option value="purchasing">Purchasing</option>
                                        <option value="mpic/ppic">Mpic/ppic</option>
                                        <option value="manager">manager</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') ins-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" value="qwerty" readonly name="password"
                                        @error('password') ins-invalid @enderror required>

                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <button class="btn btn-primary" type="submit"
                                        onclick="return confirm('Data Sudah Benar ?')">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Position</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $q)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $q->position }}
                                    </td>
                                    <td>{{ $q->name }}</td>
                                    <td>{{ $q->email }}</td>
                                    <td>{{ $q->username }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-info btn-circle" data-toggle="modal"
                                            data-target="#edit{{ $loop->iteration }}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <div class="modal fade" id="edit{{ $loop->iteration }}" tabindex="-1"
                                            role="dialog" aria-labelledby="edit{{ $loop->iteration }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit{{ $loop->iteration }}Label">Update
                                                            Data
                                                            User
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        <form action="{{route('register-user-store', $q->id)}}" method="POST">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-6">
                                                                    <label for="name">Name</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" value="{{ $q->name }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label for="password">Password</label>
                                                                    <input type="text" class="form-control"
                                                                        name="password"
                                                                        @error('password') ins-invalid @enderror required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-6">
                                                                    <label>Username</label>
                                                                    <input type="text" name="username"
                                                                        class="form-control @error('username') ins-invalid @enderror"
                                                                        value="{{ $q->username }}" required>
                                                                </div>
                                                                <div class="form-group col-lg-6">
                                                                    <label for="email">Email</label>
                                                                    <input type="text" name="email"
                                                                        class="form-control @error('email') ins-invalid @enderror"
                                                                        value="{{ $q->email }}" required>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-lg-12">
                                                                <label>User Role</label>
                                                                <br>
                                                                <input type="radio"
                                                                    {{ $q->position == 'admin' ? 'checked' : '' }}
                                                                    name="position" value="admin">
                                                                <label for="customRadioInline1">Admin</label>
                                                                <input type="radio"
                                                                    {{ $q->position == 'manager' ? 'checked' : '' }}
                                                                    name="position" value="manager">
                                                                <label for="customRadioInline2">Manager</label>
                                                                <input type="radio"
                                                                    {{ $q->position == 'produksi' ? 'checked' : '' }}
                                                                    name="position" value="produksi">
                                                                <label for="customRadioInline2">Produksi</label>
                                                                <input type="radio"
                                                                    {{ $q->position == 'warehouse' ? 'checked' : '' }}
                                                                    name="position" value="warehouse">
                                                                <label for="customRadioInline2">Warehouse</label>
                                                                <br>
                                                                <input type="radio"
                                                                    {{ $q->position == 'purchasing' ? 'checked' : '' }}
                                                                    name="position" value="purchasing">
                                                                <label for="customRadioInline2">Purchasing</label>
                                                                <input type="radio"
                                                                    {{ $q->position == 'mpic/ppic' ? 'checked' : '' }}
                                                                    name="position" value="mpic/ppic">
                                                                <label for="customRadioInline2">Mpic/ppic</label>
                                                                <input type="radio"
                                                                    {{ $q->position == 'sales' ? 'checked' : '' }}
                                                                    name="position" value="sales">
                                                                <label for="customRadioInline2">Sales</label>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-lg-12">
                                                                    <button class="btn btn-success"
                                                                        type="submit">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('register-user-delete', $q->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-circle"
                                                onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS ?')"></a>
                                                <i class="fas fa-trash"></i>
                                            </button>
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
