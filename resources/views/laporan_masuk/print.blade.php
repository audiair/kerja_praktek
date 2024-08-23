<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">JAYA ABADI PS (PETSHOP)</h1>
<h2 class="text-center">Laporan Data Barang Keluar Pertanggal</h2>
    <br/>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL MASUK</th>
                <th>BARANG</th>
                <th>JUMLAH MASUK</th>
                <th>TOTAL HARGA</th>
            </tr>
        </thead>
        <tbody>
        @php $no=1; @endphp
        @foreach($barang_masuks as $barang_masuk)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $barang_masuk->tgl_masuk }}</td>
                <td>{{ $barang_masuk->barang->kode_barang }}-{{ $barang_masuk->barang->nama_barang }}
                <td>{{ $barang_masuk->jml_masuk }}</td>
                <td>{{ $barang_masuk->total_harga }}</td>
            </tr>
        @endforeach

        <!-- <script type="text/javascript">
            window.print();
        </script> -->

        </tbody>
    </table>
</body>
</html>