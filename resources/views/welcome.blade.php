<x-guest-layout>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div>
            <h1 class="text-4xl text-gray-200 my-8 tracking-tight">Login to your storage</h1>
            <div class="text-gray-200 p-6 bg-gradient-to-tr from-primary-600 to-primary-900 rounded-lg shadow-2xl shadow-gray-500/20 flex">
                <x-auth.login />
            </div>
        </div>
        <div class="text-gray-200 mt-16 px-0 sm:items-center sm:justify-between">
            <p class="text-center text-sm">
                <a href="https://mjp.co" target="_blank" class="hover:text-secondary-400 transition-all">
                    MJP Media Manager by Matthew Page
                </a>
            </p>
        </div>
    </div>
</x-guest-layout>
