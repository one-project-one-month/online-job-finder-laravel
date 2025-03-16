<?php
namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'Applicant',
            'email'    => 'applicant@jobfinder.com',
            'password' => 'Applicant123!@#',
            'role_id'  => '1',
        ]);

        DB::table('applicant_profiles')->insert([
            [
                'user_id'      => $user->id,
                'full_name'    => 'John Doe',
                'phone'        => '1234567890',
                'address'      => '123 Main St, City, Country',
                'location_id'  => 1,
                'description'  => 'Experienced web developer',
                'lock_version' => 1,
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
