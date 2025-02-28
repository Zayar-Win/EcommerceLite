<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Developer Super Admin Account
        User::factory()->create([
            'name' => 'Developer Super Admin',
            'email' => 'developer@gmail.com',
            'password' => 'developerpassword',
            'role_id' => Role::where('slug', 'super_admin')->firstOrFail()->id,
        ]);

        // Normal Admin Account
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'adminpassword',
            'role_id' => Role::where('slug', 'admin')->firstOrFail()->id,
        ]);

        // Production Super Admin Account
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'password' => 'superpassword',
            'role_id' => Role::where('slug', 'super_admin')->firstOrFail()->id,
        ]);

        // Accounting Account
        User::factory()->create([
            'name' => 'Accounting',
            'email' => 'accounting@gmail.com',
            'password' => 'accountingpassword',
            'role_id' => Role::where('slug', 'accounting')->firstOrFail()->id,
        ]);

        // Officer Access Account
        User::factory()->create([
            'name' => 'Officer Access',
            'email' => 'officeraccess@gmail.com',
            'password' => 'officeraccesspassword',
            'role_id' => Role::where('slug', 'officer_access')->firstOrFail()->id,
        ]);

        if (app()->environment('local')) {
            User::factory(50)->create(['created_at' => now()->subMonth()]);
        }
    }

}
