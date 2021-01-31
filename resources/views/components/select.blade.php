@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:ring-4 focus:ring-primary-500 focus:ring-opacity-25
    rounded-md shadow-sm mt-1 block w-full text-gray-800',
    ]) !!}>
    {{ $slot }}
</select>
