<div>
    @props(['id', 'maxWidth'])

    @php
        $id = $id ?? md5($attributes->wire('model'));

        $maxWidth = [
            'sm' => 'sm:max-w-sm',
            'md' => 'sm:max-w-md',
            'lg' => 'sm:max-w-lg',
            'xl' => 'sm:max-w-xl',
            '2xl' => 'sm:max-w-2xl',
        ][$maxWidth ?? '2xl'];
    @endphp

    <div
        x-data="{ show: @entangle('show') }"
        x-on:close.stop="show = false"
        x-on:keydown.escape.window="show = false"
        x-show="show"
        id="{{ $id }}"
        class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
        style="display: none;"
    >
        <div x-show="show" wire:click="close" class="fixed inset-0 transform transition-all" x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div x-show="show" class="p-5 mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
             x-trap.inert.noscroll="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="flex justify-end items-end w-full ">
                <button wire:click="close" class=" px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs
    text-white uppercase hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none
    focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    close
                </button>
            </div>
            @if($component)

                @livewire($component,['id' => $idParameter])
            @endif
            @if($showDropModal)
                <div class="flex flex-col gap-5 ">
                    <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Event') }}
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
</div>
