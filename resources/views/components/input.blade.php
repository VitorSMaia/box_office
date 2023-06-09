@props(['disabled' => false, 'model' => null])

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>

@error($model)
    <p class="text-sm text-red-600">{{ $message }}</p>
@enderror
