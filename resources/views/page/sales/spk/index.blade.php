@extends('masterBackend')
@section('title', 'DATA | CUSTOMER')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data SPK</h1>
        <hr>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Pembuatann SPK</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl Spk</th>
                                <th>No Spk</th>
                                <th>Nama Customer</th>
                                <th>Nama Barang</th>
                                <th>Total Barang</th>
                                <th>Satuan</th>
                                <th>Tanggal Kirim</th>
                                <th>Tanggal Kirim Akhir</th>
                                <th>Status Spk</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tanggal_spk }}</td>
                                    <td>{{ $item->no_spk }}</td>
                                    <td>{{ $item->nama_customer }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->total_barang }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->tanggal_kirim ?? '-' }}</td>
                                    <td>{{ $item->tanggal_akhir ?? '-' }}</td>
                                    <td>{{ $item->status_spk ?? '-' }}</td>

                                    <td class="text-center">
                                        @if ($item->status_spk === null)
                                            <a href="{{ route('spk-edit', $item->id) }}" class="btn btn-danger">
                                                Lengkapi Data SPK
                                            </a>
                                        @else
                                            <span class="text-success"><I>Sukses Pembuatan SPK</I></span>
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
