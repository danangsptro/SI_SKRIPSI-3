@extends('masterBackend')
@section('title', 'DATA | BARANG SELESAI PRODUKSI')


@section('backend')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Warehouse Barang Keluar</h1>
        <hr>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Barang Keluar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Keluar Barang</th>
                                <th>Nama Customer</th>
                                <th>Nama Barang</th>
                                <th>Total Barang Masuk</th>
                                <th>Total Barang Keluar</th>
                                <th>Satuan</th>
                                <th>No Label</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangKeluar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_keluar_barang ?? '-' }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->total_barang_masuk }}</td>
                                    <td>{{ $item->total_barang_keluar ?? '-' }}</td>
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
                                    <td class="text-center">
                                        @if ($item->status === 'WHS')
                                            <a href="" class="btn btn-info btn-search" data-toggle="modal"
                                                data-target="#exampleModal{{ $loop->iteration }}">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <div class="modal fade text-left" id="exampleModal{{ $loop->iteration }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel{{ $loop->iteration }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabel{{ $loop->iteration }}">Update Status
                                                                Barang Keluar</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('warehouse-barang-keluar-update', $item->id) }}"
                                                                method="POST">
                                                                @csrf

                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <label>Tanggal Keluar Barang</label>
                                                                        <input class="form-control" type="date" name="tanggal_keluar_barang"
                                                                            value="{{ $item->tanggal_keluar_barang }}"
                                                                            required>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-6">
                                                                        <label>Nama Customer</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->nama_customer }}" readonly>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <label>Nama Barang</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->nama_barang }}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-4">
                                                                        <label>Total Barang Masuk</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->total_barang_masuk }}"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <label>Total Barang Keluar</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->total_barang_keluar }}"  name="total_barang_keluar"
                                                                            required type="number">
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <label>Satuan</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->satuan }}" type="text"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-6">
                                                                        <label>No Label</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->no_label }}" readonly>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <label>Status</label>
                                                                        <input class="form-control"
                                                                            value="{{ $item->status }}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-dark btn-block">UPDATE</button>

                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            -
                                        @endif
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
