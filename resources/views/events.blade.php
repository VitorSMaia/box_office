<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos') }}
        </h2>
        @if(Auth::user()->can('create_events'))
            @livewire('components.button', ['Cadastrar','event.form'])
        @endif
    </x-slot>
    <div class="py-12 px-5">
        <div class="mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->can('list_events'))
                @livewire('event.table')
            @endif
        </div>
    </div>
</x-app-layout>
