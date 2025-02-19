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
        DB::table('users')->insert([
            [
                
                'username' => 'john_doe',
                'profile_photo' => 'profile1.jpg',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'is_activated' => true,
                'is_information_completed' => true,
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

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
            ]
        ]);

        // Seed Applicant Skills
        DB::table('applicant_skills')->insert([
            [
                'applicant_id' => DB::table('applicant_profiles')->first()->id,
                'skill_id' => DB::table('skills')->first()->id,
                'lock_version' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
