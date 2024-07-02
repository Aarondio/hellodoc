<div class="mt-2 sm:mt-8">

    <div class="container mx-auto">
        <a class="my-3 ml-4 flex sm:hidden  text-indigo-600 underline text-md  cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col items-center justify-center mb-20">



            <div class="w-11/12 lg:w-1/2   bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg ">
                <div class="flex  justify-between">
                    <h1 class="font-semibold text-sm mb-2">Working Days</h1>
                </div>
                @if ($days->isEmpty())
                    <div class="bg-red-100 p-3 rounded-md">
                        <p class="text-red-700">You have not set working days</p>
                    </div>
                @else
                    <div class="mt-2 flex flex-col   rounded-lg">
                        @foreach ($days as $day)
                            <div
                                class="px-3 w-full mt-3 py-1 relative text-indigo-600 rounded-sm text-center bg-slate-50 text-sm self-center ring-1 ring-slate-100 flex justify-between" wire:key="{{ $day->id }}">
                                <span class="self-center"> {{ $day->day }}</span>
                                <form wire:click.prevent="updateWorkingDay( {{ $day->id }} )" >
                                    <label class="inline-flex items-center cursor-pointer" >
                                        <input type="checkbox" wire:model="is_working" value="{{ $day->is_working }}"
                                            class="sr-only peer" @if ($day->is_working == 1) checked @endif>
                                        <div
                                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                    </label>
                                </form>

                            </div>
                        @endforeach
                    </div>
                    
                @endif

                <div class="mt-4">

                    {{-- {{ $this->form }} --}}
                </div>
            </div>

            {{-- <div class="w-11/12 lg:w-1/2   bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg mt-6">
                <div class="flex  justify-between">
                    <h1 class="font-semibold text-sm mb-2">Personal Information</h1>
                </div>
                
            </div> --}}

        </div>
    </div>
</div>
