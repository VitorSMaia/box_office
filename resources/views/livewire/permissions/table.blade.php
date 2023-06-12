<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nome
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $itemRole)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 hidden sm:table-cell">
                                            <img class="w-full h-full rounded-full"
                                                 src="https://images.unsplash.com/photo-1601046668428-94ea13437736?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2167&q=80"
                                                 alt="" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $itemRole['name'] }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                    @if(Auth::user()->can('create_permissions'))
                                        <x-button wire:click="open('permissions.form',{{ $itemRole['id'] }})">Editar</x-button>
                                    @endif
                                    @if(Auth::user()->can('update_permissions'))
                                        <x-button wire:click="open('permissions.permission', {{ $itemRole['id'] }})">Permissões</x-button>
                                    @endif
{{--                                    @if(Auth::user()->can('delete_permissions') && $itemRole['id'] !== 1)--}}
{{--                                        <x-button wire:click="drop({{ $itemRole['id'] }}, 'dropRole')">Deletar</x-button>--}}
{{--                                    @endif--}}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
