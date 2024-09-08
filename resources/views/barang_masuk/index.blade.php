<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Data Barang Masuk') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form class="col-md-6 pb-4" method="get" action=/barang_masuks/search>   
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" name="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500" placeholder="Pencarian..." value="{{ isset($search) ? $search : '' }}" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-purple-500 hover:bg-purple-6 00 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Search</button>
            </div>
        </form>

        <x-primary-button tag="a" href="{{route('barang_masuk.create')}}">
            Tambah Barang Masuk
        </x-primary-button>
        
        <br/><br/>
            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>NO</th>
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
                    <td>Rp. {{number_format ($barang_masuk->total_harga) }}</td> 
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
            <!-- MODAL DELETE -->
            <x-modal name="confirm-barang_masuk-deletion" focusable maxWidth="xl">
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