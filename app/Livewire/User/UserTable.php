<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UserTable extends Component
{
    use WithPagination, WithoutUrlPagination; 
    public $search = '';
    public $perPage = 10;
    protected $listeners = ['userUpdated' => '$refresh'];
    
    public function updatingPerPage()
    {
        $this->resetPage();
    }

    // public function edit(User $user){
    //     $user->delete();
    // }
    public function delete(User $user){
        $user->delete();
    }
    public function render()
    {
        return view('livewire.user.user-table',[
            'users' => User::search($this->search)->paginate($this->perPage),
        ]);
    }
}
