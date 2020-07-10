<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PatientProfile;
use Faker\Generator as Faker;

$factory->define(PatientProfile::class, function (Faker $faker) {
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'birthdate' => $faker->date(),
		'gender' => $faker->randomElement([0, 1]),
		'country' => $faker->country,
		'occupation' => $faker->address
	];
});