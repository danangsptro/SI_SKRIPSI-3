@extends('masterBackend')
@section('title', 'DATA | RECEIVING')


@section('backend')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Data Receiving</h1>
        <hr>
        <form action="{{ route('receiving-barang') }}" method="GET">
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
                        <a href="{{ route('receiving-barang') }}" type="submit" class="btn btn-danger"
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
                                <th>Validasi</th>
                                <th class="text-center">Action</th>
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
                                    <td>{{ number_format($item->total_barang_po) }}</td>
                                    <td>{{ number_format($item->total_barang_yg_diterima) ?? '-' }}</td>
                                    <td>{{ number_format($item->sisa_po) ?? '-' }}</td>
                                    <td>{{ $item->satuan ?? '-' }}</td>
                                    <td>
                                        @if ($item->validasi === 'N')
                                            <span class="badge badge-danger"> {{ $item->validasi }}
                                            </span>
                                        @else
                                            <span class="badge badge-success"> {{ $item->validasi }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($item->validasi === 'N')
                                            <a href="{{ route('edit-validasi-receiving', $item->id) }}"
                                                class="btn btn-info btn-sm">
                                                Update
                                            </a>
                                        @else
                                            <span class="text-success">Sudah Update validasi</span>
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
