<div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-5">
        @foreach($events as $itemEvent)
            <div class="bg-white shadow-2xl h-max w-full rounded-xl col-span-2 p-2 flex flex-col gap-y-5">
                <div class="flex justify-between items-center">
                    <span class="text-2xl font-extralight">
                        {{ $itemEvent['name'] }}
                    </span>
                </div>
                <img class="w-full h-60 object-contain bg-contain"  src="{{  route('show.image', ['id' => $itemEvent['image']]) }}" alt="{{ $itemEvent['name'] }}">
                <p class="truncate">
                    {{ $itemEvent['description'] }}
                </p>
                <div class="flex justify-end items-center gap-x-2">
                    <x-button wire:click="open('event.card', {{ $itemEvent['id'] }})">Visualizar</x-button>
                    <a class="button" href="{{ route('events') }}" >Comprar</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
