<div class="mt-12 lg:mt-0">
    <x-session-messages />

    <div class="md:flex items-center gap-2 mb-8 space-y-4">
        <h1 class="flex-1 text-4xl md:text-6xl font-black tracking-tight text-gray-100">File Explorer</h1>

        <x-action-button wire:click.prevent="showCreateDirectory">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <span class="hidden sm:inline">Create Directory</span>
        </x-action-button>

        <x-action-button wire:click.prevent="showFileUpload()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
            </svg>
            <span class="hidden sm:inline">Upload File</span>
        </x-action-button>

        @switch ($this->mode)

            @case ('preview')
                <x-action-button wire:click.prevent="setListMode" title="View files in a list">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </x-action-button>
            @break

            @default
                <x-action-button wire:click.prevent="setPreviewMode" title="View files in a grid with image preview">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>

                </x-action-button>

        @endswitch
    </div>

    <x-explorer.location-bar :directory="$directory" />

    {{-- <h2 class="text-lg font-semibold my-4">Directories</h2> --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 XXborder rounded-lg XXpx-4 XXpy-2 XXbg-white text-gray-100 text-sm mb-8">
        @if ($this->directory !== '/')
            <button wire:click.prevent="goUp" class="p-2 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
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

    @if ($this->mode === 'list')

        <table class="w-full table-auto text-gray-100 text-sm">
            <thead>
                <tr class="border-b border-gray-400 text-gray-400 text-xs">
                    <th class="w-8 font-light"></th>
                    <th class="text-left pb-2 font-light">Name</th>
                    <th class="hidden lg:table-cell text-left w-48 pb-2 font-light">Type</th>
                    <th class="hidden lg:table-cell text-left w-24 pb-2 font-light">Size</th>
                    <th class="text-right w-24 pb-2 font-light">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->files as $file)
                    <x-explorer.file :name="$file['name']" :path="$file['path']" :mode="$this->mode" />
                @empty
                    <tr>
                        <td colspan="4" class="text-5xl tracking-tight font-light text-center my-16 opacity-70">No files found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @else

        <div class="text-sm text-gray-100 space-y-2 grid grid-cols-1 lg:grid-cols-4 gap-16">
            @forelse ($this->files as $file)
                <x-explorer.file :name="$file['name']" :path="$file['path']" :mode="$this->mode" />
            @empty
                No files found

            @endforelse
        </div>

    @endif

{{--
    <div class="XXborder XXpx-4 XXpy-2 XXbg-white text-sm text-gray-100 space-y-2 @if($this->mode === 'preview') grid grid-cols-1 lg:grid-cols-4 gap-8 @endif">
        @forelse ($this->files as $file)
            <x-explorer.file :name="$file['name']" :path="$file['path']" :mode="$this->mode" />
        @empty
            <p class="text-5xl tracking-tight font-light text-center my-16 opacity-70">No files found</p>
        @endforelse
    </div> --}}

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
    @endif

</div>