<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Barang Masuk') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <x-primary-button tag="a" href="{{route('barang_masuk.create')}}">
            Tambah Barang Masuk
        </x-primary-button>
        <br/><br/>
            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>TANGGAL MASUK</th>
                        <th>BARANG</th>
                        <th>JUMLAH MASUK</th>
                        <th>TOTAL HARGA</th>
                        <th>AKSI</th>
                    </tr>
                </x-slot>
                @php $num=1; @endphp
                @foreach($barang_masuks as $barang_masuk)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $barang_masuk->tgl_masuk }}</td>
                    <td>{{ $barang_masuk->barang->kode_barang }}-{{ $barang_masuk->barang->nama_barang }}
                    <td>{{ $barang_masuk->jml_masuk }}</td> 
                    <td>{{ $barang_masuk->total_harga }}</td> 
                    <td>
                        <x-primary-button tag="a" href="{{route('barang_masuk.edit', $barang_masuk->id)}}">
                            EDIT
                        </x-primary-button>
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal',
                        'confirm-barang_masuk-deletion')" x-on:click="$dispatch('set-action',
                        '{{ route('barang_masuk.destroy', $barang_masuk->id) }}')"> {{ __('Delete')}}
                        </x-danger-button>
                    </td>    
                </tr> 
                @endforeach
            </x-table>
</x-app-layout>