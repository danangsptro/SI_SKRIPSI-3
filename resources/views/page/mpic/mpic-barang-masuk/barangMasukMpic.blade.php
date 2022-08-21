@extends('masterBackend')
@section('title', 'DATA | CUSTOMER')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">FORM MPIC Barang Masuk</h1>
        <hr>
        <a href="" class="btn btn-primary btn-icon-split mb-4">
            <span class="icon text-white-50">
                <i class="menu-icon fa fa-plus-square"></i>
            </span>
            <span class="text">Add New</span>
        </a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Mpic barang masuk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl</th>
                                <th>No Surat Jalan</th>
                                <th>Nama Supplier</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Total Barang Masuk</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mpicBarangMasuk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->kode_customer }}</td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-info btn-circle">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-circle"
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
