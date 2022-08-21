@extends('masterBackend')
@section('title', 'DATA | BARANG SELESAI PRODUKSI')


@section('backend')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Warehouse Barang Masuk</h1>
        <hr>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Selesai Produksi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Masuk Barang</th>
                                <th>Nama Customer</th>
                                <th>Nama Barang</th>
                                <th>Total Barang</th>
                                <th>Satuan</th>
                                <th>No Label</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangMasuk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_masuk_barang ?? '-' }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->total_barang_masuk }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->no_label }}</td>

                                    {{-- <td>{{ $item->customer->kode_customer }}</td>
                                    <td>{{ $item->barang->kode_barang }}</td> --}}

                                    <td>
                                        @if ($item->status === 'WHS')
                                            <span class="badge badge-success"> {{ $item->status }}
                                            </span>
                                        @elseif($item->status === 'PROD')
                                            <span class="badge badge-warning"> {{ $item->status }}
                                            </span>
                                        @elseif($item->status === 'SALES')
                                            <span class="badge badge-dark"> {{ $item->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === 'PROD')
                                            <form action="{{ route('warehouse-barangmasuktokeluar', $item->id) }}"
                                                class="d-inline" method="POST">
                                                @csrf
                                                @method('post')
                                                <button class="btn btn-success btn-sm"
                                                    onclick="return confirm('ANDA YAKIN INGIN UBAH STATUS ?')">
                                                    UBAH STATUS PROD

                                                </button>
                                            </form>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">

                                        <a href="{{route('barang-selesai-produksi-edit', $item->id)}}"
                                            class="btn btn-info btn-search ">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="" class="btn btn-warning btn-search" data-toggle="modal"
                                            data-target="#exampleModal{{ $loop->iteration }}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <div class="modal fade text-left" id="exampleModal{{ $loop->iteration }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel{{ $loop->iteration }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="exampleModalLabel{{ $loop->iteration }}">Detail Jadwal
                                                            Produksi</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label>Tanggal Dibuat Jadwal</label>
                                                                <input class="form-control"
                                                                    value="{{ $item->tanggal_masuk_barang }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-lg-6">
                                                                <label>Nama Customer</label>
                                                                <input class="form-control"
                                                                    value="{{ $item->customer->nama_customer }} - {{ $item->customer->kode_customer }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Nama Barang</label>
                                                                <input class="form-control"
                                                                    value="{{ $item->barang->nama_barang }} - {{ $item->barang->kode_barang }}"
                                                                    disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-lg-6">
                                                                <label>Total Barang</label>
                                                                <input class="form-control"
                                                                    value="{{ $item->total_barang }}" disabled>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Satuan</label>
                                                                <input class="form-control" value="{{ $item->satuan }}"
                                                                    disabled>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-lg-6">
                                                                <label>Status</label>
                                                                <input class="form-control" value="{{ $item->no_label }}"
                                                                    disabled>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Status</label>
                                                                <input class="form-control" value="{{ $item->status }}"
                                                                    disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{route('barang-selesai-produksi-delete', $item->id)}}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-search"
                                                onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
