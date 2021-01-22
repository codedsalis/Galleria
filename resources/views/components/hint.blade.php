@props(['value'])

<span {{ $attributes->merge(['class' => 'text-gray-500 text-sm']) }}>
    {{ $value ?? $slot }}
</span>
