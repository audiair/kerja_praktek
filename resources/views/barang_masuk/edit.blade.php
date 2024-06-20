<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Barang Keluar') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('barang_masuk.update', $barang_masuks->id) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')
            <div class="max-w-xl">
                <x-input-label for="tgl_masuk" value="TANGGAL MASUK"/>
                <x-text-input id="tgl_masuk" type="text" name="tgl_masuk" class="mt-1 block w-full bg-gray-100"
                value="{{ old('$tgl_masuk', $barang_masuks->tgl_masuk) }}" readonly required />
                <x-input-error class="mt-2" :messages="$errors->get('tgl_masuk')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="nama_barang" value="NAMA BARANG" />
                <x-select-input id="nama_barang" name="id_barang" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($barangs as $key => $value)
                    @if (old('id_barang',  $barang_masuks->id_barang) == $key)
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
                value="{{ old('jml_masuk', $barang_masuks->jml_masuk) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('jml_masuk')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="total_harga" value="TOTAL HARGA" />
                <x-text-input id="total_harga" type="number" name="total_harga" class="mt-1 block w-full"
                value="{{ old('total_harga', $barang_masuks->total_harga) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('total_harga')" />
            </div>

            <x-secondary-button tag="a" href="{{ route('barang_masuk') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Ubah</x-primary-button>
        </form>
    </div>
</x-app-layout>