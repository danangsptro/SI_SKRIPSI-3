@extends('masterBackend')
@section('title', 'DATA | JADWAL PRODUKSI')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data Jadwal Produksi</h1>
        <hr>
        <a href="{{ route('jadwal-produksi-create') }}" class="btn btn-primary btn-icon-split mb-4">
            <span class="icon text-white-50">
                <i class="menu-icon fa fa-plus-square"></i>
            </span>
            <span class="text">Add New</span>
        </a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Customer</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Customer</th>
                                <th>Kode Barang</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->customer->kode_customer }}</td>
                                    <td>{{ $item->barang->kode_barang }}</td>
                                    <td class="text-center">

                                        <a href="" class="btn btn-info btn-search ">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        {{-- button modal --}}
                                        <a href="" class="btn btn-warning btn-search" data-toggle="modal"
                                            data-target="#exampleModal{{ $loop->iteration }}">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <!-- Modal -->
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
                                                                    value="{{ $item->jadwal_dibuat }}" disabled>
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
                                                                <label>Tanggal Produksi</label>
                                                                <input class="form-control"
                                                                    value="{{ $item->tanggal_produksi }}" disabled>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>Deadline Produksi</label>
                                                                <input class="form-control"
                                                                    value="{{ $item->deadline_produksi }}" disabled >
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-lg-12">
                                                                <label>Status Produksi</label>
                                                                <input class="form-control" value="{{$item->status_produksi}}" disabled>
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
                                        {{-- Close Modal --}}
                                        <form action="{{route('jadwal-produksi-delete', $item->id)}}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-search"
                                                onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS ?')">
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
