    <div class="py-12 md:py-0 text-gray-100">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">


            <div class="overflow-hidden border-b">

                <div class="py-8 flex items-center gap-8">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                      </svg>
                      <div class="flex-1 grid grid-cols-4 gap-x-4 gap-y-4 items-center text-3xl">

                        <span class="">Disk space</span>
                        <span class="col-span-3">{{ Str::humanFileSize(disk_total_space('/')) }}</span>

                        <span class="">Free space</span>
                        <span class="col-span-3">{{ Str::humanFileSize(disk_free_space('/')) }}</span>

                        <span class="">Used</span>
                        <span class="col-span-3">{{ Str::humanFileSize(disk_total_space('/') - disk_free_space('/')) }}</span>

                      </div>
                </div>
            </div>

            <div class="overflow-hidden border-b">
                <div class="py-8 text-gray-100 flex items-center gap-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <div class="flex-1 grid grid-cols-4 gap-x-4 gap-y-2 items-center text-3xl">
                        <span class="">Assigned</span>
                        <span class="col-span-3">{{ Str::humanFileSize(UserStorage::getTotalSpace()) }}</span>

                        <span class="">Assigned to users</span>
                        <span class="col-span-3">{{ Str::humanFileSize(UserStorage::getAssignedSpace()) }}</span>

                        <span class=""></span>
                        <div class="col-span-2">
                            <x-progress-bar :total="UserStorage::getTotalSpace()" :value="UserStorage::getAssignedSpace()" />
                        </div>
                        <span class=""></span>

                        <span class="">Un-assigned</span>
                        <span class="col-span-3">{{ Str::humanFileSize(UserStorage::getUnassignedSpace()) }}</span>

                        <span class="">Used</span>
                        <span class="col-span-3">{{ Str::humanFileSize(UserStorage::getUsedSpace()) }} in {{ UserStorage::getTotalFiles() }} files</span>
                        <span class=""></span>
                        <div class="col-span-2">
                            <x-progress-bar :total="UserStorage::getTotalSpace()" :value="UserStorage::getUsedSpace()" />
                        </div>
                        <span class=""></span>

                    </div>
                </div>
            </div>

            <div class="overflow-hidden border-b">
                <div class="py-8 text-gray-100 text-3xl flex items-center gap-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75v6.75m0 0l-3-3m3 3l3-3m-8.25 6a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                      </svg>

                    <div class="flex-1 grid grid-cols-4 gap-x-4 gap-y-2 items-center">
                        <span class="col-span-2">Bandwidth (30 days)</span><span class="col-span-2">-</span>
                        <span class="col-span-2">Bandwidth per day</span><span class="col-span-2">-</span>
                    </div>
                </div>
            </div>


        </div>
    </div>
