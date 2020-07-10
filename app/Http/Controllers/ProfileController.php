<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		return view('profile', [
			'user' => $request->user()->load('profileable')
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\ProfileRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProfileRequest $request)
	{
		$user = $request->user();
		$data = $request->only(['email', 'mobile']);

		if (!is_null($request->input('new_password')))
			$data = $data + ['password' => Hash::make($request->input('new_password'))];

		$user->update($data);

		$data = $request->only(['first_name', 'last_name', 'birthdate', 'gender', 'country', 'occupation']);
		$user->profileable()->update($data);

		return redirect()->route('profile.index')->with([
			'alert-class' => 'alert-success',
			'message' => 'Profile has been updated.'
		]);
	}
}