@extends('masterBackend')
@section('title', 'DATA | LAPORAN PURCHASING')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Laporan Receiving</h1>
        <hr>
        <form action="{{ route('laporan-stock-purchasing') }}" method="GET">
            <div class="row mt-2">
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon">Start: &nbsp;</span>
                        <input type="date" class="form-control date" placeholder="yyyy-mm-dd"
                            value="{{ Request::get('start') ? Request::get('start') : '' }}" name="start" />
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-addon">End: &nbsp;</span>
                        <input type="date" class="form-control date" placeholder="yyyy-mm-dd"
                            value="{{ Request::get('end') ? Request::get('end') : '' }}" name="end" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-success" type="submit">Search</button>
                    @if (Request::get('start') and Request::get('end'))
                        <a href="{{ route('laporan-stock-purchasing') }}" type="submit" class="btn btn-danger"
                            style="margin-left: 0.5em">Clear filter</a>
                    @endif
                </div>

            </div>
        </form>
        <br>
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
                                <th>Tanggal Receiving</th>
                                <th>No Receiving</th>
                                <th>No PO</th>
                                <th>No Surat Jalan</th>
                                <th>Nama Supplier</th>
                                <th>Total Barang PO</th>
                                <th>Total Barang Diterima</th>
                                <th>Sisa PO</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tangal_receiving ?? '-' }}</td>
                                    <td>{{ $item->no_receiving }}</td>
                                    <td>{{ $item->no_po }}</td>
                                    <td>{{ $item->no_surat_jalan ?? '-' }}</td>
                                    <td>{{ $item->nama_supplier }}</td>
                                    <td>{{ $item->total_barang_po }}</td>
                                    <td>{{ $item->total_barang_yg_diterima ?? '-' }}</td>
                                    <td>{{ $item->sisa_po ?? '-' }}</td>
                                    <td>{{ $item->satuan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
