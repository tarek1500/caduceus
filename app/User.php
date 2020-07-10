<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password', 'mobile', 'profileable_type', 'profileable_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	/**
	 * Get the user name.
	 *
	 * @return string
	 */
	public function getNameAttribute()
	{
		return trim($this->profileable->first_name . ' ' . $this->profileable->last_name);
	}

	/**
	 * One-to-one relationship to the profile.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 *
	 */
	public function profileable()
	{
		return $this->morphTo();
	}

	/**
	 * One-to-many relationship to doctors.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 */
	public function doctors()
	{
		return $this->hasMany(Appointment::class, 'patient_id');
	}

	/**
	 * One-to-many relationship to patients.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 *
	 */
	public function patients()
	{
		return $this->hasMany(Appointment::class, 'doctor_id');
	}
}