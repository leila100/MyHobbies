<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Kenza',
            'email' => 'nb_leila@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin 123'),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        $admin->save();
    }
}
