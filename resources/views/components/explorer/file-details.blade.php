@props(['name', 'path', 'url'])

<x-modal name="file-details" :show="true">

    <x-modal-header title="File details" wire:click.prevent="deselectFile" />

    <div class="p-6 space-y-6">

        <div class="grid grid-cols-1 gap-8">
            <dl class="grid grid-cols-2 text-sm">
                <dt class="font-bold">Name</dt>
                <dd>{{ $name }}</dd>
                <dt class="font-bold">Path</dt>
                <dd class="overflow-hidden">{{ $path }}</dd>
                <dt class="font-bold">Size</dt>
                <dd>{{ Storage::size($path) }}b</dd>
                <dt class="font-bold">Mime Type</dt>
                <dd>{{ Storage::mimeType($path) }}</dd>
                <dt class="font-bold">Last Modified</dt>
                <dd>{{ \Carbon\Carbon::parse(Storage::lastModified($path))->format('Y m d h m s') }}</dd>
            </dl>

            {{-- Preview --}}
            <div class="max-h-[300px] overflow-auto  border p-6">
                @if (Storage::mimeType($path) == 'image/jpeg' || Storage::mimeType($path) == 'image/png')
                    <img src="{{ Storage::url($path) }}" alt="" class="my-4 w-full">
                @endif

                @if (Storage::mimeType($path) == 'text/plain')
                    <pre class="my-4 text-xs">{{ Storage::get($path) }}</pre>
                @endif

                @if (Storage::mimeType($path) == 'text/markdown')
                    <div class="prose prose-sm">

                        {!! Str::markdown(Storage::get($path)) !!}

                    </div>
                @endif

                @if (Storage::mimeType($path) == 'application/x-httpd-php' || Storage::mimeType($path) == 'text/x-php')

                    <div>

                        {!! Str::markdown('`'.Storage::get($path).'`') !!}

                    </div>

                    {{-- <pre class="text-xs p-4 bg-black text-green-500 whitespace-break-spaces">{{ Storage::get($path) }}</pre> --}}
                @endif
            </div>
        </div>

    </div>

    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        {{-- Download --}}
        <x-action-button wire:click.prevent="downloadFile()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25" />
            </svg>
            Download
        </x-action-button>

        {{-- Open URL --}}
        <x-action-button href="{{ $url }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
            </svg>
            Open URL
        </x-action-button>

        {{-- Delete file --}}
        <x-secondary-button wire:click.prevent="deleteFile('{{ $path }}')" class="">Delete</x-secondary-button>

    </div>
</x-modal>