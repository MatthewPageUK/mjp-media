<div>


    <section class="XXbg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-4xl lg:py-16" x-data="{open: false, openfinal: false}">


            <div id="alert-additional-content-2" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <div class="flex items-center">
                  <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                  </svg>
                  <span class="sr-only">Info</span>
                  <h3 class="text-lg font-medium">Delete this user</h3>
                </div>
                <div class="mt-2 mb-4 text-sm">
                  <p>This action will delete the user account and remove all stored files. This action can not be un-done or reversed. Please ensure you have taken a backup of the user's files before deleting.</p>
                </div>
                <div class="flex gap-2">
                    <x-primary-button x-on:click="open = true" type="button">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                      <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                    </svg>
                    View more
                    </x-primary-button>

                    <x-secondary-button href="{{ route('user.update', $this->user) }}" type="button">
                        Cancel
                    </x-secondary-button>
                </div>
              </div>

              <div x-show="open">


                <div id="alert-additional-content-4" class="p-4 mb-4 text-secondary-800 border border-secondary-300 rounded-lg bg-secondary-50 dark:bg-gray-800 dark:text-secondary-300 dark:border-secondary-800" role="alert">
                    <div class="flex items-center">
                      <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                      </svg>
                      <span class="sr-only">Info</span>
                      <h3 class="text-lg font-medium">Suspend this user?</h3>
                    </div>
                    <div class="mt-2 mb-4 text-sm">
                      You can prevent the user logging in or any of their files being served by suspending the user account.
                    </div>
                    <div class="flex gap-2">
                        <x-primary-button wire:click.prevent="suspend" type="button">
                            Suspend User
                        </x-primary-button>
                        <x-primary-button x-on:click="openfinal = true" type="button">
                            Delete User
                        </x-primary-button>
                    </div>
                  </div>



                  <div x-show="openfinal">

                        <p class="text-xl font-black text-red-800 mb-4">Final chance.... are you sure?</p>
                        <form action="#">
                            <x-primary-button wire:click.prevent="delete" type="button">
                                Delete user forever
                            </x-primary-button>

                            <x-secondary-button href="{{ route('user.update', $this->user) }}">
                                Cancel
                            </x-secondary-button>

                        </form>

                  </div>





              </div>
        </div>
      </section>


</div>