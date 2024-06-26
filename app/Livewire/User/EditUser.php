<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class EditUser extends ModalComponent
{
    use WithFileUploads;
    
    public User $user;
    public $userId;
    public $name, $email, $password,$image,$newImage;

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
            'newImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function mount(){
        $this->userId = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->image = $this->user->image;
    }
    public function submit() {

        $this->validate();

        // Check if a new image is uploaded
        if ($this->newImage) {
            
            // Delete the previous image from S3 if it exists
            if ($this->image) {
                // Parse the URL and get the path
                $path = parse_url($this->image, PHP_URL_PATH);
                // Remove the leading slash
                $relativePath = ltrim($path, '/');
                $relativePath = str_replace("/".env('AWS_BUCKET')."/", '', $path);
                Storage::disk('s3')->delete($relativePath);
            }

            // Store the new image
            $path = $this->newImage->store('user-images', 's3');
            $this->image = Storage::disk('s3')->url($path);

            // Update the user with the new image path
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'image' => $this->image,
            ]);
        } else {
            // Update the user without changing the image
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }

        session()->flash('message', 'User successfully Updated.');
        
        $this->dispatch('userUpdated');
        
        // $this->closeModal();

    }
    public function render()
    {
        return view('livewire.user.edit-user');
    }
}
