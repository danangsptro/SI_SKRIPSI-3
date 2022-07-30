@extends('masterBackend')
@section('title', 'DATA | EDIT JADWAL PRODUKSI')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Jadwal Produksi</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{route('barang-selesai-produksi-update', $data->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No Label</label>
                                <input type="text" class="form-control" name="no_label" required readonly
                                    value="{{ $data->no_label }}">
                                @error('no_label')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Masuk Barang</label>
                                <input type="date" class="form-control" name="tanggal_masuk_barang" required
                                    value="{{ $data->tanggal_masuk_barang }}">
                                @error('tanggal_masuk_barang')
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

                                    <select class="custom-select" name="customer_id">
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('customer_id') ?? $data->customer_id == $item->id ? 'selected' : '' }}>
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
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('barang_id') ?? $data->barang_id == $item->id ? 'selected' : '' }}>
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
                                <input type="number" class="form-control" required placeholder="Masukan Total Barang"
                                    name="total_barang" value="{{ $data->total_barang }}">
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
                                        <option value="KG" {{ $data->satuan == 'KG' ? 'selected' : '' }}>KG</option>
                                        <option value="PCS" {{ $data->satuan == 'PCS' ? 'selected' : '' }}>PCS
                                        </option>
                                        <option value="TON" {{ $data->satuan == 'TON' ? 'selected' : '' }}>TON
                                        </option>
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
                                <label class="control-label">Status</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Option</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="status">
                                        <option selected>Pilih Option</option>
                                        <option value="WHS"
                                            {{ $data->status == 'WHS' ? 'selected' : '' }}>WHS
                                        </option>
                                        <option value="PROD"
                                            {{ $data->status == 'PROD' ? 'selected' : '' }}>PROD
                                        </option>
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
                        <a href="{{ route('barang-selesai-produksi') }}" type="submit" class="btn btn-dark">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
