<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Barang Masuk') }}
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
                <x-input-label for="id_barang" value="NAMA BARANG" />
                <x-select-input id="id_barang" name="id_barang" class="mt-1 block w-full" required>
                    <option value="">Open this select menu</option>
                    @foreach ($barangs as $barang)
                    @if (old('id_barang',  $barang_masuks->id_barang) == $barang->id)
                        <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}" selected>{{ $barang->nama_barang }}</option>
                    @else
                        <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}">{{ $barang->nama_barang }}</option>
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

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const selectBarang = document.getElementById('id_barang');
    const inputJmlMasuk = document.getElementById('jml_masuk');
    const inputStok = document.getElementById('stok');
    const inputTotalStok = document.getElementById('total_stok');

    function updateStok() {
        const selectedOption = selectBarang.options[selectBarang.selectedIndex];
        const stok = selectedOption.getAttribute('data-stok');
        const jmlMasuk = inputJmlMasuk.value;

        inputStok.value = stok ? parseInt(stok) : 0;
        inputTotalStok.value = (stok && jmlMasuk) ? (parseInt(stok) + parseInt(jmlMasuk)) : inputStok.value;
    }

    selectBarang.addEventListener('change', updateStok);
    inputJmlMasuk.addEventListener('input', updateStok);

    updateStok();

    const selectedOption = selectBarang.options[selectBarang.selectedIndex];
    if (selectedOption) {
        const stok = selectedOption.getAttribute('data-stok');
        const jmlMasuk = inputJmlMasuk.value;

        inputStok.value = stok ? parseInt(stok) : 0;
        inputTotalStok.value = (stok && jmlMasuk) ? (parseInt(stok) + parseInt(jmlMasuk)) : inputStok.value;
    }
});
</script>
