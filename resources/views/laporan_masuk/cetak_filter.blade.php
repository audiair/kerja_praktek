<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        /* Tambahkan gaya khusus untuk tampilan tabel */
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid black;
        }

        td {
            word-wrap: break-word;
            border: 1px solid black;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<h1 class="text-center">JAYA ABADI PS (PETSHOP)</h1>
<h2 class="text-center">Laporan Data Barang Masuk Pertanggal</h2>
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
     <!-- Tampilkan tanggal dan nama user yang mencetak -->
    <p><strong>Dicetak oleh:</strong> {{ $user }}</p>
    <p><strong>Tanggal Cetak:</strong> {{ $printDate }}</p>
</body>
</html>