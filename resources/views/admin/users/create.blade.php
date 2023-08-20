<div class="mx-auto max-w-3xl">

    {{-- Header --}}
    <div class="mb-16 justify-end flex items-center">
        <h1 class="flex-1 text-5xl font-semibold text-gray-100 tracking-tight">Create User</h1>
        {{-- Create User --}}
        <x-primary-button href="{{ route('users') }}">
            Cancel
        </x-primary-button>
    </div>

    <div class="overflow-hidden">
        <form action="#">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                {{-- Name --}}
                <div class="sm:col-span-2">
                    <x-input-label for="name" value="Name" class="text-gray-100" />
                    <x-text-input wire:model.lazy="user.name" type="text" />
                    <x-input-error :messages="$errors->get('user.name')" />
                </div>
                {{-- Email --}}
                <div class="sm:col-span-2">
                    <x-input-label for="email" value="Email" class="text-gray-100" />
                    <x-text-input wire:model.lazy="user.email" type="text" />
                    <x-input-error :messages="$errors->get('user.email')" />
                </div>
                {{-- Storage directory --}}
                <div class="sm:col-span-2">
                    <x-input-label for="directory" value="Storage directory" class="text-gray-100" />
                    <x-text-input wire:model.lazy="user.directory" type="text" />
                    <x-input-error :messages="$errors->get('user.directory')" />
                </div>
                {{-- Active status --}}
                <div>
                    <x-input-label for="active" value="Status" class="text-gray-100" />
                    <select wire:model="user.active"  id="active" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="">Select status</option>
                        <option value="0">Suspended</option>
                        <option value="1">Active</option>
                    </select>
                    <x-input-error :messages="$errors->get('user.active')" />
                </div>
                {{-- Storage Capacity --}}
                <div>
                    <x-input-label for="capacity" value="Storage capacity (Mb)" class="text-gray-100" />
                    <div class="flex items-center">
                        <x-text-input wire:model.lazy="user.capacity" type="number" />
                        <span class="ml-2 text-gray-300 whitespace-nowrap text-sm font-bold">{{ Str::humanFileSize(UserStorage::getUnassignedSpace()) }} unassigned.</span>
                    </div>
                    <x-input-error :messages="$errors->get('user.capacity')" />
                </div>
                {{-- Password --}}
                <div>
                    <x-input-label for="password" value="Password" class="text-gray-100" />
                    <x-text-input wire:model.lazy="user.password" type="password" />
                    <x-input-error :messages="$errors->get('user.password')" />
                </div>
                {{-- Confirm password --}}
                <div>
                    <x-input-label for="password_confirmation" value="Confirm Password" class="text-gray-100" />
                    <x-text-input wire:model.lazy="user.password_confirmation" type="password" />
                    <x-input-error :messages="$errors->get('user.password_confirmation')" />
                </div>

            </div>

            <div class="mt-16 text-right">
                <x-primary-button wire:click.prevent="save">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                    Create new user</x-primary-button>
            </div>
        </form>
        </div>
      </section>


</div>