<div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">

    <div class="mb-8 justify-end flex gap-2">
        <h1 class="flex-1 text-4xl font-semibold text-gray-900 dark:text-white">User Details</h1>
        <x-primary-button href="{{ route('user.update', $this->user) }}">
            Edit user
        </x-primary-button>
        <x-secondary-button href="{{ route('users') }}">
            Back
        </x-secondary-button>
    </div>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

        <div class="grid grid-cols-2 gap-4 items-center">

            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <p>{{ $user->name }}</p>

            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <p>{{ $user->email }}</p>

            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Directory</label>
            <p>{{ $user->directory }}</p>

            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <p>{{ $user->active ? 'Active' : 'Suspended' }}</p>

            <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage capacity (Mb)</label>
            <div>{{ $user->capacity }}Mb</div>
            <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Storage used (Mb)</label>
            <div>
                <div>
                    {{ $user->capacityUsed }}Mb used in {{ $user->totalFiles }} files
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
            <label for="storage-path" class="col-span-2 block text-sm font-medium text-gray-900 dark:text-white">Storage path</label>
            <p class="text-sm col-span-2 mb-2 ">{{ Storage::path($user->storagePath) }} </p>

        </div>
    </div>

    <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

        <div class="grid grid-cols-2 gap-4 items-center">

            <div class="col-span-2">
                <h2 class="text-2xl mb-4">Storage ( {{ sizeof(Storage::allFiles($this->user->storagePath)) }} files )</h2>
                <div class="max-h-[500px] overflow-y-auto">
                    @foreach (Storage::allFiles($this->user->storagePath) as $file)
                        <div class="rounded-lg b-1 p-2 bg-primary-50 hover:bg-primary-200 text-xs flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="flex-1">{{ str_replace($this->user->storagePath, '', $file) }}</span>
                            {{ Storage::mimeType($file) }}
                            <span class="py-1 px-2 rounded-lg text-xs font-bold bg-primary-300">{{ Storage::size($file) }}b</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</div>