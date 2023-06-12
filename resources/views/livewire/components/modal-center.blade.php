@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div x-data="{ show: @entangle('show') }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        wire:click="close"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="mb-6 p-5 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <div class="flex justify-end items-center">
            <button wire:click="close" class="button ">
                close
            </button>
        </div>

        @if($component)
            @livewire($component,['id' => $idParameter])
        @endif
        @if($showDropModal)
            <div class="flex flex-col gap-5 ">
                <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Deletar evento') }}
                </h2>
                <p>Você gostaria de deletar o item selecionado? </p>
                <p>Essa ação é irreversível
                    e o item será removido permanentemente. Por favor, confirme sua escolha respondendo
                    com 'Sim' para confirmar a exclusão ou 'Não' para cancelar a operação.</p>

                <div class="w-40 flex justify-between items-center">
                    <x-button wire:click="$set('choice', true)">Sim</x-button>
                    <x-button wire:click="$set('show', false)">Não</x-button>
                </div>
            </div>
        @endif
    </div>
</div>
