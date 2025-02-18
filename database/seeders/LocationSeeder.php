<?php

namespace Database\Seeders;

use App\Models\Locations\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['name' => "Yangon",'description'=>'hello this is location'],
            ['name' => "Mandalay",'description'=>'hello this is location'],
            ['name' => "Naypyidaw",'description'=>'hello this is location'],
            ['name' => "Bago",'description'=>'hello this is location'],
            ['name' => "Mawlamyine",'description'=>'hello this is location']
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
