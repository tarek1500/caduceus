<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pain;
use Faker\Generator as Faker;

$factory->define(Pain::class, function (Faker $faker) {
	return [
		'name' => $faker->name
	];
});