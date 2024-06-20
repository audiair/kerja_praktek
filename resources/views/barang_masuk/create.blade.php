<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Barang Masuk') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('barang_masuk.store') }}" class="mt-6 space-y-6">
            @csrf
            <div class="max-w-xl">
                <x-input-label for="tgl_masuk" value="TANGGAL MASUK" />
                <x-text-input id="tgl_masuk" type="text" name="tgl_masuk" class="mt-1 block w-full bg-gray-100"
                value="{{ now() }}" readonly required/>
                <x-input-error class="mt-2" :messages="$errors->get('tgl_masuk')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="barang" value="BARANG" />
                <x-select-input id="id_barang" name="id_barang" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($barangs as $key => $value)
                    @if (old('id_barang') == $key)
                        <option value="{{ $key }}" selected>{{ $value }}</option>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                    @endforeach
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="jml_masuk" value="JUMLAH MASUK" />
                <x-text-input id="jml_masuk" type="number" name="jml_masuk" class="mt-1 block w-full"
                value="{{ old('jml_masuk') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('jml_masuk')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="total_harga" value="TOTAL HARGA" />
                <x-text-input id="total_harga" type="number" name="total_harga" class="mt-1 block w-full"
                value="{{ old('total_harga') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('total_harga')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="STOK" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full bg-gray-200"
                readonly/>
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="TOTAL STOK" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full bg-gray-200"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <x-secondary-button tag="a" href="{{ route('barang_masuk') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </form>
    </div>
</x-app-layout>