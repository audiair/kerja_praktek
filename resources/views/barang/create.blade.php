<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <?php
            $barang = \App\Models\Barang::latest()->first();
            $kode = "BPS";
            if($barang == null){
                $nomorUrut = "001";
            }else{
                $nomorUrut = substr($barang->kode_barang, 3,3) + 1;
                $nomorUrut = str_pad($nomorUrut, 3, "0", STR_PAD_LEFT);
            }

            $kodeBarang = $kode . $nomorUrut;
        ?>
        <form method="post" action="{{ route('barang.store') }}" class="mt-6 space-y-6">
            @csrf
            <div class="max-w-xl">
                <x-input-label for="kode_barang" value="KODE BARANG"/>
                <x-text-input id="kode_barang" type="text" name="kode_barang" class="mt-1 block w-full bg-gray-100"
                value="{{ $kode_barang }}" readonly required />
                <x-input-error class="mt-2" :messages="$errors->get('kode_barang')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="nama_barang" value="NAMA BARANG" />
                <x-text-input id="nama_barang" type="text" name="nama_barang" class="mt-1 block w-full"
                value="{{ old('nama_barang') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('nama_barang')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="kategori_barang" value="KATEGORI BARANG" />
                <x-select-input id="kategori_barang" name="id_kategori" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($kategoris as $key => $value)
                    @if (old('id_kategori') == $key)
                        <option value="{{ $key }}" selected>{{ $value }}</option>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                    @endforeach
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="stok" value="STOK" />
                <x-text-input id="stok" type="number" name="stok" class="mt-1 block w-full bg-gray-100"
                value="{{ 0 }}" readonly />
                <x-input-error class="mt-2" :messages="$errors->get('stok')" />
            </div>
                        
            <div class="max-w-xl">
                <x-input-label for="satuan" value="SATUAN"/>
                <x-select-input id="satuan" name="satuan" class="mt-1 block w-full" required>
                    <option selected>Open this select menu</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Kilogram">Kilogram</option>
                    <option value="Pack">Pack</option>
                    <option value="Gram">Gram</option>
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="harga_satuan" value="HARGA SATUAN" />
                    <x-text-input id="harga_satuan" type="number" name="harga_satuan" class="mt-1 block w-full" value="{{ old('harga_satuan') }}" required/>
                <x-input-error class="mt-2" :messages="$errors->get('harga_satuan')" />
            </div>

            <x-secondary-button tag="a" href="{{ route('barang') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </form>
    </div>
</x-app-layout>