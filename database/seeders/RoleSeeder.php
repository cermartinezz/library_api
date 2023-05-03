<?php

namespace Database\Seeders;

use Couchbase\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'name' => strtolower('student')
        ]);

        \App\Models\Role::create([
            'name' => strtolower('Librarian')
        ]);
    }
}
