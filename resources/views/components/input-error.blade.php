@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'border mt-1 rounded-lg text-sm text-gray-200 space-y-1 bg-red-800 px-2 py-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                  </svg>

                {{ $message }}</li>
        @endforeach
    </ul>
@endif
