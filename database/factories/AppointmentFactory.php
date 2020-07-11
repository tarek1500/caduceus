<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use App\Enums\AppointmentStatus;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
	return [
		'date' => $faker->dateTime,
		'status' => $faker->randomElement([AppointmentStatus::PENDING, AppointmentStatus::CANCELED, AppointmentStatus::APPROVED])
	];
});