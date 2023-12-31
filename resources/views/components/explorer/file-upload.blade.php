<x-modal name="file-details" :show="true">

    <x-modal-header title="Upload a file" wire:click.prevent="cancelFileUpload" />


    <div class="p-6 space-y-6 bg-gradient-to-tr from-primary-600 to-primary-900">
        <form action="#">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                <div
                    class="col-span-2 overflow-hidden"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <!-- File Input -->
                    <input type="file" wire:model="newFile" class="text-gray-100">
                    <x-input-error :messages="$errors->get('newFile')" />

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>

            @if ($this->newFile)

                {{-- File Name --}}
                <div class="col-span-2">
                    <div class="grid grid-cols-2">
                        <x-input-label for="name" value="Name" class="text-gray-100" />
                        <p class="text-xs text-gray-300 font-light justify-self-end">Type : {{ $this->newFile->getMimeType() }}</p>
                    </div>
                    <x-text-input wire:model.lazy="newFileName" type="text" :value="$this->newFile->getClientOriginalName()" class="text-xl" />
                    <x-input-error :messages="$errors->get('newFileName')" />
                </div>

                <div class="col-span-2 text-gray-100">
                    Image Preview:
                        @if ($this->getNewFileTemporaryUrl())
                            <img src="{{ $this->getNewFileTemporaryUrl() }}" class="w-full">
                        @else
                            Preview not available for this file type.
                        @endif
                </div>

                <x-primary-button wire:click.prevent="uploadFile">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>

                    Upload File
                </x-primary-button>

            @endif

            </div>
        </form>
    </div>

</x-modal>

