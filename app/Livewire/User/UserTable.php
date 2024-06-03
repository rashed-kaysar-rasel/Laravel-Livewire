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

    public function render()
    {
        return view('livewire.user.user-table',[
            'users' => User::search($this->search)->paginate($this->perPage),
        ]);
    }
}
