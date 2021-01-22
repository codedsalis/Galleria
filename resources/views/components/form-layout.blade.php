@props(['submit'])

<div class="flex flex-row justify-around rounded-md p-5">
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
