<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class TotalUsers extends Component
{
    public $totalUsers;
    #[On('userCreated')] 
    public function mount()
    {
        $this->refreshTotalUsers();
    }

    public function refreshTotalUsers()
    {
        $this->totalUsers = User::count();
    }

    
    public function render()
    {
        return view('livewire.user.total-users');
    }
}
