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
                <x-text-input id="kode_barang" type="text" name="kode_barang" class="mt-1 block w-full bg-gray-100"
                value="{{ old('$kode_barang', $barangs->kode_barang) }}" readonly />
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
                <x-text-input id="stok" type="number" name="stok" class="mt-1 block w-full  bg-gray-100"
                value="{{ old('stok', $barangs->stok) }}" required readonly />
                <x-input-error class="mt-2" :messages="$errors->get('stok')" />
            </div>
                            
            <div class="max-w-xl">
                <x-input-label for="" value="SATUAN BERAT"/>
                <x-select-input id="satuan" name="satuan" class="mt-1 block w-full" required>
                    <option value="{{ old('satuan', $barangs->satuan) }}" selected> {{ $barangs->satuan }}</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Kilogram">Kilogram</option>
                    <option value="Pack">Pack</option>
                    <option value="Gram">Gram</option>  
                    <option value="Karung">Karung</option>
                    <option value="Liter">Liter</option>
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="harga_satuan" value="HARGA SATUAN" />
                    <x-text-input id="harga_satuan" type="number" name="harga_satuan" class="mt-1 block w-full"
                    value="{{ old('harga_satuan', $barangs->harga_satuan) }}" required/>
                <x-input-error class="mt-2" :messages="$errors->get('harga_satuan')" />
            </div>
            
            <x-secondary-button tag="a" href="{{ route('barang') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Ubah</x-primary-button>
        </form>
    </div>
</x-app-layout>