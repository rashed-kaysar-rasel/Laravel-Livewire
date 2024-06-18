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

        foreach (range(1, 50) as $index) {
            //Reguler User
            $user = User::create([
                'name'=> 'user-'.$index,
                'email'=>'user-'.$index.'@dstudio.asia',
                'password'=>Hash::make('45625899')
            ]);
            $user->roles()->attach(Role::where('slug', 'user')->first());
        }
    }
}

// $user->basicRoles()->attach(BasicRole::where('slug', 'admin')->first());
