<x-button {{ $attributes->merge(['class' => '
    bg-gradient-to-b
    from-button-500
    to-button-800
    text-gray-200
    hover:text-secondary-300
    hover:from-button-500
    hover:to-button-700
    hover:shadow-lg
']) }}>
    {{ $slot }}
</x-button>