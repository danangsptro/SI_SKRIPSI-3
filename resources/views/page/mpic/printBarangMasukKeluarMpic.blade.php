<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <p class="text-center font-weight-bold"> </p>
    <div class="mt-4 mb-4">
        <table>
            <tr>
                <td><strong>Note:</strong></td>
            </tr>
            <tr>
                <td>Name </td>
                <td> : {{ $idUser->name }} </td>
            </tr>
            <tr>
                <td>User Role</td>
                <td> : {{ $idUser->position }}</td>
            </tr>
            <tr>
                <td>Total Data: </td>
                <td> : {{ $mpicBarangKeluar->count() }}</td>
            </tr>
        </table>
    </div>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th scope="col">Tgl</th>
                <th scope="col">No Surat Jalan</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Satuan</th>
                <th scope="col">Tgl Masuk</th>
                <th scope="col">Tgl Keluar</th>
                <th scope="col">Stock Barang (1)</th>
                <th scope="col">Total Barang Keluar</th>
                <th scope="col">Stock Barang (2)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mpicBarangKeluar as $item)
                @if ($item->stock_barang2 != null)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->no_surat_jalan }}</td>
                        <td>{{ $item->nama_supplier }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ $item->tanggal_masuk }}</td>
                        <td>{{ $item->tanggal_keluar }}</td>
                        <td>{{ number_format($item->stock_barang1) }}</td>
                        <td>{{ number_format($item->total_barang_keluar) ?? '-' }}</td>
                        <td>{{ number_format($item->stock_barang2) ?? '-' }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>


</body>

</html>
