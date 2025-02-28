<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(LocationSeeder::class);
        $this->call(JobCategorySeeder::class);
        $this->call(SkillSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RecruiterSeeder::class);
        $this->call(ApplicantSeeder::class);
    }
}
