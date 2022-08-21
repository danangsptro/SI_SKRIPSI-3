@extends('masterBackend')
@section('title', 'DATA | BARANG SELESAI PRODUKSI')


@section('backend')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data Barang Selesai Produksi</h1>
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
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_masuk_barang ?? '-' }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->total_barang }}</td>
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
                                        @elseif($item->status === null)
                                            <span class="badge badge-danger"> Tolong Isi Status
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status === null)
                                            <form action="{{ route('barang-selesai-produksi-update', $item->id) }}"
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
