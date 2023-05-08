<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\User::create([
            'first_name' => 'Cesar',
            'last_name'  => 'Martinez',
            'email'      => 'cesarmartinez@gmail.com',
            'password'   => strtolower('PassworD.1'),
            'role_id'    => 1
        ]);

        \App\Models\User::create([
            'first_name' => 'Testing',
            'last_name'  => 'User',
            'email'      => 'testing@gmail.com',
            'password'   => strtolower('PassworD.1'),
            'role_id'    => 1
        ]);

        \App\Models\User::create([
            'first_name' => 'Focus',
            'last_name'  => 'User',
            'email'      => 'focususer@gmail.com',
            'password'   => strtolower('PassworD.1'),
            'role_id'    => 2
        ]);
    }
}
