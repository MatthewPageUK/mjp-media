<div class="py-8 px-8">

    <div class="mb-8 justify-end flex">
        <h1 class="flex-1 text-4xl font-semibold text-gray-900 dark:text-white">Users</h1>
        <x-primary-button href="{{ route('user.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
              </svg>
            Create user
        </x-primary-button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-100 uppercase bg-blue-600 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Capacity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Used
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($this->users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            {{-- <img class="w-10 h-10 rounded-full" src="/images/profile-picture-4.jpg" alt="Jese image"> --}}
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $user->name }}</div>
                                <div class="font-normal text-gray-500">{{ $user->email }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if ($user->active)
                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Active
                                @else
                                    <div class="h-2.5 w-2.5 rounded-full bg-red-700 mr-2"></div> Suspended
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <strong>{{ $user->capacity }}</strong> <span class="text-xs">Mb</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="text-xs">
                                    {{ $user->capacityUsed }}Mb
                                </div>
                                <div class="bg-gray-200 border border-gray-500 flex-1 w-[75px]">
                                    <div
                                        @class(['text-xs leading-none py-1 text-center text-white',
                                            'bg-red-500' => $user->capacityUsedPercent > 85,
                                            'bg-yellow-500' => $user->capacityUsedPercent > 60 && $user->capacityUsedPercent <= 85,
                                            'bg-green-500' => $user->capacityUsedPercent <= 60,
                                        ])
                                        style="width: {{ $user->capacityUsedPercent }}%"></div>
                                </div>
                                <div class="text-xs">
                                    {{ $user->capacityUsedPercent }}&percnt;
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 flex items-center justify-end">
                                <x-primary-button href="{{ route('user.read', $user) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    View
                                </x-primary-button>
                                <x-primary-button href="{{ route('user.update', $user) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    Edit
                                </x-primary-button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
