<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DoctorProfile;
use Faker\Generator as Faker;

$factory->define(DoctorProfile::class, function (Faker $faker) {
	return [
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'gender' => $faker->randomElement([0, 1]),
		'country' => $faker->country
	];
});