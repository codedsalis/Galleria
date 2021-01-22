<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'button-primary inline-flex items-center px-5 py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
