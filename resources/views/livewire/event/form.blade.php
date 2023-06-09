<div>
    <div wire:loading wire:target="save" class="bg-gray-500 bg-opacity-75 w-screen h-screen absolute z-10 transform transition-all">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-64 w-64 absolute top-64 left-52"></div>
    </div>
    <form wire:submit.prevent="save" class="grid grid-cols-12 gap-5">
        <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
            {{ $event_id ? 'Editar evento' : 'Cadastrar  evento' }}
        </h2>

        <label class="col-span-6 flex flex-col" for="name">
            <span>Nome</span>
            <x-input id="name" model="name" wire:model.defer="state.name"  type="text"/>
        </label>

        <label class="col-span-6 flex flex-col" for="image">
            <span>Image</span>
            <x-input id="image" model="image" wire:model.defer="state.image"  type="text"/>
        </label>

{{--        <div class="col-span-12 flex flex-col">--}}
{{--            @if($state['image'])--}}
{{--                <img src="{{ $state['image']->temporaryUrl() ?? '' }}">--}}
{{--            @endif--}}
{{--        </div>--}}

        <label class="col-span-12 flex flex-col" for="description">
            <span>Descrição</span>
            <x-textarea wire:model.defer="state.description"  model="description"  />
        </label>

        <label class="col-span-12">
            <span>Periodo do Evento</span>
        </label>

        <label class="col-span-6 flex flex-col" for="initial_validity">
            <span>Data Inicial</span>
            <input id="initial_validity" {{ !is_null($event_id) ? 'disabled' : 'false' }} model="initial_validity" wire:model.defer="state.initial_validity"  type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  disabled:bg-gray-800/25"/>
            @error('initial_validity')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </label>

        <label class="col-span-6 flex flex-col" for="final_validity">
            <span>Data Final</span>
            <input id="final_validity" {{ !is_null($event_id) ? 'disabled' : 'false' }} model="final_validity" wire:model.defer="state.final_validity"  type="date" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  disabled:bg-gray-800/25"/>
            @error('final_validity')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

        </label>

        <label class="col-span-12 flex flex-col" for="value">
            <span>Valor do Ingresso </span>
            <input x-mask:dynamic="$money($input, ',', ' ')" placeholder="0.00" id="value" {{ !is_null($event_id) ? 'disabled' : 'false' }}  model="value" wire:model.defer="state.value"  type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  disabled:bg-gray-800/25"/>
            @error('value')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </label>

        @if(!$event_id)
            <label class="col-span-12 flex flex-col" for="ticket">
                <span>Quantos ingressos por horário:</span>
            </label>

            @foreach($schedules as $key => $schedule)
                <div class="col-span-4 ">
                    <div class="flex flex-col">
                        <span>Entre {{ $schedule }}:00 e  {{ $schedule + 1 }}:00</span>
                        <input id="ticket" {{ !is_null($event_id) ? 'disabled' : 'false' }}  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-gray-800/25" wire:model.defer="state.tickets.{{ $schedule }}" min="0" max="500" type="number"/>
                    </div>
                </div>
            @endforeach
        @endif

        <x-button class="col-span-12" >{{ $event_id ? 'Editar' : 'Salvar' }}</x-button>
    </form>
</div>
