<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <x-primary-button tag="a" href="{{route('barang.create')}}">
            Tambah Barang
        </x-primary-button>
        <br/><br/>
        <x-table>
            <x-slot name="header">
                <tr>
                    <th>NO</th>
                    <th>KODE BARANG</th>
                    <th>NAMA BARANG</th>
                    <th>KATEGORI BARANG</th>
                    <th>STOK</th>
                    <th>SATUAN</th>
                    <th>HARGA SATUAN</th>
                    <th>AKSI</th>
                </tr>
            </x-slot>
            @php $num=1; @endphp
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $num++ }}</td>
                <td>{{ $barang->kode_barang }}</td>
                <td>{{ $barang->nama_barang }}</td> 
                <td>{{ $barang->kategori->kode_kategori }}-{{ $barang->kategori->kategori_barang }}
                <td>{{ $barang->stok }}</td> 
                <td>{{ $barang->satuan }}</td> 
                <td>Rp. {{ number_format($barang->harga_satuan) }}</td> 
                <td>
                    <x-primary-button tag="a" href="{{route('barang.edit', $barang->id)}}">
                        EDIT
                    </x-primary-button>

                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal',
                    'confirm-barang-deletion')" x-on:click="$dispatch('set-action',
                    '{{ route('barang.destroy', $barang->id) }}')"> {{ __('Delete')}}
                    </x-danger-button>
                </td>    
            </tr> 
            @endforeach
        </x-table>
        <!-- MODAL DELETE -->
        <x-modal name="confirm-barang-deletion" focusable maxWidth="xl">
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
    </div>
</x-app-layout>