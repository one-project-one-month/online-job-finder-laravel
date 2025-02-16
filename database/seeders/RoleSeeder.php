<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'applicant',
            'guard_name'=>'api',
        ]);
        Role::create([
            'name'=>'admin',
            'guard_name'=>'api',
        ]);
        Role::create([
            'name'=>'recruiter',
            'guard_name'=>'api',
        ]);
    }
}
