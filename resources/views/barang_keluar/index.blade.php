<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Barang Keluar') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <x-primary-button tag="a" href="{{route('barang_keluar.create')}}">
            Tambah Barang Keluar
        </x-primary-button>
        <br/><br/>
        <x-table>
            <x-slot name="header">
                <tr>
                    <th>NO</th>
                    <th>TANGGAL KELUAR</th>
                    <th>BARANG</th>
                    <th>JUMLAH KELUAR</th>
                    <th>TOTAL HARGA</th>
                    <th>KETERANGAN</th>
                    <th>AKSI</th>
                </tr>
            </x-slot>
            @php $num=1; @endphp
            @foreach($barang_keluars as $barang_keluar)
            <tr>
                <td>{{ $num++ }}</td>
                <td>{{ $barang_keluar->tgl_keluar }}</td>
                <td>{{ $barang_keluar->barang->kode_barang }}-{{ $barang_keluar->barang->nama_barang }}
                <td>{{ $barang_keluar->jml_keluar }}</td> 
                <td>Rp. {{ number_format ($barang_keluar->total_harga) }}</td> 
                <td>{{ $barang_keluar->keterangan }}</td> 
                <td>
                    <x-primary-button tag="a" href="{{route('barang_keluar.edit', $barang_keluar->id)}}">
                        EDIT
                    </x-primary-button>
                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal',
                    'confirm-barang_keluar-deletion')" x-on:click="$dispatch('set-action',
                    '{{ route('barang_keluar.destroy', $barang_keluar->id) }}')"> {{ __('Delete')}}
                    </x-danger-button>
                </td>    
            </tr> 
            @endforeach
        </x-table>
        <!-- MODAL DELETE -->
        <x-modal name="confirm-barang_keluar-deletion" focusable maxWidth="xl">
            <form method="post" x-bind:action="action" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Apakah anda yakin akan menghapus data?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Setelah proses dilakukan. Data akan dihilangkan secara permanen.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Data') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
</x-app-layout>
