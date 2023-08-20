<div class="mx-auto max-w-3xl">

    {{-- Header --}}
    <div class="mb-16 justify-end flex items-center">
        <h1 class="flex-1 text-5xl font-semibold text-gray-100 tracking-tight">Edit User</h1>
        {{-- Cancel --}}
        <x-primary-button href="{{ route('users') }}">
            Cancel
        </x-primary-button>
    </div>

    <div class="text-gray-100">

        <form action="#">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                {{-- Name --}}
                <div class="sm:col-span-2">
                    <x-input-label for="name" value="Name" />
                    <x-text-input wire:model.lazy="user.name" type="text" />
                    <x-input-error :messages="$errors->get('user.name')" />
                </div>
                {{-- Email --}}
                <div class="sm:col-span-2">
                    <x-input-label for="email" value="Email" />
                    <x-text-input wire:model.lazy="user.email" type="text" />
                    <x-input-error :messages="$errors->get('user.email')" />
                </div>
                {{-- Storage directory --}}
                <div class="sm:col-span-2">
                    <x-input-label for="directory" value="Storage directory" />
                    <x-text-input disabled wire:model.lazy="user.directory" type="text" />
                    <x-input-error :messages="$errors->get('user.directory')" />
                </div>
                {{-- Active status --}}
                <div>
                    <x-input-label for="active" value="Status" />
                    <select wire:model="user.active"  id="active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Select status</option>
                        <option value="0">Suspended</option>
                        <option value="1">Active</option>
                    </select>
                    <x-input-error :messages="$errors->get('user.active')" />
                </div>
                {{-- Storage Capacity --}}
                <div>
                    <x-input-label for="capacity" value="Storage capacity (Mb)" />
                    <div class="flex items-center">
                        <x-text-input wire:model.lazy="user.capacity" type="number" />
                        <span class="ml-2 text-gray-300 whitespace-nowrap text-sm font-bold">{{ Str::humanFileSize(UserStorage::getUnassignedSpace()) }} unassigned.</span>
                    </div>
                    <x-input-error :messages="$errors->get('user.capacity')" />
                </div>
            </div>

            <div class="mt-16 grid grid-cols-2 items-center">
                <x-primary-button wire:click.prevent="save" type="button" class="justify-self-start">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Save changes
                </x-primary-button>

                <x-primary-button href="{{ route('user.delete', $this->user) }}" class="justify-self-end">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    Delete user
                </x-primary-button>

            </div>
        </form>
    </div>
</div>
