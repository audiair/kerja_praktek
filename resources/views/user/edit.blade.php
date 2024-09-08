<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Data User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form method="post" action="{{ route('user.update', $users->id) }}" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')
            <div class="max-w-xl">
                <x-input-label for="name" value="NAMA"/>
                <x-text-input id="name" type="text" name="name" class="mt-1 block w-full"
                value="{{ old('$name', $users->name) }}" required/>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="email" value="EMAIL" />
                <x-text-input id="email" type="text" name="email" class="mt-1 block w-full" readonly
                value="{{ old('email', $users->email) }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="max-w-xl">
                <x-input-label for="password" value="PASSWORD" />
                <x-text-input id="password" type="text" name="password" class="mt-1 block w-full"/>
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
            </div>

            
            <div class="max-w-xl">
                <x-input-label for="role" value="ROLE" />
                <x-select-input name="roles[]" class="mt-1 block w-full" id="role">
                    <option value="">Open this select menu</option>
                    @foreach ($roles as $role)
                    <option 
                        value="{{ $role }}" 
                        {{ in_array($role, $userRoles) ? 'selected' : '' }}
                        >
                        {{ $role }}
                    </option>
                    @endforeach
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('roles')" />
            </div>

            <x-secondary-button tag="a" href="{{ route('user') }}">Cancel</x-secondary-button>
            <x-primary-button name="save" value="true">Ubah</x-primary-button>
        </form>
    </div>
</x-app-layout>