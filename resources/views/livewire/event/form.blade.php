<div>
    <div wire:loading wire:target="save" class="bg-gray-500 bg-opacity-75 w-screen -top-5 left-0  min-h-screen absolute z-50 transform transition-all">
        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-64 w-64 absolute top-64 left-52 "></div>
    </div>
    <form wire:submit.prevent="save" class="grid grid-cols-12 gap-5">
        <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
            {{ $event_id ? 'Editar evento' : 'Cadastrar  evento' }}
        </h2>

        <label class="col-span-6 flex flex-col" for="name">
            <span>Nome</span>
            <x-input id="name" model="name" wire:model.defer="state.name"  type="text"/>
        </label>
        <label class="col-span-6 flex flex-col" for="value">
            <span>Valor do Ingresso </span>
            <input x-mask:dynamic="$money($input, ',', ' ')" placeholder="0.00" id="value" {{ !is_null($event_id) ? 'disabled' : 'false' }}  model="value" wire:model.defer="state.value"  type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  disabled:bg-gray-800/25"/>
            @error('value')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </label>

        <div  class="col-span-12"
              x-data="{ isUploading: true, progress:0}"
              x-on:livewire-upload-start="isUploading = true"
              x-on:livewire-upload-finish="isUploading = true"
              x-on:livewire-upload-error="isUploading = false"
              x-on:livewire-upload-progress="progress = $event.detail.progress"
        >

            <div x-show="isUploading">
                <labe>Prgresso Upload: </labe>
                <progress class="w-full rounded-lg h-2" max="100" x-bind:value="progress"></progress>
            </div>
            <div class="flex items-center justify-center bg-gray-100 font-sans h-max col-span-12">
                <label for="dropzone-file" class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>

                    <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">File</h2>

                    <p class="mt-2 text-gray-500 tracking-wide">Upload</p>

                    <input wire:model="state.image" accept="image/*" id="dropzone-file" type="file" class="hidden" />
                </label>
            </div>
        </div>


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

        @if(!$event_id)
            <label class="col-span-12 flex flex-col" for="ticket">
                <span>Quantos ingressos por horário:</span>
            </label>

            @foreach($state['tickets'] as $key => $schedule)
                <div class="col-span-4 ">
                    <div class="flex flex-col">
                        <span>Entre {{ $key }}:00 e  {{ $key + 1 }}:00</span>
                        <input id="ticket" {{ !is_null($event_id) ? 'disabled' : 'false' }}  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:bg-gray-800/25" wire:model.defer="state.tickets.{{ $key }}" value="{{ $schedule }}" min="0" max="500" type="number"/>
                    </div>
                    @error("tickets.$key")
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            @endforeach
        @endif

        <x-button class="col-span-12" >{{ $event_id ? 'Editar' : 'Salvar' }}</x-button>
    </form>
</div>
