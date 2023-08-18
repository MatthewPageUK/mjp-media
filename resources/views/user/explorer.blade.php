{{--
    User file explorer view
--}}
<div class="mt-12 lg:mt-0">

    {{-- Session messages --}}
    <x-session-messages />

    <div class="md:flex items-center gap-2 mb-8 space-y-4">

        {{-- Title --}}
        <h1 class="flex-1 text-4xl md:text-6xl font-black tracking-tight text-gray-100">File Explorer</h1>

        {{-- Create directory --}}
        <x-action-button wire:click.prevent="showCreateDirectory">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
            </svg>
            <span class="hidden sm:inline">Create Directory</span>
        </x-action-button>

        {{-- Upload file --}}
        <x-action-button wire:click.prevent="showFileUpload()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
            </svg>
            <span class="hidden sm:inline">Upload File</span>
        </x-action-button>

        {{-- File list mode --}}
        @switch ($this->mode)
            @case ('preview')
                {{-- View list --}}
                <x-action-button wire:click.prevent="setListMode" title="View files in a list">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </x-action-button>
            @break

            @default
                {{-- View grid and preview --}}
                <x-action-button wire:click.prevent="setPreviewMode" title="View files in a grid with image preview">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </x-action-button>
        @endswitch
    </div>

    {{-- Explorer location bar (current directory) --}}
    <x-explorer.location-bar :directory="$directory" />

    {{-- Directories --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 text-gray-100 text-sm mb-8">

        @if ($this->directory !== '/')
            {{-- Go up one directory --}}
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

    {{-- Files --}}
    @if ($this->mode === 'list')

        {{-- List files in a table --}}
        <table class="w-full table-auto text-gray-100 text-sm">
            <thead>
                <tr class="border-b border-gray-400 text-gray-400 text-xs">
                    <th class="w-8 font-light"></th>
                    <th class="text-left pb-2 font-light">Name</th>
                    <th class="hidden lg:table-cell text-left w-48 pb-2 font-light">Type</th>
                    <th class="hidden lg:table-cell text-left w-24 pb-2 font-light">Size</th>
                    <th class="text-right w-24 pb-2 font-light"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->files as $file)
                    <x-explorer.file :name="$file['name']" :path="$file['path']" :mode="$this->mode" />
                @empty
                    <tr>
                        <td colspan="4" class="text-5xl tracking-tight font-light text-center py-16 opacity-70">No files found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @else

        {{-- List files in a grid --}}
        <div class="text-sm text-gray-100 space-y-2 grid grid-cols-1 lg:grid-cols-4 gap-16">
            @forelse ($this->files as $file)
                <x-explorer.file :name="$file['name']" :path="$file['path']" :mode="$this->mode" />
            @empty
                <p class="lg:col-span-4 text-5xl tracking-tight font-light text-center py-16 opacity-70">No files found</p>
            @endforelse
        </div>

    @endif

    @if ($this->showFileUpload)
        {{-- File upload modal --}}
        <x-explorer.file-upload />
    @endif

    @if ($this->showFile)
        {{-- File details modal --}}
        <x-explorer.file-details :name="$this->file['name']" :path="$this->file['path']" :url="$this->getFileUrl()" />
    @endif

    @if ($this->showCreateDirectory)
        {{-- Create directory modal --}}
        <x-explorer.create-directory :initial-path="$this->directory" />
    @endif

    @if ($this->showDeleteDirectory)
        {{-- Delete Directory Modal --}}
        <x-explorer.delete-directory :directory="$this->directory" />
    @endif

</div>
