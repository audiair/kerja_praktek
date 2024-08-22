<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Laporan Data Barang Keluar') }}
            </h2>
        </div>
    </x-slot>
    
    <form method="GET" action="/laporan_keluars/filter">
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h2 class="text-xl font-semibold leading-tight mb-3">
                Filter Data Barang Keluar
            </h2>
                
            <div class="inline-flex">
                <div class="max-w-xl mr-6">
                    <x-input-label for="tgl_awal" value="Tanggal Awal" />
                    <x-text-input id="tgl_awal" type="date" name="tgl_awal" class="mt-1 block" required/>
                    <x-input-error class="mt-2" :messages="$errors->get('tgl_awal')" />
                </div>

                <div class="max-w-xl">
                    <x-input-label for="tgl_akhir" value="Tanggal Akhir" />
                    <x-text-input id="tgl_akhir" type="date" name="tgl_akhir" class="mt-1 block" required/>
                    <x-input-error class="mt-2" :messages="$errors->get('tgl_awal')" />
                </div>
            </div>  
            <br><br>   
            <x-primary-button  tag="a" onclick="this.href='/laporan_keluars/filter/'+document.getElementById('tgl_awal').value + 
            '/' + document.getElementById('tgl_akhir').value " target="_blank">
                Cetak Pertanggal
            </x-primary-button> 

            <x-print-button tag="a" href="{{route('laporan_keluar.print')}}" target='blank'>
                Cetak Semua
            </x-print-button>

            <x-export-button tag="a">
                Export Excel
            </x-export-button>
        </div>
    </form>
    
    </br>
    
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>NO</th>
                        <th>TANGGAL KELUAR</th>
                        <th>BARANG</th>
                        <th>JUMLAH KELUAR</th>
                        <th>TOTAL HARGA</th>
                        <th>KETERANGAN</th>
                    </tr>
                </x-slot>
                @php $num=1; @endphp
                @foreach($barang_keluars as $barang_keluar)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $barang_keluar->tgl_keluar }}</td>
                    <td>{{ $barang_keluar->barang->kode_barang }}-{{ $barang_keluar->barang->nama_barang }}
                    <td>{{ $barang_keluar->jml_keluar }}</td> 
                    <td>Rp. {{number_format ($barang_keluar->total_harga) }}</td> 
                    <td>{{ $barang_keluar->keterangan }}</td> 
                </tr> 
                @endforeach
            </x-table>
</x-app-layout>