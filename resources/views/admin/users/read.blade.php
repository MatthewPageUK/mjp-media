<div class="mx-auto max-w-3xl">

    {{-- Header --}}
    <div class="mb-16 justify-end flex items-center gap-2">
        <h1 class="flex-1 text-5xl font-semibold text-gray-100 tracking-tight">User Details</h1>
        {{-- Edit User --}}
        <x-action-button href="{{ route('user.update', $this->user) }}">
            Edit user
        </x-action-button>

        {{-- Back --}}
        <x-action-button href="{{ route('users') }}">
            Back
        </x-action-button>
    </div>

    <div class="text-gray-100">

        <div class="grid grid-cols-2 gap-4 items-center">

            <label for="name" class="block mb-2 text-sm font-medium">Name</label>
            <p>{{ $user->name }}</p>

            <label for="brand" class="block mb-2 text-sm font-medium">Email</label>
            <p>{{ $user->email }}</p>

            <label for="price" class="block mb-2 text-sm font-medium">Directory</label>
            <p>{{ $user->directory }}</p>

            <label for="category" class="block mb-2 text-sm font-medium">Status</label>
            <p>{{ $user->active ? 'Active' : 'Suspended' }}</p>

            <label for="item-weight" class="block mb-2 text-sm font-medium">Storage capacity (Mb)</label>
            <div>{{ $user->capacity }}Mb</div>
            <label for="item-weight" class="block mb-2 text-sm font-medium">Storage used (Mb)</label>
            <div>
                <div>
                    {{ Str::humanFileSize($user->capacityUsed) }} used in {{ $user->totalFiles }} files
                </div>
                <div class="flex items-center gap-2">

                    <div class="bg-gray-200 border border-gray-500 flex-1 w-[75px] rounded-full overflow-hidden">
                        <div
                            @class(['text-xs leading-none py-2 rounded-full',
                                'bg-red-500' => $user->capacityUsedPercent > 85,
                                'bg-yellow-500' => $user->capacityUsedPercent > 60 && $user->capacityUsedPercent <= 85,
                                'bg-green-500' => $user->capacityUsedPercent <= 60,
                            ])
                            style="width: {{ $user->capacityUsedPercent }}%"></div>
                    </div>
                    <div class="text-xs">
                        {{ $user->capacityUsedPercent }}&percnt;
                    </div>
                </div>
            </div>
            <label for="storage-path" class="col-span-2 block text-sm font-medium">Storage path</label>
            <p class="text-sm col-span-2 mb-2 ">{{ Storage::path($user->storagePath) }} </p>

        </div>
    </div>

    <div class="mt-8 text-gray-100">

        <div class="grid grid-cols-2 gap-4 items-center">

            <div class="col-span-2">
                <h2 class="text-4xl tracking-tight mb-4">Storage ( {{ $this->user->totalFiles }} files )</h2>
                <div class="max-h-[500px] overflow-y-auto pr-2">
                    @foreach (Storage::allFiles($this->user->storagePath) as $file)
                        <div class="rounded-lg b-1 p-2 hover:bg-secondary-400 hover:text-gray-900 text-xs flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="flex-1">{{ str_replace($this->user->storagePath, '', $file) }}</span>
                            {{ Storage::mimeType($file) }}
                            <span class="py-1 px-2 rounded-lg text-xs font-bold">{{ Str::humanFileSize(Storage::size($file)) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>