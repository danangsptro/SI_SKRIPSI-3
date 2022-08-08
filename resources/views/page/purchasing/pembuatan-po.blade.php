@extends('masterBackend')
@section('title', 'DATA | PURCHASING')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data Purchasing</h1>
        <hr>
        <a href="{{ route('popurchasing-create') }}" class="btn btn-primary btn-icon-split mb-4">
            <span class="icon text-white-50">
                <i class="menu-icon fa fa-plus-square"></i>
            </span>
            <span class="text">Add New</span>
        </a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Purchasing</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NO PO</th>
                                <th>Tanggal PO</th>
                                <th>Nama Supplier</th>
                                <th>Tanggal Kirim</th>
                                <th>Tanggal Akhir</th>
                                <th>Total Barang</th>
                                <th>Satuan</th>
                                <th>Validasi</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->no_po }}</td>
                                    <td>{{ $item->tanggal_po }}</td>
                                    <td>{{ $item->supplier->nama_supplier }} - {{$item->supplier->kode_supplier}}</td>
                                    <td>{{ $item->tanggal_kirim_awal }}</td>
                                    <td>{{ $item->tanggal_kirim_akhir }}</td>
                                    <td>{{ $item->total_barang }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>
                                        @if ($item->validasi === 'N')
                                            <span class="badge badge-danger"> {{ $item->validasi }}
                                            </span>
                                        @else
                                            <span class="badge badge-success"> {{ $item->validasi }}
                                            </span>
                                        @endif
                                    </td>
                                    {{-- <td class="text-center">
                                        <a href="" class="btn btn-info btn-circle">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form action="" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-circle"
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
