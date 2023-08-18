@props([
    'percent' => 0,
    'total' => 0,
    'value' => 0,
])

@php
    if ($total > 0) {
        $percent = $total > 0 ? round($value / $total * 100) : 0;
    }
@endphp

<div class="w-full bg-gradient-to-tr from-primary-600 to-primary-900 rounded-full border leading-none text-xs font-medium text-gray-100 text-center overflow-hidden">
    @if ($percent > 0)
        <div class="border-r bg-highlight-600 p-0.5 rounded-full" style="width: {{ $percent }}%"> {{ $percent }}%</div>
    @else
        <div class="p-0.5" style="width: 10%"> 0%</div>
    @endif
</div>