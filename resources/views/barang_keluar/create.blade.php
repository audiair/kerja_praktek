<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Barang Keluar') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('barang_keluar.store') }}" class="mt-6 space-y-6">
            @csrf
            <div class="max-w-xl">
                <x-input-label for="" value="TANGGAL KELUAR"/>
                <x-text-input id="" type="text" name="" class="mt-1 block w-full bg-gray-100"
                value="{{ now() }}" readonly />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="BARANG" />
                <x-text-input id="" type="text" name="" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="JUMLAH KELUAR" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>
            
            <div class="max-w-xl">
                <x-input-label for="" value="DESKRIPSI"/>
                <x-select-input id="" name="" class="mt-1 block w-full" required>
                    <option selected>Open this select menu</option>
                    <option value="CA">Terjual</option>
                    <option value="FR">Terpakai</option>
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="TOTAL HARGA" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('total_harga')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="STOK" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full bg-gray-100"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="TOTAL STOK" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full bg-gray-100"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>
            
            <x-secondary-button tag="a" href="{{ route('barang_keluar') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </form>
    </div>
</x-app-layout>