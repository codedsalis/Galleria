<div>

    @if (session()->has('productItemCreationMessage'))
        <div id="snackbar">
            <i class="fas fa-info-circle"></i> {{ session('productItemCreationMessage') }}
        </div>
    @endif

    <div class="flex flex-row justify-around p-1 rounded-md sm:p-3">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="createProduct">
                <div class="overflow-hidden rounded-md shadow">
                    <div class="px-4 py-5 bg-white sm:p-12">
                        <div class="grid grid-cols-6 gap-6">

                            <!-- Product name -->
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="name" value="{{ __('Product name') }}" />
                                <x-jet-input id="name" type="text" class="block w-full mt-1" wire:model.defer="name"
                                    required />
                                <x-hint value="The name of the item you want to add" />
                                <x-jet-input-error for="name" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="category" value="{{ __('Category') }}" />
                                @if (count($categories) > 0)
                                    <x-select id="category" class="block w-full mt-1" wire:model.defer="category"
                                        required>
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-hint value="Select a category that fits best for this item" />
                                @else
                                    <div class="p-3 tracking-widest text-yellow-500">No categories created yet. <a
                                            href="/{{ $webstoreId }}/categories?utm_ref=addnewitem&utm_action=no_categories_found"
                                            class="text-secondary-500 hover:text-secondary-400 focus:outline-none">Create</a><br />
                                @endif
                                <x-jet-input-error for="category" class="mt-2" />
                            </div>

                            <!-- Product price -->
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="price" value="{{ __('Price') }}" />
                                <x-jet-input id="price" type="number" inputmode="numeric" class="block w-full mt-1"
                                    wire:model.defer="price" required />
                                <x-hint value="How much are you selling this product in naira? (Input only numbers)" />
                                <x-jet-input-error for="price" class="mt-2" />
                            </div>

                            <!-- Discount price -->
                            <div class="col-span-6 sm:col-span-3">
                                <x-jet-label for="discountPrice" value="{{ __('Discount Price') }}" />
                                <x-jet-input id="discountPrice" type="number" inputmode="numeric"
                                    class="block w-full mt-1" wire:model.defer="discountPrice" />
                                <x-hint
                                    value="If you have any discount price for the product, add it here. It becomes the new price of the product and the actual price will be displayed as a slashed price to your customers (input only numbers)" />
                                <x-jet-input-error for="discountPrice" class="mt-2" />
                            </div>

                            <!-- Availability in stock -->
                            <div class="col-span-6 sm:col-span-3 lg:col-span-1">
                                <x-jet-label for="isInStock" value="{{ __('Available in stock?') }}" />
                                <x-select id="isInStock" class="block w-full mt-1" wire:model.defer="isInStock"
                                    required>
                                    <option value="">Select</option>
                                    <option value="1">Available</option>
                                    <option value="0">Out of stock</option>
                                </x-select>
                                <x-hint value="Is this product available or out of stock?" />
                                <x-jet-input-error for="isInStock" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <x-jet-label for="description" value="{{ __('Product description') }}" />
                                <x-textarea id="description" class="block w-full mt-1" wire:model.defer="description"
                                    required>
                                </x-textarea>
                                <x-hint value="A description of the product you are adding" />
                                <x-jet-input-error for="description" class="mt-2" />
                            </div>

                            <!-- Preview images -->
                            <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                                <x-jet-label for="images" value="{{ __('Preview images') }}" />
                                <x-jet-input id="images" type="file" class="block w-full mt-1 focus:outline-none"
                                    wire:model="images" multiple required />
                                <x-hint
                                    value="Upload preview images for your product (maximum 5 photos are allowed). Max file size: 1024 kB or 1 MB" />
                                @error('images') <br /><span
                                    class="mt-2 font-bold text-red-500">{{ $message }}</span>@enderror
                                @error('images.*') <br /><span class="mt-2 text-red-500">{{ $message }}</span>@enderror
                                @if ($images)
                                    <div class="grid grid-cols-5">
                                        @foreach ($images as $image)
                                            @if ($image->temporaryUrl())
                                                <div class="col-span-1">
                                                    <img src="{{ $image->temporaryUrl() }}" width="200" height="auto" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end w-full bg-gray-50">
                        <div class="px-5 py-3">
                            <x-button wire:loading.attr="disabled" target="createProduct">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    window.addEventListener('productItemCreated', event => {
        // snackBar();
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3500);

        setTimeout(function() {
            window.location.replace('/' + event.detail.webstoreId + '/products?utm_ref=newitemadded');
        }, 900);
    })

</script>
