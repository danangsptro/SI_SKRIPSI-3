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
                <td> : {{$idUser->name}} </td>
            </tr>
            <tr>
                <td>User Role</td>
                <td> : {{$idUser->position}}</td>
            </tr>
            <tr>
                <td>Total Data: </td>
                <td> : {{$data->count()}}</td>
            </tr>
        </table>
    </div>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Receiving</th>
                <th scope="col">No Receiving</th>
                <th scope="col">No PO</th>
                <th scope="col">No Surat Jalan</th>
                <th scope="col">Nama Supplier</th>
                <th scope="col">Total Barang PO</th>
                <th scope="col">Total Barang Yg Diterima</th>
                <th scope="col">Sisa PO</th>
                <th scope="col">Satuan</th>
                <th scope="col">Validasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tangal_receiving ?? '-' }}</td>
                    <td>{{ $item->no_receiving ?? '-' }}</td>
                    <td>{{ $item->no_po ?? '-' }}</td>
                    <td>{{ $item->no_surat_jalan ?? '-' }}</td>
                    <td>{{ $item->nama_supplier ?? '-' }}</td>
                    <td>{{ $item->total_barang_po ?? '-' }}</td>
                    <td>{{ $item->total_barang_yg_diterima ?? '-' }}</td>
                    <td>{{ $item->sisa_po ?? '-' }}</td>
                    <td>{{ $item->satuan ?? '-' }}</td>
                    <td>{{ $item->validasi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>


</body>

</html>
