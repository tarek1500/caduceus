<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'birthdate', 'gender', 'country', 'occupation'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'birthdate' => 'date'
	];

	/**
	 * One-to-one relationship to the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphOne
	 *
	 */
	public function user()
	{
		return $this->morphOne(User::class, 'profileable');
	}
}