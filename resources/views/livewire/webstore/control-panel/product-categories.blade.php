<div class="flex flex-col-reverse mb-5 md:mb-0 md:flex-row w-full">

    @if (session()->has('categoryCreationMessage'))
        <div id="snackbar">
            <i class="fas fa-info-circle"></i> {{ session('categoryCreationMessage') }}
        </div>
    @endif

    <div class="rounded-md p-5 shadow md:mr-24 md:w-2/5">
        <form wire:submit.prevent="createCategory">
            <x-jet-label for="name" value="{{ __('Category name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" required />
            {{--
            <x-hint value="A name for identifying your Webstore" /> --}}
            <x-jet-input-error for="name" class="mt-2" />
            <br />

            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-textarea id="description" class="mt-1 block w-full" wire:model.defer="description" />
            <x-hint value="A brief explanation of what products you offer in this category" />
            <x-jet-input-error for="description" class="mt-2" />

            <div class="flex justify-end">
                <x-button target="createCategory">
                    Create
                </x-button>
            </div>
        </form>
    </div>
    <div class="bg-white rounded-lg mb-5 md:mb-0 md:w-3/5">
        <div class="bg-gray-50 text-dark-500 text-lg font-bold p-3 border-b border-gray-200">
            <i class="fas fa-list-alt"></i> Categories
        </div>
        <div>
            @if (count($categories) > 0)
                @foreach ($categories as $category)
                    <div class="px-5 py-3 border-b border-gray-100">
                        <x-jet-label for="{{ $category->id }}">
                            <div>
                                <div class="flex justify-between">
                                    <div class="font-normal text-secondary-500 hover:text-secondary-400">
                                        <x-jet-checkbox id="{{ $category->id }}" wire:model="selectedCategories"
                                            value="{{ $category->id }}" />
                                        {{ $category->name }}
                                    </div>
                                    <div>
                                        <x-edit-button wire:click="manageCategory({{ $category->id }})"
                                            class="px-1.5 py-0 md:py-1">
                                            <span>Edit</span>
                                        </x-edit-button>
                                        <x-delete-button wire:click="confirmCategoryDeletion({{ $category->id }})"
                                            class="px-1.5 py-0 md:py-1">
                                            <span>Delete</span>
                                        </x-delete-button>
                                    </div>
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endforeach
        </div>
        <div class="flex flex-col border-t-4 border-gray-100">
            <div class="flex justify-between bg-gray-100">
                <div class="bg-gray-100 px-5 py-2 w-3/5">
                    <x-jet-label for="select-all">
                        <x-jet-checkbox id="select-all" wire:model="selectAll" />Select All
                    </x-jet-label>
                </div>
                <button wire:click.prevent="deleteSelected"
                    onclick="confirm('Are you sure you want to delete selected categories? This action cannot be reversed!') || event.stopImmediatePropagation()"
                    class="@if ($bulkDisabled) opacity-50 @endif w-2/5
                    bg-white hover:bg-red-500 text-red-500 hover:text-white rounded-md font-semibold tracking-widest
                    border-transparent px-5 py-2 text-xs uppercase text-center shadow-md focus:ring focus:outline-none
                    mb-2">
                    <i class="fa fa-trash"></i> Delete selected
                </button>
            </div>
            <div class="bg-gray-100 py-3 flex justify-end">
                {{ $categories->links() }}
            </div>
        </div>


        {{-- Delete category modal --}}
        <x-jet-dialog-modal id="{{ $category->id }}" wire:model="confirmingCategoryDeletion">
            <x-slot name="title">
                {{ __('Delete Category') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this category? This action cannot be reversed!') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.title.focus(), 250)">
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingCategoryDeletion')" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteCategory" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
        {{-- End of category deletion modal --}}


        {{-- Edit category modal --}}
        <x-jet-dialog-modal wire:model="managingCategory">
            <x-slot name="title">
                {{ __('Update Category') }}
            </x-slot>

            <x-slot name="content">
                <div class="p-5">
                    <x-jet-label for="nameUpdate" value="{{ __('Category name') }}" />
                    <x-jet-input id="nameUpdate" type="text" class="mt-1 block w-full" wire:model.defer="nameUpdate"
                        required />
                    {{--
                    <x-hint value="A name for identifying your Webstore" /> --}}
                    <x-jet-input-error for="nameUpdate" class="mt-2" />
                    <br />

                    <x-jet-label for="descriptionUpdate" value="{{ __('Description') }}" />
                    <x-textarea id="descriptionUpdate" class="mt-1 block w-full" wire:model.defer="descriptionUpdate" />
                    <x-hint value="A brief explanation of what products you offer in this category" />
                    <x-jet-input-error for="descriptionUpdate" class="mt-2" />

                    {{-- @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                        <label class="flex items-center">
                            <x-jet-checkbox wire:model.defer="updateApiTokenForm.permissions" :value="$permission" />
                            <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                        </label>
                    @endforeach --}}
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('managingCategory', false)" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="updateCategory" wire:loading.attr="disabled">
                    {{ __('Save changes') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
        {{-- End of category edition modal --}}


    @else
        <div class="flex flex-col justify-center items-center">
            <img src="/assets/no-data.png" width="200" height="auto" />
            <p class="font-semibold tracking-widest text-dark-400 py-5">
                No categories created yet
            </p>
        </div>
        @endif
    </div>
</div>



<script>
    window.addEventListener('categoryCreated', event => {
        // snackBar();
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3000);
    })

</script>
