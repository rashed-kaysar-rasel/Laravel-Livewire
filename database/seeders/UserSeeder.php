<?php

namespace Database\Seeders;

// use App\Models\BasicRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@dstudio.asia',
            'password' => Hash::make('45625899'),
        ]);
        
        // Assign the "admin" role to the user
        $user->roles()->attach(Role::where('slug', 'admin')->first());

        $user = User::create([
            'name' => 'Rashed',
            'email' => 'rashedkaysar321@gmail.com',
            'password' => Hash::make('45625899'),
        ]);
        
        // Assign the "admin" role to the user
        $user->roles()->attach(Role::where('slug', 'user')->first());
    }
}

// $user->basicRoles()->attach(BasicRole::where('slug', 'admin')->first());
