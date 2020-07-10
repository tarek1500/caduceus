<?php

use App\DoctorProfile;
use App\PatientProfile;
use App\Profile;
use App\Specialty;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$profile = factory(Profile::class)->create([
			'first_name' => 'Admin',
			'last_name' => 'Admin'
		]);
		factory(User::class)->create([
			'username' => 'admin',
			'email' => 'admin@domain.com',
			'profileable_type' => Profile::class,
			'profileable_id' => $profile->id
		]);

		factory(PatientProfile::class, 10)->create()->each(function ($patientProfile) {
			factory(User::class)->create([
				'profileable_type' => PatientProfile::class,
				'profileable_id' => $patientProfile->id
			]);
		});

		Specialty::inRandomOrder()->take(10)->get()->each(function ($specialty) {
			$profile = factory(DoctorProfile::class)->create([
				'specialty_id' => $specialty->id
			]);
			factory(User::class)->create([
				'profileable_type' => DoctorProfile::class,
				'profileable_id' => $profile->id
			]);
		});
	}
}