<div class="animate__animated animate__pulse">
    @if ($step == 1)
        <div class="text-left font-roboto p-4 text-dark-500 mt-3">
            <h2 class="text-3xl font-bold">
                <i class="fas fa-address-card text-primary-500"></i> Essentials
            </h2>
            <p class="mt-1 text-normal text-dark-600">
                Provide these essential information about your webstore for proper identification
            </p>
        </div>
        <div class="flex flex-row justify-around rounded-md p-5">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="submitEssentials">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <!-- Username -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="username" value="{{ __('Username') }}" />
                                    <x-jet-input id="username" type="text" class="mt-1 block w-full"
                                        wire:model="username" autocomplete="username" autofocus required />
                                    <x-hint value="This will be the URL for visiting your
                                        Webstore page (galleria.ng/username)" />
                                    <x-jet-input-error for="username" class="mt-2" />
                                </div>

                                <!-- Webstore name -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="name" value="{{ __('Webstore name') }}" />
                                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name"
                                        required />
                                    <x-hint value="A name for identifying your Webstore" />
                                    <x-jet-input-error for="name" class="mt-2" />
                                </div>

                                <!-- Description -->
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="description" value="{{ __('Description') }}" />
                                    <x-textarea id="description" class="mt-1 block w-full"
                                        wire:model.defer="description" required></x-textarea>
                                    <x-hint value="Provide a clear description of what your business offers" />
                                    <x-jet-input-error for="description" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end w-full">
                            <div class="py-4 px-5">
                                {{-- {{ $message }} --}}
                            </div>
                            <div class="px-5 py-3">
                                <x-button>
                                    {{ __('Next') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @elseif($step == 2)
        @livewire('webstore.address-and-location', [
        'username' => $username,
        'name' => $name,
        'description' => $description
        ])
    @endif
</div>
