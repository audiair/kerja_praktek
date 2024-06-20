<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Barang Keluar') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('barang_keluar.update', $barang_keluars->id) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')
            <div class="max-w-xl">
                <x-input-label for="tgl_keluar" value="TANGGAL KELUAR"/>
                <x-text-input id="tgl_keluar" type="text" name="tgl_keluar" class="mt-1 block w-full bg-gray-100"
                value="{{ now() }}" readonly required />
                <x-input-error class="mt-2" :messages="$errors->get('tgl_keluar')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="nama_barang" value="NAMA BARANG" />
                <x-select-input id="nama_barang" name="id_barang" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($barangs as $key => $value)
                    @if (old('id_barang',  $barang_keluars->id_barang) == $key)
                        <option value="{{ $key }}" selected>{{ $value }}</option>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                    @endforeach
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="jml_keluar" value="JUMLAH KELUAR" />
                <x-text-input id="jml_keluar" type="number" name="jml_keluar" class="mt-1 block w-full"
                value="{{ old('jml_keluar', $barang_keluars->jml_keluar) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('jml_keluar')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="total_harga" value="TOTAL HARGA" />
                <x-text-input id="total_harga" type="number" name="total_harga" class="mt-1 block w-full"
                value="{{ old('total_harga', $barang_keluars->total_harga) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('total_harga')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="KETERANGAN"/>
                <x-select-input id="keterangan" name="keterangan" class="mt-1 block w-full" required>
                    <option selected>Open this select menu</option>
                    <option value="Terjual">Terjual</option>
                    <option value="Terpakai">Terpakai</option>
                    <option value="Kadaluarsa">Kadaluarsa</option>
                    <option value="Rusak">Rusak</option>
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="STOK" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full bg-gray-200"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="" value="TOTAL STOK" />
                <x-text-input id="" type="number" name="" class="mt-1 block w-full bg-gray-200"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('')" />
            </div>

            <x-secondary-button tag="a" href="{{ route('barang_keluar') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Ubah</x-primary-button>
        </form>
    </div>
</x-app-layout>