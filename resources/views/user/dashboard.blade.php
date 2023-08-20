{{--
    User Dashboard
--}}
<div class="py-12 md:py-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
        <div class="space-y-8 md:space-y-32">

            {{-- Welcome --}}
            <p class="md:px-12 text-center text-gray-100 text-4xl font-light md:text-right">Welcome back {{ Auth::user()->name }}.</p>

            {{-- Capacity assigned --}}
            <div class="space-y-4 md:space-y-8">
                <h1 class="text-4xl md:text-6xl md:px-8 text-center md:text-left font-black tracking-tight text-gray-100">Storage Capacity</h1>
                <p class="text-highlight-900 transition-all hover:scale-110 text-4xl md:text-6xl font-light px-12 py-4 text-center md:text-left bg-highlight-300 rounded-full">
                    {{ Str::humanFileSize(Auth::user()->capacityBytes) }}
                </p>
            </div>

            {{-- Capacity used --}}
            <div class="space-y-4 md:space-y-8">
                <h1 class="text-4xl md:text-6xl md:px-8 text-center md:text-left font-black tracking-tight text-gray-100">Storage Used</h1>

                <div class="text-secondary-900 transition-all hover:scale-110 text-2xl md:text-5xl font-light px-12 py-4 text-center md:text-left  bg-secondary-300 rounded-full">
                    {{ Str::humanFileSize(Auth::user()->capacityUsed) }} in {{ Auth::user()->totalFiles }} files
                    <x-progress-bar :percent="Auth::user()->capacityUsedPercent" />
                </div>



            </div>
        </div>
    </div>
</div>
