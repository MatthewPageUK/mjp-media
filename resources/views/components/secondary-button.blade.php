<x-button {{ $attributes->merge(['class' => '
    bg-primary-400
    text-gray-200
    hover:bg-primary-500
    hover:text-gray-100
']) }}>
    {{ $slot }}
</x-button>
