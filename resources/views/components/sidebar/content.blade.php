<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >

    <x-slot name="icon">
        <x-icons.dashboard class="w-6 h-6" aria-hidden="true" />
    </x-slot>

    </x-sidebar.link>

    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Master Barang
    </div>

    <x-sidebar.link
        title="Barang"
        href="{{ route('barang') }}"
        :isActive="request()->routeIs('barang') || request()->routeIs('barang.create') || request()->routeIs('barang.edit')"
    >
    <x-slot name="icon">
        <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot>

    </x-sidebar.link>

    <x-sidebar.link
        title="Kategori Barang"
        href="{{ route('kategori') }}"
        :isActive="request()->routeIs('kategori') || request()->routeIs('kategori.create') || request()->routeIs('kategori.edit')"
    >
    
    <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Transaksi
    </div>

    <x-sidebar.link
        title="Barang Masuk"
        href="{{ route('barang_masuk') }}"
        :isActive="request()->routeIs('barang_masuk') || request()->routeIs('barang_masuk.create') || request()->routeIs('barang_masuk.edit')"
    >
    
    <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    
    <x-sidebar.link
        title="Barang Keluar"
        href="{{ route('barang_keluar') }}"
        :isActive="request()->routeIs('barang_keluar') || request()->routeIs('barang_keluar.create') || request()->routeIs('barang_keluar.edit')"
    >
    
    <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown>

</x-perfect-scrollbar>
