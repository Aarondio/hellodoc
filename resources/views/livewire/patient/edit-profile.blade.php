<div class="mt-2 sm:mt-8">
    {{-- In work, do what you enjoy. --}}
    <div class="container mx-auto">
        <a class="my-3 ml-4 flex md:hidden   text-indigo-600 underline text-md cursor-pointer" onclick="history.back()">
            <x-icon name="arrow-left" class="h-4 w-4  self-center" />
            <span class="self-center">Back</span>
        </a>
        <div class="flex flex-col items-center mb-24">
            
            <div class="w-11/12 lg:w-1/2   bg-white ring-1 ring-neutral-200 px-8 py-6 rounded-lg ">
                {{-- <form wire:submit="uploadImage" class="mb-12">
                    <div class="self-center flex flex-col items-center">
                       <input type="file" name="image" wire:model="name">
                        @if (!empty(Auth::user()->image))
                            <img src="{{ 'storage/'.Auth::user()->image}}" class="h-10 w-10 mx-2 rounded-full"
                                alt="{{ Auth::user()->image }}">
                        @else
                            <img src="{{ asset('images/images.png') }}" class="h-40 w-40 mx-2 rounded-full"
                                alt="{{ Auth::user()->image }}">
                        @endif
                        <button>Upload</button>
                    </div>
                   
                </form> --}}
                <form wire:submit="update" class="">
                    {{ $this->form }}
                    <button type="submit"
                        class="bg-indigo-600 px-5 py-2 rounded-md text-white hover:bg-indigo-700 mt-5">Save</button>
                </form>
                {{-- <div class="mb-3">
                <label class="text-slate-700">Full name</label>
                <input type="text" name="" value="{{ Auth::user()->name }}" id="" class="w-full mt-2 rounded-md px-4 border-1 border-slate-200 focus:bg-slate-200 focus:border-indigo-100"/>
                    
            </div>
            <div class="mb-3">
                <label class="text-slate-700">Blood Group</label>
                <select name="" id="" class="w-full mt-2 rounded-md px-4 border-1 border-slate-200 focus:bg-slate-200 focus:border-indigo-100">
                    <option value="0+">O</option>
                    <option value="0-">O+</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="text-slate-700">Genotype</label>
                <select name="" id="" class="w-full mt-2 rounded-md px-4 border-1 border-slate-200 focus:bg-slate-200 focus:border-indigo-100">
                    <option value="0+">O</option>
                    <option value="0-">O+</option>
                </select>
            </div>
            <div class="mb-5">
                <label class="text-slate-700">Email</label>
                <input type="text" name="" value="{{ Auth::user()->email }}" id="" class="w-full mt-2 rounded-md text-gray-500 px-4 border-1 border-slate-200 focus:bg-slate-200 focus:border-indigo-100  disabled:bg-gray-100" disabled/>
                    
            </div>
            <div class="">
               <button class="bg-indigo-600 px-8 py-2 rounded-md text-white hover:bg-indigo-700">Save</button>
            </div> --}}

            </div>
        </div>
    </div>
</div>
