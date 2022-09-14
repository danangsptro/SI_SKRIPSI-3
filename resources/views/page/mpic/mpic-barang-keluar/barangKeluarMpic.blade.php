@extends('masterBackend')
@section('title', 'DATA | CUSTOMER')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">FORM MPIC Barang Keluar</h1>
        <hr>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Mpic barang keluar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl (M)</th>
                                <th>Tgl (K)</th>
                                <th>No Surat Jalan</th>
                                <th>Nama Supplier</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Stock Barang (1)</th>
                                <th>Total Barang Keluar</th>
                                <th>Stock Barang (2)</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mpicBarangKeluar as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_masuk }}</td>
                                    <td>{{ $item->tanggal_keluar ?? '-' }}</td>
                                    <td>{{ $item->no_surat_jalan }}</td>
                                    <td>{{ $item->nama_supplier }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ number_format($item->stock_barang1) }}</td>
                                    <td>{{ number_format($item->total_barang_keluar) ?? '-' }}</td>
                                    <td>{{ number_format($item->stock_barang2) ?? '-' }}</td>
                                    <td class="text-center">
                                        @if ($item->stock_barang2 === null)
                                            <a href="{{ route('mpicBarangKeluarEdit', $item->id) }}"
                                                class="btn btn-info btn-circle">
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
                                        @else
                                            <span class="badge badge-pill badge-success"> Data Sudah Di update
                                            </span>
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
