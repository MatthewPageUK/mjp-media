<section>

    <x-session-messages />

    {{-- Header --}}
    <div class="mb-8 justify-end flex items-center">
        <h1 class="flex-1 text-5xl font-semibold text-gray-100 tracking-tight">Storage Users</h1>
        {{-- Create User --}}
        <x-action-button href="{{ route('user.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
            </svg>
            Create user
        </x-action-button>
    </div>

    {{-- Users table --}}
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-100">
            <thead class="text-xs uppercase bg-primary-600">
                <tr>
                    <th scope="col" class="px-6 py-3 font-light">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 font-light">
                        Status
                    </th>
                    <th scope="col" class="hidden md:table-cell px-6 py-3 font-light">
                        Capacity
                    </th>
                    <th scope="col" class="hidden md:table-cell px-6 py-3 font-light">
                        Used
                    </th>
                    <th scope="col" class="hidden md:table-cell px-6 py-3 font-light w-[200px]">

                    </th>
                    <th scope="col" class="hidden md:table-cell px-6 py-3 font-light">
                        Files
                    </th>
                    <th scope="col" class="px-6 py-3 text-right font-light">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($this->users as $user)
                    <tr class="border-b text-gray-100 hover:text-gray-900 hover:bg-primary-400">
                        <th scope="row" class="flex items-center px-6 py-4 whitespace-nowrap dark:text-white">
                            {{-- <img class="w-10 h-10 rounded-full" src="/images/profile-picture-4.jpg" alt="Jese image"> --}}
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $user->name }}</div>
                                <div class="font-normal">{{ $user->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if ($user->active)
                                    <div class="h-3 w-3 rounded-full bg-green-500 mr-2 border"></div> Active
                                @else
                                    <div class="h-3 w-3 rounded-full bg-red-700 mr-2 border"></div> Suspended
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <div class="flex items-center">
                                <strong>{{ Str::humanFileSize($user->capacityBytes) }}</strong>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            {{-- <div class="flex items-center gap-2"> --}}
                                {{-- <div class="text-xs"> --}}
                                    {{ Str::humanFileSize($user->capacityUsed) }}
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            {{-- <div class="flex items-center"> --}}
                                <x-progress-bar :total="$user->capacityBytes" :value="$user->capacityUsed" />
                            {{-- </div> --}}
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            {{ $user->totalFiles }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 flex items-center justify-end">
                                <x-action-button href="{{ route('user.read', $user) }}" title="View user details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="sr-only">View</span>
                                </x-action-button>
                                <x-action-button href="{{ route('user.update', $user) }}" title="Edit user details">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <span class="sr-only">Edit</span>
                                </x-action-button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</section>
