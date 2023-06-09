<div>
    <div wire:loading wire:target="save" class="bg-gray-500/75 w-screen h-screen absolute z-10 transform transition-all">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-28 w-28 absolute top-20 left-72"></div>
    </div>
    <form wire:submit.prevent="save" class="grid grid-cols-12 gap-5">
        <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
            Evento: {{ $event['name'] }}
        </h2>
        <label class="col-span-12 flex flex-col">
            <p>{{ $event['description'] }}</p>
        </label>
        <label class="col-span-6 flex flex-col" for="date">
            <span>Data do evento</span>
            <x-input id="date" model="date" wire:model="state.date" min="{{ now()->format('Y-m-d') }}" max="{{ $event['final_validity'] }}"  type="date" />
        </label>
        <label class="col-span-6 flex flex-col" for="hour">
            <span>Hora do evento</span>
            <select id="hour" model="hour" wire:model.defer="state.hour" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Selecione...</option>
                @foreach($hours as $key => $itemHour)
                    @if($state['date'] == now()->format('Y-m-d'))
                        @if($key > now()->format('H'))
                            <option value="{{ $key }}">Evento das {{ $key }}:00 até {{ $key + 1 }}:00</option>
                       @endif
                    @elseif(!is_null($state['date']))
                        <option value="{{ $key }}">Evento das {{ $key }}:00 até {{ $key + 1 }}:00</option>
                    @endif
                @endforeach
            </select>
            @error('hour')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </label>
        <x-button class="col-span-12" >Comprar</x-button>
    </form>
</div>
