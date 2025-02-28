<?php

namespace Database\Seeders;

use App\Models\JobCategory\JobCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobCategories = [
            ['name' => "Network administrator",'description'=>'A network administrator is a person designated in an organization whose responsibility includes maintaining computer infrastructures with emphasis on local area networks up to wide area networks.'],
            ['name' => "Database Administrator",'description'=>'Database administrator. A database administrator makes sure databases run efficiently and effectively. They use software to organize and store information'],
            ['name' => "Cloud Engineer",'description'=>'Cloud engineer. National average salary: ₹ 5,15,474 per year Primary duties: Cloud engineers research and implement ways to transfer a company/s existing ...'],
            ['name' => "Software engineer",'description'=>'hello this is software engineer'],
            ['name' => "Information Security Analyst",'description'=>'hello this is information security analyst']
        ];

        foreach ($jobCategories as $j) {
            JobCategory::create($j);
        }
    }
}
