<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * One-to-many relationship to pains.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 */
	public function pains()
	{
		return $this->hasMany(Pain::class);
	}

	/**
	 * One-to-many relationship to doctorProfiles.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 */
	public function doctorProfiles()
	{
		return $this->hasMany(DoctorProfile::class);
	}
}