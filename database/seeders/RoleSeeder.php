<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    
    public function run(): void
    {
        Role::factory()->create(['name' => 'Super Admin', 'slug' => 'super_admin']);
        Role::factory()->create(['name' => 'Admin', 'slug' => 'admin']);
        Role::factory()->create(['name' => 'User', 'slug' => 'user']);
        Role::factory()->create(['name' => 'Accounting', 'slug' => 'accounting']);
        Role::factory()->create(['name' => 'Officer Access', 'slug' => 'officer_access']);
    }
}
