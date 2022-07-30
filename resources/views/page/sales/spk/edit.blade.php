@extends('masterBackend')
@section('title', 'DATA | EDIT PASANGAN')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }

        .name-pasangan {
            display: di
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form SPK</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{ route('spk-update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No Spk</label>
                                <input type="text" class="form-control"name="no_spk" required value="{{$data->no_spk}}" readonly>
                                @error('no_spk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Spk</label>
                                <input type="date" class="form-control"name="tanggal_spk" required>
                                @error('tanggal_spk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Customer</label>
                                <input type="text" class="form-control" name="nama_customer" required readonly
                                    value="{{ $data->nama_customer }}">
                                @error('nama_customer')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control"name="nama_barang" required readonly
                                    value="{{ $data->nama_barang }}">
                                @error('nama_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Total Barang</label>
                                <input type="number" class="form-control"name="total_barang" required readonly
                                    value="{{ $data->total_barang }}">
                                @error('total_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control"name="satuan" required readonly
                                    value="{{ $data->satuan }}">
                                @error('satuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal Kirim</label>
                                <input type="date" class="form-control"name="tanggal_kirim" required
                                    value="{{ $data->tanggal_kirim }}">
                                @error('tanggal_kirim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control"name="tanggal_akhir" required
                                    value="{{ $data->tanggal_akhir }}">
                                @error('tanggal_akhir')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Status SPK</label>
                                <select class="custom-select" id="inputGroupSelect01" name="status_spk">
                                    <option selected>Pilih Option</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Proses">Proses</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="{{ route('spk') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
