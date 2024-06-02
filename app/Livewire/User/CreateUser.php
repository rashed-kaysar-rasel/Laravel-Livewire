<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Symfony\Component\Mailer\DelayedEnvelope;

class CreateUser extends ModalComponent
{

    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    public function submit()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        
        // Assign the "admin" role to the user
        $user->roles()->attach(Role::where('slug', 'user')->first());

        session()->flash('message', 'User created successfully.');



        $this->reset();

        $this->dispatch('userCreated');
        
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }
}
