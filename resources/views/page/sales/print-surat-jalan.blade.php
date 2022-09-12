<!DOCTYPE html>
<html lang="en">

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
    <div class="container-fluid">
        <div class="text-center">
            <p>PT.ARTHAWENASAKTI GEMILANG</p>
            <h4>SURAT JALAN</h4>
        </div>

        <div class="text-right mt-3">
            <span><strong>No.Surat Jalan :</strong> {{ $data->nomor_surat_jalan }}</span>
            <br>
            <span><strong>Tanggal Kirim :</strong> {{ date('d-m-Y', strtotime($data->tanggal_surat_jalan)) }}

            </span>
        </div>

        <div class="text-left">
            <p>Kepada Yth:</p>
            <h6>{{ $data->customer->nama_customer }}</h6>
            <p>Alamat : {{ $data->alamat }}</p>
            <p>Kami Kirimkan Barang-barang dibawah ini dnegan kendaraan : <strong>{{ $data->expedisi }}</strong>
                &nbsp;&nbsp;&nbsp;&nbsp; No :</p>
        </div>
        <div class="mt-4 mb-4">
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA BARANG</th>
                        <th scope="col">JUMLAH</th>
                        <th scope="col">QTY</th>
                        <th scope="col">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $data->barang->nama_barang }}</td>
                        <td>{{ $data->total_barang_kirim }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td><br><br><br></td>
                    </tr>
                </tbody>
            </table>

            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th scope="col">Disiapkan Oleh:</th>
                        <th scope="col">Dikeluarkan Oleh:</th>
                        <th scope="col">Dibawah Oleh:</th>
                        <th scope="col">Dicek Oleh:</th>
                        <th scope="col">Diterima Oleh:</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><br><br><br><br>Admin Sales</td>
                        <td><br><br><br><br>Warehouse</td>
                        <td><br><br><br><br>Driver</td>
                        <td><br><br><br><br></td>
                        <td><br><br><br><br></td>
                    </tr>
                </tbody>
        </div>

    </div>

</body>

</html>
