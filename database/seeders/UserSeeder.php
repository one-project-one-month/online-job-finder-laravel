<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'     => 'Admin',
            'email'        => 'admin@jobfinder.com',
            'password'     => 'Admin123!@#',
            'role_id'      => '2',
            'is_activated' => 1,
        ]);
    }
}
