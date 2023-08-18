<x-guest-layout>

        {{-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen selection:bg-red-500 selection:text-white"> --}}
            {{-- @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-200 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-200 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-200 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                {{-- <div class="flex justify-center">
                    <a href="/">
                        <x-application-logo class="w-[250px]" />
                    </a>
                </div> --}}

                <div>

                    <h1 class="text-4xl text-gray-200 mb-8 tracking-tight">Login to your storage</h1>

                    <div class="text-gray-200 p-6 bg-blue-900 bg-gradient-to-tl from-indigo-800 rounded-lg shadow-2xl shadow-gray-500/20 flex">

                        <x-auth.login />

                    </div>

                </div>

                <div class="text-gray-200 mt-16 px-0 sm:items-center sm:justify-between">

                    <div class="text-center text-sm">
                        MJP Media Manager by Matthew Page
                    </div>
                </div>
            </div>
        {{-- </div> --}}
</x-guest-layout>
