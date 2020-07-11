<?php

namespace App\Enums;

class AppointmentStatus
{
	const PENDING = 0;
	const CANCELED = 1;
	const APPROVED = 2;

	/**
	 * The appointment available statuses.
	 *
	 * @var array
	 */
	public static $statuses = [
		'Pending',
		'Canceled',
		'Approved'
	];

	/**
	 * Get the status from an integer value.
	 *
	 * @param int $value the status value equivalent.
	 *
	 * @return string|null
	 */
	public static function getStatusString(int $value)
	{
		if ($value >= count(static::$statuses))
			return null;

		return static::$statuses[$value];
	}
}