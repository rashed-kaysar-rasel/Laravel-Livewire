<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreateUser extends ModalComponent
{
    use WithFileUploads;

    public $name, $email, $password, $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    public function submit()
    {
        $this->validate();

        $s3Path = "none";

        if ($this->image) {
            $path = $this->image->store('user-images', 's3');
            $s3Path = Storage::disk('s3')->url($path);
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'image' => $s3Path,
            'password' => Hash::make($this->password),
        ]);
        
        // Assign the "admin" role to the user
        $user->roles()->attach(Role::where('slug', 'user')->first());

        session()->flash('message', 'User successfully created.');

        // Reset the form fields and make sure they are emptied
        $this->reset(['name', 'email', 'password']);
        
        $this->dispatch('userCreated');
        
        // $this->closeModal();
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }
}
