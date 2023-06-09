<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bilheteria') }}
        </h2>
        @if (Route::has('login'))
            <div class="hidden flex top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('events') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Eventos</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </x-slot>

    <div class="py-12 px-5">
        <div class="mx-auto sm:px-6 lg:px-8">
            @livewire('event.dashboard')
        </div>
    </div>
</x-app-layout>
