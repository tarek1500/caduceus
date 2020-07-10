<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
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
		return [
			'first_name' => 'string|nullable|max:255',
			'last_name' => 'string|nullable|max:255',
			'email' => 'string|nullable|email|max:255|unique:users,email,' . $this->user()->id,
			'old_password' => 'required_with:new_password|string|nullable|min:8',
			'new_password' => 'string|nullable|min:8',
			'mobile' => 'string|nullable|between:11,20',
			'birthdate' => 'date|nullable|before:now',
			'gender' => 'integer|nullable|in:0,1',
			'country' => 'string|nullable|max:255',
			'occupation' => 'string|nullable|max:65535'
		];
	}

	/**
	 * Configure the validator instance.
	 *
	 * @param \Illuminate\Validation\Validator $validator
	 *
	 * @return void
	 */
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			$old_password = $this->input('old_password');

			if (!is_null($old_password) && !Hash::check($old_password, $this->user()->password))
				$validator->errors()->add('old_password', 'Old password doesn\'t match.');
		});
	}
}