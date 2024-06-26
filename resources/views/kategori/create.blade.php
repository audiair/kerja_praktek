<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Kategori Barang') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <?php
            $kategori = \App\Models\Kategori::latest()->first();
            $kode = "KTG";
            if($kategori == null){
                $nomorUrut = "01";
            }else{
                $nomorUrut = substr($kategori->kode_kategori, 3, 2) + 1;
                $nomorUrut = str_pad($nomorUrut, 2, "0", STR_PAD_LEFT);
            }

            $kodeKategori = $kode . $nomorUrut;
        ?>

        <form method="post" action="{{ route('kategori.store') }}" class="mt-6 space-y-6">
            @csrf
            <div class="max-w-xl">
                <x-input-label for="kode_kategori" value="KODE KATEGORI"/>
                <x-text-input id="kode_kategori" type="text" name="kode_kategori"  value="{{ $kodeKategori }}" class="mt-1 block w-full bg-gray-100" readonly/>
                <x-input-error class="mt-2" :messages="$errors->get('kode_kategori')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="kategori_barang" value="KATEGORI BARANG" />
                <x-text-input id="kategori_barang" type="text" name="kategori_barang" class="mt-1 block w-full"
                value="{{ old('kategori_barang') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('kategori_barang')" />
            </div>
                        
            <x-secondary-button tag="a" href="{{ route('kategori') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </form>
    </div>
</x-app-layout>