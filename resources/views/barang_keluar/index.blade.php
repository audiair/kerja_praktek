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
                    <th>#</th>
                    <th>TANGGAL KELUAR</th>
                    <th>BARANG</th>
                    <th>JUMLAH KELUAR</th>
                    <th>DESKRIPSI</th>
                    <th>AKSI</th>
                </tr>
            </x-slot>
        </x-table>
</x-app-layout>
