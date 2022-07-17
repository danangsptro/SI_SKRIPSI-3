@extends('masterBackend')
@section('title', 'DATA | CREATE JADWAL PRODUKSI')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Jadwal Produksi</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{ route('jadwal-produksi-store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Tanggal Dibuat Jadwal</label>
                                <input type="date" class="form-control" name="jadwal_dibuat" required>
                                @error('jadwal_dibuat')
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
                                <label>Total Barang</label>
                                <input type="number" class="form-control" name="total_barang" required
                                    placeholder="Masukan Total Barang" name="total_barang">
                                @error('total_barang')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
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
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tanggal Produksi</label>
                                <input type="date" class="form-control" name="tanggal_produksi" required>
                                @error('tanggal_produksi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Deadline Produksi</label>
                                <input type="date" class="form-control" name="deadline_produksi" required>
                                @error('deadline_produksi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Option</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="status_produksi">
                                        <option selected>Pilih Option</option>
                                        <option value="FINISHED">FINISHED</option>
                                        <option value="UNFINISHED">UNFINISHED</option>
                                    </select>
                                    @error('status_produksi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary"
                            onclick="return confirm('Data yang di masukan sudah benar ?')">Submit</button>
                        <a href="{{ route('jadwal-produksi') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
