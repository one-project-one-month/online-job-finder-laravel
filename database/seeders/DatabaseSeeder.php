<?php

namespace Database\Seeders;

use App\Models\Locations\Location;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Location::factory()->count(10)->create();
    }
}

