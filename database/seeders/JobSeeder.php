<?php
namespace Database\Seeders;

use App\Models\Job\JobPost;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        JobPost::create([
            "title"           => "Junoir Web Developer",
            "job_category_id" => 4,
            "location_id"     => 1,
            "type"            => "OnSite",
            "description"     => "blah",
            "requirements"    => "need skills and good communication",
            "num_of_posts"    => 1,
            "salary"          => "200000",
            "address"         => "insein",
            "status"          => "Open",
            'company_id'      => 1,
        ]);
    }
}
