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
                <x-input-label for="id_barang" value="NAMA BARANG" />
                <x-select-input id="id_barang" name="id_barang" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($barangs as $barang)
                    @if (old('id_barang',  $barang_keluars->id_barang) == $barang->id)
                        <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}" selected>{{ $barang->nama_barang }} - Rp. {{number_format ($barang->harga_satuan) }}</option>
                    @else
                        <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}">{{ $barang->nama_barang }} - Rp. {{number_format ($barang->harga_satuan) }}</option>
                    @endif
                    @endforeach
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="jml_keluar" value="JUMLAH KELUAR" />
                <x-text-input id="jml_keluar" type="number" name="jml_keluar" class="mt-1 block w-full"
                value="{{ old('jml_keluar', $barang_keluars->jml_keluar) }}" required />
                <x-text-input id="jml_keluar_lama" type="hidden" name="jml_keluar_lama" class="mt-1 block w-full"
                value="{{ $barang_keluars->jml_keluar}}" required />
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
                    <option value="{{ old('keterangan', $barang_keluars->keterangan) }}" selected> {{ $barang_keluars->keterangan }}</option>
                    <option value="Terjual">Terjual</option>
                    <option value="Terpakai">Terpakai</option>
                    <option value="Kadaluarsa">Kadaluarsa</option>  
                </x-select-input>
            </div>

            <div class="max-w-xl">
                <x-input-label for="stok" value="STOK" />
                <x-text-input id="stok" type="number" name="stok" class="mt-1 block w-full bg-gray-200"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('stok')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="total_stok" value="TOTAL STOK" />
                <x-text-input id="total_stok" type="number" name="total_stok" class="mt-1 block w-full bg-gray-200"
                readonly />
                <x-input-error class="mt-2" :messages="$errors->get('total_stok')" />
            </div>

            <x-secondary-button tag="a" href="{{ route('barang_keluar') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Ubah</x-primary-button>
        </form>
    </div>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const selectBarang = document.getElementById('id_barang');
    const inputJmlKeluar = document.getElementById('jml_keluar');
    const inputJmlKeluar_lama = document.getElementById('jml_keluar_lama');
    const inputStok = document.getElementById('stok');
    const inputTotalStok = document.getElementById('total_stok');

    function updateStok() {
        const selectedOption = selectBarang.options[selectBarang.selectedIndex];
        const stok = selectedOption.getAttribute('data-stok');
        const jmlKeluar_lama = parseInt(inputJmlKeluar_lama.value) || 0;
        const jmlKeluar = parseInt(inputJmlKeluar.value) || 0;

        let updatedStok = stok ? parseInt(stok) : 0;

        updatedStok += jmlKeluar_lama;
        inputStok.value = updatedStok;
        inputTotalStok.value = updatedStok - jmlKeluar;  
    }

    selectBarang.addEventListener('change', updateStok);
    inputJmlKeluar.addEventListener('input', updateStok);

    updateStok();

});
</script>
