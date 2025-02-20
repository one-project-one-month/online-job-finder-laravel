<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Users
       

        // Seed Applicant Profiles
        DB::table('applicant_profiles')->insert([
            [
                
                'user_id' => DB::table('users')->first()->id,
                'full_name' => 'John Doe',
                'phone' => '1234567890',
                'address' => '123 Main St, City, Country',
                'location_id' => 1,
                'description' => 'Experienced web developer',
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        // Seed Skills
        DB::table('skills')->insert([
            [
                
                'name' => 'Laravel',
                'description' => 'PHP Framework',
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                
                'name' => 'React',
                'description' => 'JS Framework',
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            [
                
                'name' => '.Net',
                'description' => 'C# Framework',
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                
                'name' => 'Flask',
                'description' => 'Python Framework',
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        
    }
}
