<div>
    <form wire:submit.prevent="save" class="grid grid-cols-12 gap-5 p-5">
        <h2 class="col-span-12 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grupo') }}
        </h2>

        <div class="col-span-12">
            @foreach($groupPermission as $itemGroupPermission)
                <h1>{{ $itemGroupPermission['name'] }} . {{ $itemGroupPermission['id'] }}</h1>
                @foreach($itemGroupPermission['permissons'] as $key => $itemPermission)
                    <label class="flex justify-start items-center gap-x-2" for="">
                        <input wire:model.defer="state.groupPermission" value="{{ $itemPermission['id'] }}" type="checkbox"/>
                        <span>{{ $itemPermission['label'] }} . {{ $itemPermission['id'] }}</span>
                    </label>
                @endforeach
            @endforeach
        </div>

        <button class="col-span-12">Salvar</button>
    </form>
</div>
