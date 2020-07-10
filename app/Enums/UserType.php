<?php

namespace App\Enums;

class UserType
{
	const PATIENT = 0;
	const DOCTOR = 1;
	const ADMIN = 2;

	/**
	 * The user available types.
	 *
	 * @var array
	 */
	public static $types = [
		'Patient',
		'Doctor',
		'Admin'
	];

	/**
	 * Get the type from an integer value.
	 *
	 * @param int $value the type value equivalent.
	 *
	 * @return string|null
	 */
	public static function getTypeString(int $value)
	{
		if ($value >= count(static::$types))
			return null;

		return static::$types[$value];
	}
}