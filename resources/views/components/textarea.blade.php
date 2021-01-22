@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:ring-2 focus:ring-primary-500 focus:ring-opacity-25
rounded-md shadow-sm mt-1 block w-full text-gray-800',
]) !!}></textarea>
