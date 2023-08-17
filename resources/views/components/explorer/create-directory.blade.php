@props(['initialPath'])

<x-modal name="create-directory" :show="true">

    <x-modal-header title="Create Directory" wire:click.prevent="cancelCreateDirectory" />

    <form action="#" class="p-6">
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2">
                <x-input-label for="name" value="Create directory in" />
                <span>{{ $initialPath }}</span>
            </div>
            {{-- Directory Name --}}
            <div class="sm:col-span-2">
                <x-input-label for="name" value="Name" />
                <x-text-input wire:model.lazy="newDirectory" type="text" />
                <x-input-error :messages="$errors->get('newDirectory')" />
            </div>
        </div>

        <div class="flex items-center py-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <x-action-button wire:click.prevent="createDirectory" class="flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Create
            </x-action-button>
        </div>

    </form>
</x-modal>