<div class="animate__animated animate__pulse">
    @if ($step == 2)
        <div class="text-left font-roboto p-4 text-dark-500 mt-3">
            <h2 class="text-3xl font-bold">
                <i class="fas fa-map-marker-alt text-primary-500"></i> Address and location
            </h2>
            <p class="mt-1 text-normal text-dark-600">
                Provide your address/location of your business
            </p>
        </div>

        @if (session()->has('webstoreCreationMessage'))
            <div class="flex justify-end">
                <div>
                    <div id="snackbar">
                        <i class="fas fa-info-circle"></i> {{ session('webstoreCreationMessage') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="flex flex-row justify-around rounded-md p-5">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form wire:submit.prevent="submit">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <!-- State -->
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="state" value="{{ __('State') }}" />
                                    <x-select id="state" class="mt-1 block w-full" wire:model.defer="state" required>
                                        <x-states />
                                    </x-select>
                                    <x-hint value="Select the state where your business is located in Nigeria" />
                                    <x-jet-input-error for="state" class="mt-2" />
                                </div>

                                <!-- City -->
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="city" value="{{ __('City') }}" />
                                    <x-jet-input id="city" type="text" class="mt-1 block w-full" wire:model.defer="city"
                                        required />
                                    <x-hint value="The city in the selected state where your business is located" />
                                    <x-jet-input-error for="city" class="mt-2" />
                                </div>

                                <!-- Categories -->
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="category" value="{{ __('Category') }}" />
                                    <x-select id="category" class="mt-1 block w-full" wire:model.defer="category"
                                        required>
                                        <option value="">Select</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Technology">Technology</option>
                                        <option value="Computers">Computers</option>
                                    </x-select>
                                    <x-hint value="Select a category that best describes what your business offers" />
                                    <x-jet-input-error for="category" class="mt-2" />
                                </div>

                                <!-- Address -->
                                <div class="col-span-6 sm:col-span-3">
                                    <x-jet-label for="address" value="{{ __('Address') }}" />
                                    <x-textarea id="address" class="mt-1 block w-full" wire:model.defer="address"
                                        required></x-textarea>
                                    <x-hint value="The address of your local store in the city you submitted" />
                                    <x-jet-input-error for="address" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end w-full">
                            <div class="py-4 px-5">
                                @if (session()->has('message'))
                                    <div
                                        class="bg-green-500 text-white px-5 py-3 rounded-md shadow-md animate__animated animate__heartBeat">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                {{-- {{ $username }}, {{ $name }}, {{ $description }}
                                --}}
                            </div>
                            <div class="px-5 py-3">
                                <x-button wire:loading.attr="disabled">
                                    {{ __('Create') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>


<script>
    window.addEventListener('webstoreCreated', event => {
        // snackBar();
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3500);

        setTimeout(function() {
            window.location.replace('/webstore/' + event.detail.webStore + '/setup');
        }, 900);
    })

</script>
