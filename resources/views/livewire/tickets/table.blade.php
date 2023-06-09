<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Número do ticket
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nome Evento
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Dia Evento
                            </th>

                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Data da compra
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Usuário
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $itemTicket)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $itemTicket['ticket_number'] }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $itemTicket['event']['name'] }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm  text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ formart_date($itemTicket['event_date']) }} - {{ $itemTicket['hour'] }}:00 ás {{ $itemTicket['hour'] + 1 }}:00
                                    </p>
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ formart_datetime($itemTicket['buy_date']) }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $itemTicket['user']['name'] }}
                                    </p>
                                </td>
{{--                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm ">--}}
{{--                                    @if(Auth::user()->can('create_permissions'))--}}
{{--                                        <x-button wire:click="open('permissions.form',{{ $itemRole['id'] }})">Editar</x-button>--}}
{{--                                    @endif--}}
{{--                                    @if(Auth::user()->can('update_permissions'))--}}
{{--                                        <x-button wire:click="open('permissions.permission', {{ $itemRole['id'] }})">Permissões</x-button>--}}
{{--                                    @endif--}}
{{--                                    @if(Auth::user()->can('delete_permissions'))--}}
{{--                                        <x-button wire:click="drop({{ $itemRole['id'] }}, 'dropRole')">Deletar</x-button>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
