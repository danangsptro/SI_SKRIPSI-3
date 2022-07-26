@extends('masterBackend')
@section('title', 'DATA | CREATE SURAT JALAN')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Surat Jalan</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{route('surat-jalan-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tanggal Surat Jalan</label>
                                <input type="date" class="form-control" name="tanggal_surat_jalan" required>
                                @error('tanggal_surat_jalan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label mb-1">Nama Customer</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="customer_id">
                                        <option selected>Pilih Option</option>
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama_customer }} - {{ $item->kode_customer }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label mb-1">Nama Barang</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="barang_id">
                                        <option selected>Pilih Option</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama_barang }} - {{ $item->kode_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nomor Surat Jalan</label>
                                <input type="text" class="form-control" name="nomor_surat_jalan" required
                                    placeholder="Masukan nomor surat jalan" name="nomor_surat_jalan">
                                @error('nomor_surat_jalan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" required
                                    placeholder="Masukan alamat" name="alamat">
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Expedisi</label>
                                <input type="text" class="form-control" placeholder="Masukan expedisi" name="expedisi" required>
                                @error('expedisi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Total Barang Kirim</label>
                                <input type="number" class="form-control" placeholder="Masukan total barang" name="total_barang_kirim" required>
                                @error('total_barang_kirim')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Satuan</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Option</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="satuan">
                                        <option selected>Pilih Option</option>
                                        <option value="KG">KG</option>
                                        <option value="PCS">PCS</option>
                                        <option value="TON">TON</option>
                                    </select>
                                    @error('satuan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
