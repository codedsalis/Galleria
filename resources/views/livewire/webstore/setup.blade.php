<div>
    <div class="p-4 mt-3 text-left font-roboto text-dark-500">
        <h2 class="text-3xl font-bold">
            <i class="fas fa-tools text-primary-500"></i> Setting up your Webstore
        </h2>
        <p class="mt-1 text-normal text-dark-600">
            Upload a logo for your business
        </p>
    </div>

    @if (session()->has('logoMessage'))
        <div class="flex justify-end">
            <div>
                <div id="snackbar">
                    <i class="fas fa-info-circle"></i> {{ session('logoMessage') }}
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-row justify-around p-5 rounded-md">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="savePhoto">

                @if ($photo)
                    <div class="grid grid-cols-2 gap-1">
                        <div class="col-span-2 sm:col-span-1">
                            <b>Preview:</b>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <img src="{{ $photo->temporaryUrl() }}" width="200" height="auto" />
                        </div>
                    </div>
                @endif


                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <!-- Photo -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-input id="photo" type="file" class="block w-full mt-1 focus:outline-none"
                                    wire:model="photo" required />
                                <x-jet-input-error for="photo" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end w-full">
                        <div class="px-5 py-4">
                        </div>
                        <div class="px-5 py-3">
                            <x-button target="savePhoto">
                                {{ __('Upload') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br />
    <br />
    <div class="flex justify-end">
        <div class="mr-3">
            <a href="/{{ $webstore->id }}/controlpanel?utm_source=setup&utm_medium=skiplogouploadbutton">
                <button class="px-5 py-3 text-xs rounded-md shadow-md button-secondary focus:outline-none focus:ring">
                    {{ _('Skip') }}
                </button>
            </a>
        </div>
    </div>
</div>


<script>
    window.addEventListener('logoUploaded', event => {
        // snackBar();
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3500);

        setTimeout(function() {
            window.location.replace('/' + event.detail.webstoreId + '/controlpanel');
        }, 900);
    })

</script>
