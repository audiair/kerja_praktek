<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
<h1 class="text-center">JAYA ABADI PS (PETSHOP)</h1>
<h2 class="text-center">Laporan Data Barang Keluar Pertanggal</h2>
    <br/>
    <table id="table-data" class="table table-bordered">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL KELUAR</th>
                <th>BARANG</th>
                <th>JUMLAH KELUAR</th>
                <th>TOTAL HARGA</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
        @php $no=1; @endphp
        @foreach($barang_keluars as $barang_keluar)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $barang_keluar->tgl_keluar }}</td>
                <td>{{ $barang_keluar->barang->kode_barang }}-{{ $barang_keluar->barang->nama_barang }}
                <td>{{ $barang_keluar->jml_keluar }}</td>
                <td>{{ $barang_keluar->total_harga }}</td>
                <td>{{ $barang_keluar->keterangan }}</td>
            </tr>
        @endforeach

        <!-- <script type="text/javascript">
            window.print();
        </script> -->

        </tbody>
    </table>
</body>
</html>