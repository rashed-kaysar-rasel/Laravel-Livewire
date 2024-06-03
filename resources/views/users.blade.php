<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Users') }}
            </h2>
            <button  onclick="Livewire.dispatch('openModal', { component: 'user.create-user' })" class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
                Create User
            </button>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Include the TotalUsers Livewire component -->
            <div class="mt-4">
                <livewire:user.user-table />
            </div>
        </div>
    </div>

    
    <!-- Include the modal component -->
    {{-- <livewire:user.create-user /> --}}

</x-app-layout>