<div>
    <x-session-messages />

    <div class="flex items-center gap-2 mb-8">
        <h1 class="flex-1 text-4xl">File Explorer</h1>

        <x-action-button wire:click.prevent="showCreateDirectory">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            Create Directory
        </x-action-button>

        <x-action-button wire:click.prevent="showFileUpload()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
            </svg>
            Upload File
        </x-action-button>
    </div>

    <p class="flex gap-2 border rounded-lg px-4 py-2 bg-white font-mono mb-2">
        <span>Location : </span>
        <span class="flex-1">/home{{ $directory }}</span>
        @if ($this->directory !== '/')
            <button wire:click.prevent="showDeleteDirectory" title="Delete this directory">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                </svg>
            </button>
        @endif
    </p>

    {{-- <h2 class="text-lg font-semibold my-4">Directories</h2> --}}

    <div class="grid grid-cols-4 gap-4 border rounded-lg px-4 py-2 bg-white text-sm">
        @if ($this->directory !== '/')
            <button wire:click.prevent="goUp">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </button>
        @endif
        @foreach ($this->directories as $directory)
            <x-explorer.directory :directory="$directory['name']" />
        @endforeach
    </div>





    {{-- <h2>Files</h2> --}}
    <div class="border rounded-lg px-4 py-2 bg-white text-sm">
        @forelse ($this->files as $file)
            <x-explorer.file :name="$file['name']" :path="$file['path']" />
        @empty
            <p class="text-center my-4">No files found.</p>
        @endforelse
    </div>

    @if ($this->showFileUpload)
        <x-explorer.file-upload />
    @endif


    {{-- File info --}}
    @if ($this->showFile)
        <x-explorer.file-details :name="$this->file['name']" :path="$this->file['path']" :url="$this->getFileUrl()" />
    @endif

    @if ($this->showCreateDirectory)
        <x-explorer.create-directory :initial-path="$this->directory" />
    @endif

    @if ($this->showDeleteDirectory)
        {{-- Delete Directory Modal --}}

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
                    <input type="checkbox" wire:model="confirmDeleteDirectory" value="1" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out mr-2">
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
    @endif

</div>