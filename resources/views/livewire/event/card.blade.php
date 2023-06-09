<div>
    <div class="flex justify-between items-center">
        <span class="text-2xl font-extralight">
            {{ $event['name'] }}
        </span>
    </div>
    <img class="w-full h-60 bg-cover" src="{{ $event['image'] }}" alt="{{ $event['name'] }}">
    <p> <span class="font-semibold">Início da exposição:</span> {{ formart_date($event['initial_validity']) }}</p>
    <p> <span class="font-semibold">Último dia:</span> {{ formart_date($event['final_validity']) }}</p>
    <p> <span class="font-semibold">Valor da entrada:</span> {{ formart_decimal($event['value']) }}</p>
    <p> <span class="font-semibold">Descrição:</span> {{ $event['description'] }} </p>
</div>
