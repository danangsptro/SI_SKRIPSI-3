@extends('masterBackend')
@section('title', 'DATA | EDIT MPIC BARANG MASUK')


@section('backend')
    <style>
        .card-content {
            margin-top: 5rem;
        }
    </style>

    <div class="container card-content">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit PO Mpic Barang Masuk</h6>
            </div>
            <div class="container-fluid mt-4 mb-4">
                <form method="POST" action="{{ route('mpicBarangMasukUpdate', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required
                                    value="{{ $data->tanggal }}">
                                @error('tanggal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>No Surat Jalan</label>
                                <input type="text" class="form-control" name="no_surat_jalan"
                                    placeholder="Masukan no surat jalan" required value="{{ $data->no_surat_jalan }}">
                                @error('no_surat_jalan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label mb-1">Nama Supplier</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect01" name="supplier_id">
                                        <option selected>Pilih Option</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('supplier_id') ?? $data->supplier_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_supplier }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
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
                                            <option value="{{ $item->id }}"
                                                {{ old('barang_id') ?? $data->barang_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Total Barang Masuk</label>
                                <input type="number" class="form-control" placeholder="Masukan Total Barang Masuk" required
                                    name="total_barang_masuk" value="{{ $data->total_barang_masuk }}">
                                @error('total_barang_masuk')
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
