<div>
    <form wire:submit.prevent="save" class="grid grid-cols-12 gap-5 p-5">
        <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grupo') }}
        </h2>

        <label class="col-span-12 flex flex-col" for="name">
            <span>Nome</span>
            <x-input id="name" model="name" wire:model.defer="state.name"  type="text"/>
        </label>

        <button class="col-span-12">Salvar</button>
    </form>
</div>
