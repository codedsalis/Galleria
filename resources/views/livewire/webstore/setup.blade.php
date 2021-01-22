<div>
    {{-- Check to see that the right user has access to this page otherwise show a 404
    page --}}
    @foreach ($webstore as $store)
        @if ($store->user_id != auth()->id())
            {{ abort(404) }}
        @endif
    @endforeach

    <div class="text-left font-roboto p-4 text-dark-500 mt-3">
        <h2 class="text-3xl font-bold">
            <i class="fas fa-tools text-primary-500"></i> Setting up your Webstore
        </h2>
        <p class="mt-1 text-normal text-dark-600">
            Upload a logo for your business
        </p>
    </div>
    {{-- <x-form-layout submit="savePhoto">
        <div class="col-span-6 sm:col-span-6">
            <x-jet-input id="photo" type="file" wire:model="photo" required />
            <x-jet-input-error for="photo" class="mt-2" />
        </div>

        <br />
        <div class="flex justify-end w-full">
            <div class="py-4 px-5">
                {{-- {{ $message }} --}}
                {{--
            </div>
            <div class="px-5 py-3">
                <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Upload') }}
                </x-jet-button>
            </div>
        </div>
    </x-form-layout> --}}


    @if (session()->has('logoMessage'))
        <div class="flex justify-end">
            <div>
                <div id="snackbar">
                    <i class="fas fa-info-circle"></i> {{ session('logoMessage') }}
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-row justify-around rounded-md p-5">
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


                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <!-- Photo -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-input id="photo" type="file" class="focus:outline-none mt-1 block w-full"
                                    wire:model="photo" required />
                                <x-jet-input-error for="photo" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end w-full">
                        <div class="py-4 px-5">
                        </div>
                        <div class="px-5 py-3">
                            <x-button wire:loading.attr="disabled" wire:target="photo">
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
            @foreach ($webstore as $store)
                <a href="/{{ $store->url }}/dashboard?utm_source=setup&utm_medium=skiplogouploadbutton">
                    <button
                        class="button-secondary px-5 py-3 rounded-md shadow-md focus:outline-none focus:ring text-xs">
                        {{ _('Skip') }}
                    </button>
                </a>
            @endforeach
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
            window.location.replace('/' + event.detail.webStore + '/dashboard');
        }, 900);
    })

</script>
