<div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5">
        @foreach($events as $itemEvent)
            <div class="bg-white shadow-2xl h-max w-full rounded-xl col-span-2 p-2 flex flex-col gap-y-5">
                <div class="flex justify-between items-center">
                    <span class="text-2xl font-extralight">
                        {{ $itemEvent['name'] }}
                    </span>
                    @if(Auth::user()->can('delete_events'))
                        <x-button wire:click="drop({{ $itemEvent['id'] }}, 'dropEvent')" class="text-red-500 cursor-pointer material-symbols-outlined">
                            Delete
                        </x-button>
                    @endif

                </div>
                <img class="w-full h-60 object-contain bg-contain"  src="{{  route('show.image', ['id' => $itemEvent['image']]) }}" alt="{{ $itemEvent['name'] }}">
                <p class="truncate">
                    {{ $itemEvent['description'] }}
                </p>
                <div class="flex justify-end items-center gap-x-2">
                    @if(Auth::user()->can('update_events'))
                        <x-button wire:click="open('event.form', {{ $itemEvent['id'] }})">Editar</x-button>
                    @endif
                    @if(Auth::user()->can('buy_events'))
                        <x-button wire:click="open('event.buy-ticket', {{ $itemEvent['id'] }})">Comprar</x-button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
