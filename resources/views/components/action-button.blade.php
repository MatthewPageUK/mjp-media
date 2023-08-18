
<x-button {{ $attributes->merge(['class' => 'border-0 bg-gradient-to-bl from-blue-500 to-blue-800 text-gray-200 hover:text-amber-300 hover:from-blue-600 hover:to-blue-900 active:bg-green-700 focus:ring-green-500']) }}>
    {{ $slot }}
</x-button>

{{--
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}
