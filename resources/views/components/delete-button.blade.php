<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-gray-100 inline-flex items-center border border-gray-200 text-gray-600 hover:bg-red-400 hover:text-white rounded font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
