@extends('masterBackend')
@section('title', 'DATA | Update MPIC BARANG KELUAR')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Mpic Barang Keluar</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{route('mpicBarangKeluarUpdate', $data->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk" required readonly
                                    value="{{ $data->tanggal_masuk }}">
                                @error('tanggal_masuk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal Keluar</label>
                                <input type="date" class="form-control" name="tanggal_keluar" required
                                    value="{{ $data->tanggal_keluar }}">
                                @error('tanggal_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>No Surat Jalan</label>
                                <input type="text" class="form-control" name="no_surat_jalan"
                                    placeholder="Masukan no surat jalan" required readonly value="{{ $data->no_surat_jalan }}">
                                @error('no_surat_jalan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" class="form-control" name="nama_supplier" required readonly
                                    value="{{ $data->nama_supplier }}">
                                @error('nama_supplier')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" required readonly
                                    value="{{ $data->nama_barang }}">
                                @error('nama_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" class="form-control" required readonly name="satuan"
                                    value="{{ $data->satuan }}">
                                @error('satuan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Stock Barang</label>
                                <input type="number" class="form-control" required readonly name="stock_barang1"
                                    value="{{ $data->stock_barang1 }}">
                                @error('stock_barang1')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Total Barang Keluar</label>
                                <input type="number" class="form-control" required placeholder="masukan total barang keluar" name="total_barang_keluar"
                                    value="{{ $data->total_barang_keluar }}">
                                @error('total_barang_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="{{ route('mpicBarangMasuk') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
