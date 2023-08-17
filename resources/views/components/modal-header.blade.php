
<div class="flex items-start justify-between p-4 bg-blue-500 ">
    <h3 class="text-xl font-semibold text-gray-100 dark:text-white">
        {{ $title }}
    </h3>
    <button
        {!! $attributes->filter(fn ($value, $key) => $key !== 'title')
            ->merge([
                'type' => 'button',
                'class' => 'text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white',
                'title' => 'Close'
            ]) !!}
    >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close modal</span>
    </button>
</div>
