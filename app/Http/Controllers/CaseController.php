<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Enums\AppointmentStatus;
use Illuminate\Http\Request;

class CaseController extends Controller
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
		$appointments = $request->user()->patients()->with([
			'patient.profileable',
			'pain'
		])->paginate(10);

		return view('cases.index', [
			'appointments' => $appointments
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Appointment $case
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Appointment $case)
	{
		if ($request->user()->id === $case->doctor_id)
		{
			return view('cases.show', [
				'appointment' => $case
			]);
		}

		abort('403');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Appointment $case
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Appointment $case)
	{
		if ($request->user()->id === $case->doctor_id && $case->status === AppointmentStatus::APPROVED && $case->date > now())
		{
			// Send notification

			$case->update([
				'status' => AppointmentStatus::CANCELED
			]);

			return redirect()->route('cases.index')->with([
				'alert-class' => 'alert-success',
				'message' => 'Case has been canceled.'
			]);
		}

		abort('403');
	}
}