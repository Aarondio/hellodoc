<div class="mt-2 sm:mt-8">
    <div class="container mx-auto">
        <a class="my-3 ml-4 flex sm:hidden  text-indigo-600 underline text-md  cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="flex flex-col items-center justify-center mb-20">

            <div class="w-11/12 lg:w-1/2   bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg ">

                <form wire:submit="create">
                    {{ $this->form }}
                    <button type="submit"
                        class="bg-indigo-600 px-5 flex py-2 rounded-md text-white hover:bg-indigo-700 mt-5"  wire:loading.attr="disabled">Book
                        Appointment
                        <x-filament::loading-indicator class="h-5 w-5 text-white self-center ms-2" wire:loading/>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
