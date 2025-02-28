<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Skills
        DB::table('skills')->insert([
            [
                'name'         => 'Laravel',
                'description'  => 'PHP Framework',
                'lock_version' => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [

                'name'         => 'React',
                'description'  => 'JS Framework',
                'lock_version' => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [

                'name'         => '.Net',
                'description'  => 'C# Framework',
                'lock_version' => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'name'         => 'Flask',
                'description'  => 'Python Framework',
                'lock_version' => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
