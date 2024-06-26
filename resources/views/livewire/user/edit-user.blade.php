<div class="flex items-center justify-center pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="p-5">
        <div class="mt-3 text-center sm:mt-0 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                Edit User
            </h3>
            <div class="mt-2">
                @if (session()->has('message'))
                    <div class="text-green-600">{{ session('message') }}</div>
                @endif
                <div class="flex justify-center gap-4 mb-10">
                    @if ($image)
                        <img src="{{ url($image) }}" class="w-40 h-40 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500">
                    @endif
                </div>
                <form wire:submit.prevent="submit">
                    <div class="mb-4">
                        <label for="newImage" class="block text-gray-700">User Image</label>
                        <input type="file" wire:model="newImage" id="newImage" class="form-input mt-1 block w-full">
                        @error('newImage')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" wire:model="name" id="name" class="form-input mt-1 block w-full">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" wire:model="email" id="email" class="form-input mt-1 block w-full">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
