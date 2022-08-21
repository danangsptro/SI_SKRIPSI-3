@extends('masterBackend')

@section('title', 'DATA | BARANG SELESAI PRODUKSI')

@section('backend')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800 text-center mb-4 mt-4">Laporan Warehouse</h1>
        <hr>
        <a onclick="exportPdf()" class="btn btn-dark btn-icon-split mb-4">
            <span class="text">Print Laporan &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                    <path
                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                </svg>
            </span>
        </a>
        <form action="{{ route('warehouse-laporan-stock-barang') }}" method="GET">
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
                        <a href="{{ route('warehouse-laporan-stock-barang') }}" type="submit" class="btn btn-danger"
                            style="margin-left: 0.5em">Clear filter</a>
                    @endif
                </div>
            </div>
        </form>
        <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Laporan Warehouse</h6>
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
                                <th>Total Sisa Barang</th>
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
                                    <td>{{ $item->total_sisa_barang ?? '-' }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->no_label }}</td>
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
                                                                        <input class="form-control" type="date"
                                                                            name="tanggal_keluar_barang"
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
                                                                            value="{{ $item->total_barang_keluar }}"
                                                                            name="total_barang_keluar" required
                                                                            type="number">
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

@section('js')
    <script type="text/javascript">
        function exportPdf() {
            var start = $('input[name=start]').val();
            var end = $('input[name=end]').val();
            var url = "{{ route('laporan-stock-barang') }}?start=" + start + "&end=" + end;
            return window.open(url, '_blank');
        }
    </script>
@endsection
