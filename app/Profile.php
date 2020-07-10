<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name'
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