<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <p class="font-semibold">
            {{ __("SELAMAT DATANG DI WEBSITE PERSEDIAAN JAYA ABADI PS (PETSHOP)!")  }}
        </p>    
    </div>
    </br>

    <div class="inline-flex">
        <img width="500" src="{{asset('/logo/ps1.jpg')}}" alt="" class="mr-8">
        <img width="500" src="{{asset('/logo/ps2.jpg')}}" alt="">
    </div>
 
</x-app-layout>
