<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if ($this->routeIs('appointments.store'))
		{
			return [
				'pain' => 'required|integer|exists:pains,id'
			];
		}
		else if ($this->routeIs('dashboard.appointments.store'))
		{
			return [
				'patient' => 'required|integer|exists:users,id',
				'pain' => 'required|integer|exists:pains,id',
				'doctor' => 'required|integer|exists:users,id',
				'date' => 'required|date|after:now'
			];
		}
		else if ($this->routeIs('dashboard.appointments.update'))
		{
			return [
				'doctor' => 'required|integer|exists:users,id',
				'date' => 'required|date|after:now'
			];
		}
	}
}