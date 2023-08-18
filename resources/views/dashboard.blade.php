<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 md:py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (Auth::user()->isAdmin())

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                      </svg>
                      <div class="flex-1 grid grid-cols-4 gap-x-4 gap-y-2 items-center">

                        <span class="text-sm text-gray-600">Disk space</span><span class="col-span-3">{{ floor(disk_total_space('/') / 1000000000) }} Gb</span>

                        <span class="text-sm text-gray-600">Free space</span><span class="col-span-3">{{ floor(disk_free_space('/') / 1000000000) }} Gb</span>

                      </div>
                </div>
            </div>

@php
$file_size = 0;
$files = 0;
foreach( Storage::allFiles('public/users') as $file)
{
    //$file_size += Storage::size($file);
    $files++;
}
// echo number_format($file_size / 1048576,2);
@endphp

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <div class="flex-1 grid grid-cols-4 gap-x-4 gap-y-2 items-center">
                        <span class="text-sm text-gray-600">Storage assigned</span><span class="col-span-3">{{ VirtualStorage::getTotalSpace() }}Mb</span>
                        <span class="text-sm text-gray-600">Storage assigned to users</span><span class="col-span-3">{{ VirtualStorage::getAssignedSpace() }}Mb</span>
                        <span class="text-sm text-gray-600">Storage un-assigned</span><span class="col-span-3">{{ VirtualStorage::getUnassignedSpace() }}Mb</span>
                        <span class="text-sm text-gray-600">Storage used</span><span class="col-span-3">{{ number_format(VirtualStorage::getUsedSpace(), 2) }}Mb in {{ VirtualStorage::getTotalFiles() }} files</span>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                      </svg>

                    <div class="flex-1 grid grid-cols-4 gap-x-4 gap-y-2 items-center">
                        <span class="text-sm text-gray-600">Bandwidth (30 days)</span><span class="col-span-3">-</span>
                        <span class="text-sm text-gray-600">Bandwidth per day</span><span class="col-span-3">-</span>
                    </div>
                </div>
            </div>

            @endif

            @if (! Auth::user()->isAdmin())

{{-- User --}}



@php
$file_size = 0;
$files = 0;
foreach( Storage::allFiles(Auth::user()->storagePath) as $file)
{
    $file_size += Storage::size($file);
    $files++;
}
// echo number_format($file_size / 1048576,2);
@endphp


            <div class="space-y-8 md:space-y-32">
                <p class="md:px-12 text-center text-gray-100 text-4xl font-light md:text-right">Welcome back {{ Auth::user()->name }}.</p>

                <div class="space-y-4 md:space-y-8">
                    <h1 class="text-4xl md:text-6xl md:px-8 text-center md:text-left font-black tracking-tight text-gray-100">Storage Capacity</h1>
                    <p class="text-4xl md:text-6xl font-black px-12 py-4 text-center md:text-left bg-green-300 rounded-full">{{ Auth::user()->capacity }}Mb</p>
                </div>

                <div class="space-y-4 md:space-y-8">
                    <h1 class="text-4xl md:text-6xl md:px-8 text-center md:text-left font-black tracking-tight text-gray-100">Storage Used</h1>

                    <div class="text-2xl md:text-5xl font-black px-12 py-4 text-center md:text-left  bg-amber-300 rounded-full">{{ number_format($file_size / 1000000, 2) }} Mb in {{ $files }} files
                        <div class="w-full bg-amber-400 rounded-full mt-2">
                            <div class="bg-amber-600 text-xs font-black text-amber-300 text-center p-1 leading-none rounded-full" style="width: {{ Auth::user()->capacityUsedPercent }}%">
                                {{ Auth::user()->capacityUsedPercent }}%
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        @endif
        </div>
    </div>
</x-app-layout>
