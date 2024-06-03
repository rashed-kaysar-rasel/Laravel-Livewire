<div class="container mx-auto p-4">
    <div class="flex justify-end mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users..." class="form-input rounded-md shadow-sm mt-1 block w-1/5">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="w-1/3 px-4 py-2">Name</th>
                    <th class="w-1/3 px-4 py-2">Email</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-gray-100 dark:bg-gray-900 border-b dark:border-gray-700">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-center">
                            <button class="text-blue-500 hover:text-blue-700" wire:click="edit({{ $user->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 000-2.828zM4 12V15h3l-3-3z" />
                                </svg>
                            </button>
                            <button class="text-red-500 hover:text-red-700" wire:click="delete({{ $user->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.707 3.293a1 1 0 010 1.414L7.414 6h5.172l-1.293-1.293a1 1 0 111.414-1.414L15 6.414V7a1 1 0 01-1 1h-8a1 1 0 01-1-1v-.586l1.293-1.293a1 1 0 010-1.414zM6 9v5h8V9H6zm7 1h2v3h-2v-3z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
            
        </table>
        <div class="py-4 px-3">
            <div class="flex">
                <div class="flex space-x-4 items-center">
                    <label for="perPage" class="w-24 text-sm font-medium text-gray-900">Per Page: </label>
                    <select wire:model.live='perPage' name="perpage" id="perPage" class="bg-gray border border-gray-300 text-sm text-gray-900 rounded-md focus:ring-blue-500 focus:b">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-5">{{ $users->links() }}</div>
    </div>
    
</div>