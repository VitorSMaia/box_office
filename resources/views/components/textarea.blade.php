@props(['disabled' => false, 'model' => null])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>

</textarea>

    @error($model)
    <p class="text-sm text-red-600">{{ $message }}</p>
@enderror
