<?php
namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecruiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'Recruiter',
            'email'    => 'recruiter@jobfinder.com',
            'password' => 'Recruiter123!@#',
            'role_id'  => '3',
        ]);
   
        DB::table('company_profiles')->insert([
            [

                'user_id'      => $user->id,
                'company_name' => 'AIA Company',
                'phone'        => '1234567890',
                'address'      => '123 Main St, City, Country',
                'website'      => 'www.youtube.com',
                'description'  => 'Experienced web developer',
                'lock_version' => 1,
                'location_id'  => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
