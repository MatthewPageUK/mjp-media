@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-50 text-gray-900 text-sm rounded-lg
    focus:ring-secondary-400 focus:border-secondary-400
    block w-full p-2.5
    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
    ']) !!}>
