<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public User $user;
    public $userId;
    public $name, $email, $password;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->userId),
            ],
        ];
    }

    public function mount(){
        $this->userId = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
    public function submit() {

        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'User successfully Updated.');
        
        $this->dispatch('userUpdated');
        
        // $this->closeModal();

    }
    public function render()
    {
        return view('livewire.user.edit-user');
    }
}
