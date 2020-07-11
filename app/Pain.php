<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pain extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'specialty_id'
	];

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

	/**
	 * One-to-many relationship to appointments.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 */
	public function appointments()
	{
		return $this->hasMany(Appointment::class);
	}
}