<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('barang.update', $barangs->id) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')
            <div class="max-w-xl">
                <x-input-label for="kode_barang" value="KODE BARANG"/>
                <x-text-input id="kode_barang" type="text" name="kode_barang" class="mt-1 block w-full"
                value="{{ old('kode_barang', $barangs->kode_barang) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('id_kategori')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="nama_barang" value="NAMA BARANG" />
                <x-text-input id="nama_barang" type="text" name="nama_barang" class="mt-1 block w-full"
                value="{{ old('nama_barang', $barangs->nama_barang) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('kategori_barang')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="kategori" value="KATEGORI BARANG" />
                <x-select-input id="kategori" name="id_kategori" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($kategoris as $key => $value)
                    @if (old('id_kategori',  $barangs->id_kategori) == $key)
                        <option value="{{ $key }}" selected>{{ $value }}</option>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                    @endforeach
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="stok" value="STOK" />
                <x-text-input id="stok" type="text" name="stok" class="mt-1 block w-full"
                value="{{ old('stok', $barangs->stok) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('stok')" />
            </div>
                            
            <div class="max-w-xl">
                <x-input-label for="satuan" value="SATUAN" />
                <x-text-input id="satuan" type="text" name="satuan" class="mt-1 block w-full"
                value="{{ old('satuan', $barangs->satuan) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('satuan')" />
            </div>


            <x-secondary-button tag="a" href="{{ route('barang') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Ubah</x-primary-button>
        </form>
    </div>
</x-app-layout>