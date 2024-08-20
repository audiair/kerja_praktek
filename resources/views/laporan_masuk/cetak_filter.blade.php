<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center">Data Barang Masuk</h1>
    <p class="text-center">Laporan Data Barang Masuk Pertanggal</p>
    <br/>
    <table id="table-data" class="table-table-bordered">
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

        <script type="text/javascript">
            window.print();
        </script>
        
        </tbody>
    </table>
</body>
</html>