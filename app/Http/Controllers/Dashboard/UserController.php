<?php

namespace App\Http\Controllers\Dashboard;

use App\DoctorProfile;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\PatientProfile;
use App\Profile;
use App\Specialty;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::paginate(10);

		return view('dashboard.user.index', [
			'users' => $users
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('dashboard.user.create', [
			'specialties' => Specialty::all()
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\UserRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(UserRequest $request)
	{
		$type = $request->input('type');

		if ($type == UserType::PATIENT)
			$profile = PatientProfile::create();
		else if ($type == UserType::DOCTOR)
			$profile = DoctorProfile::create(['specialty_id' => $request->input('specialty')]);
		else if ($type == UserType::ADMIN)
			$profile = Profile::create();

		$data = $request->only(['username', 'password', 'type']);
		User::create([
			'username' => $data['username'],
			'password' => Hash::make($data['password']),
			'type' => $data['type'],
			'profileable_type' => get_class($profile),
			'profileable_id' => $profile->id
		]);

		return redirect()->route('dashboard.users.index')->with([
			'alert-class' => 'alert-success',
			'message' => 'User has been created.'
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		return view('dashboard.user.show', [
			'user' => $user->load('profileable')
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		return view('dashboard.user.edit', [
			'user' => $user->load('profileable')
		] + ($user->type === UserType::DOCTOR ? [
			'specialties' => Specialty::all()
		] : []));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\UserRequest $request
	 * @param \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(UserRequest $request, User $user)
	{
		$data = $request->only(['username', 'email', 'mobile']);

		if (!is_null($request->input('password')))
			$data = $data + ['password' => Hash::make($request->input('password'))];

		$user->update($data);

		$data = $request->only(['first_name', 'last_name', 'birthdate', 'gender', 'country', 'occupation']);
		$user->profileable()->update($data);

		return redirect()->route('dashboard.users.show', $user->id)->with([
			'alert-class' => 'alert-success',
			'message' => 'User has been updated.'
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		$user->delete();

		return redirect()->route('dashboard.users.index')->with([
			'alert-class' => 'alert-success',
			'message' => 'User has been deleted.'
		]);
	}
}