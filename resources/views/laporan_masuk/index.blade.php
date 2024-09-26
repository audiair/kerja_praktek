<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Laporan Data Barang Masuk') }}
            </h2>
        </div>
    </x-slot>
    
    <form method="GET" action="/laporan_masuks/filter">
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <h2 class="text-xl font-semibold leading-tight mb-3">
                Filter Data Barang Masuk
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
            <x-primary-button  tag="a" onclick="this.href='/laporan_masuks/filter/'+document.getElementById('tgl_awal').value + 
            '/' + document.getElementById('tgl_akhir').value " target="_blank">
                Cetak Pertanggal
            </x-primary-button> 

            <x-print-button tag="a" href="{{route('laporan_masuk.print')}}" target='blank'>
                Cetak Semua
            </x-print-button>

            <x-export-button tag="a" href="{{route('laporan_masuk.export')}}" target='_blank'>
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
                        <th>TANGGAL MASUK</th>
                        <th>BARANG</th>
                        <th>JUMLAH MASUK</th>
                        <th>TOTAL HARGA</th>
                    </tr>
                </x-slot>
                @php $num=1; @endphp
                @foreach($barang_masuks as $barang_masuk)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $barang_masuk->tgl_masuk }}</td>
                    <td>{{ $barang_masuk->barang->kode_barang }}-{{ $barang_masuk->barang->nama_barang }}
                    <td>{{ $barang_masuk->jml_masuk }}</td> 
                    <td>Rp. {{number_format ($barang_masuk->total_harga) }}</td> 
                </tr> 
                @endforeach
            </x-table>
    </div>
</x-app-layout>