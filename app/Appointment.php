<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'patient_id', 'doctor_id', 'date', 'status', 'pain_id'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'date' => 'datetime'
	];

	/**
	 * Many-to-one relationship to the patient.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 */
	public function patient()
	{
		return $this->belongsTo(User::class, 'patient_id');
	}

	/**
	 * Many-to-one relationship to the doctor.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 */
	public function doctor()
	{
		return $this->belongsTo(User::class, 'doctor_id');
	}

	/**
	 * Many-to-one relationship to the pain.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 */
	public function pain()
	{
		return $this->belongsTo(Pain::class);
	}
}