<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ['role' => 'Administrator'],
            ['role' => 'Operator'],
            ['role' => 'Member']
        ]);

        User::create([
            'first_name' => 'Arman',
            'last_name' => 'Dwi Pangestu',
            'username' => 'devnull',
            'gender' => 'Male',
            'address' => 'Jl. Jakarta',
            'phone_number' => '08123456789',
            'email' => 'arman@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1
        ]);

        User::factory(10)->create();
    }
}
