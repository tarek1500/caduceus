<?php

use App\Appointment;
use App\DoctorProfile;
use App\PatientProfile;
use App\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::where('profileable_type', DoctorProfile::class)->inRandomOrder()->take(5)->get()->each(function ($doctor) {
			User::where('profileable_type', PatientProfile::class)->inRandomOrder()->take(3)->get()->each(function ($patient) use ($doctor) {
				factory(Appointment::class)->create([
					'patient_id' => $patient->id,
					'doctor_id' => $doctor->id
				]);
			});
		});
	}
}