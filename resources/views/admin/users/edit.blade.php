<div class="py-8 px-4 mx-auto max-w-4xl lg:py-16">

    <div class="mb-8 justify-end flex gap-2">
        <h1 class="flex-1 text-4xl font-semibold text-gray-900 dark:text-white">Edit User</h1>
        <x-secondary-button href="{{ route('users') }}">
            Cancel
        </x-secondary-button>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

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
                        <span class="ml-2 text-gray-500 whitespace-nowrap text-sm font-bold">{{ VirtualStorage::getUnassignedSpace() }}Mb unassigned.</span>
                    </div>
                    <x-input-error :messages="$errors->get('user.capacity')" />
                </div>
                {{-- Password --}}
                {{-- <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input wire:model.lazy="user.password" type="password" />
                    <x-input-error :messages="$errors->get('user.password')" />
                </div> --}}
                {{-- Confirm password --}}
                {{-- <div>
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <x-text-input wire:model.lazy="user.password_confirmation" type="password" />
                    <x-input-error :messages="$errors->get('user.password_confirmation')" />
                </div> --}}

            </div>

            <div class="mt-16">
                <x-primary-button wire:click.prevent="save" type="button">
                    Save changes
                </x-primary-button>

                <x-primary-button href="{{ route('user.delete', $this->user) }}">
                    Delete user
                </x-primary-button>

            </div>
        </form>
    </div>
</div>
