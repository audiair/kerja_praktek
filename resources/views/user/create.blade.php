<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Tambah Data User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('user.store') }}" class="mt-6 space-y-6">
            @csrf
            <div class="max-w-xl">
                <x-input-label for="name" value="NAMA"/>
                <x-text-input id="name" type="text" name="name"  value="{{ old('name') }}"
                class="mt-1 block w-full" required/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="email" value="EMAIL" />
                <x-text-input id="email" type="text" name="email" class="mt-1 block w-full"
                value="{{ old('email') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="password" value="PASSWORD" />
                <x-text-input id="password" type="text" name="password" class="mt-1 block w-full"
                value="{{ old('password') }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>
                        
            <x-secondary-button tag="a" href="{{ route('user') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </form>
    </div>
</x-app-layout>