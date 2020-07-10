<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
		if ($this->routeIs('dashboard.users.store'))
		{
			return [
				'username' => 'required|string|max:255|unique:users,username',
				'password' => 'required|string|min:8',
				'type' => 'required|integer|between:0,' . (count(UserType::$types) - 1),
				'specialty' => 'required_if:type,' . UserType::DOCTOR . '|integer|exists:specialties,id'
			];
		}
		else if ($this->routeIs('dashboard.users.update'))
		{
			return [
				'username' => 'required|string|max:255|unique:users,username,' . $this->user->id,
				'first_name' => 'string|nullable|max:255',
				'last_name' => 'string|nullable|max:255',
				'email' => 'string|nullable|email|max:255|unique:users,email,' . $this->user->id,
				'password' => 'string|nullable|min:8',
				'mobile' => 'string|nullable|between:11,20',
				'birthdate' => 'date|nullable|before:now',
				'gender' => 'integer|nullable|in:0,1',
				'country' => 'string|nullable|max:255',
				'occupation' => 'string|nullable|max:65535'
			];
		}
	}
}