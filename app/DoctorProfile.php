<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'gender', 'country', 'specialty_id'
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

	/**
	 * Many-to-one relationship to the specialty.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 */
	public function specialty()
	{
		return $this->belongsTo(Specialty::class);
	}
}