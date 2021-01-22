@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-normal text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
