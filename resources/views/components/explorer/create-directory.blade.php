@props(['initialPath'])

<x-modal name="create-directory" :show="true">

    <x-modal-header title="Create Directory" wire:click.prevent="cancelCreateDirectory" />

    <form action="#" class="p-6 bg-gradient-to-tr from-primary-600 to-primary-900">
        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
            <div class="sm:col-span-2 text-gray-100">
                Create a new directory in
                <span class="font-semibold">/home{{ $initialPath }}</span>
            </div>
            {{-- Directory Name --}}
            <div class="sm:col-span-2">
                <x-input-label for="name" value="Directory name" class="text-gray-100" />
                <x-text-input wire:model.lazy="newDirectory" type="text" class="text-xl" />
                <x-input-error :messages="$errors->get('newDirectory')" />
            </div>
        </div>

        <div class="py-6 pt-12 space-x-2 rounded-b text-right">
            <x-primary-button wire:click.prevent="createDirectory">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Create Directory
            </x-primary-button>
        </div>

    </form>
</x-modal>
