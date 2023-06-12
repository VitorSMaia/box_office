<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de usuários') }}
        </h2>
{{--        @if(Auth::user()->can('create_users'))--}}
{{--            @livewire('components.button', ['Cadastrar','permissions.form'])--}}
{{--        @endif--}}
    </x-slot>

    <div class="py-12 px-5">
        <div class="mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->can('list_users'))
                <div class="">
                    @livewire('users.table')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
