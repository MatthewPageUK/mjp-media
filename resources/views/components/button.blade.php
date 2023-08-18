@if ($attributes->has('href'))
    <a {{ $attributes->merge(['class' => 'flex items-center gap-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-1 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center gap-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:ring-offset-1 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@endif