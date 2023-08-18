<x-modal name="delete-directory" :show="true">

    <div id="alert-additional-content-2" class="shadow-lg col-span-2 p-8 text-red-800 border-2 border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Delete directory <span class="font-bold">{{ $this->directory }}</span></h3>
        </div>
        <div class="mt-2 mb-4 text-sm">
            <p>This action will delete the directory and remove all stored files or other directories in it. This action can not be un-done or reversed.</p>
            <p class="mt-8">
            <input type="checkbox" wire:model="confirmDeleteDirectory" value="1" class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out mr-2">
                I confirm deleting this directory and all files.
            </p>
            <x-input-error :messages="$errors->get('confirmDeleteDirectory')" />
        </div>
        <div class="mt-8 flex gap-2">
            <x-danger-button wire:click.prevent="deleteDirectory">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Delete
            </x-danger-button>
            <x-secondary-button wire:click.prevent="cancelDeleteDirectory" type="button">
                Cancel
            </x-secondary-button>
        </div>
    </div>
</x-modal>