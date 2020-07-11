<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Enums\AppointmentStatus;
use App\Http\Requests\AppointmentRequest;
use App\Pain;
use Illuminate\Http\Request;

class AppointmentController extends Controller
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
		$appointments = $request->user()->doctors()->with([
			'doctor.profileable',
			'pain'
		])->paginate(10);

		return view('appointments.index', [
			'appointments' => $appointments
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('appointments.create', [
			'pains' => Pain::all()
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \App\Http\Requests\AppointmentRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(AppointmentRequest $request)
	{
		Appointment::create([
			'patient_id' => $request->user()->id,
			'status' => AppointmentStatus::PENDING,
			'pain_id' => $request->input('pain')
		]);

		return redirect()->route('appointments.index')->with([
			'alert-class' => 'alert-success',
			'message' => 'Appointment has been created.'
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Appointment $appointment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Appointment $appointment)
	{
		if ($request->user()->id === $appointment->patient_id)
		{
			return view('appointments.show', [
				'appointment' => $appointment
			]);
		}

		abort('403');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Appointment $appointment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Appointment $appointment)
	{
		if ($request->user()->id === $appointment->patient_id && $appointment->status === AppointmentStatus::APPROVED && $appointment->date > now())
		{
			// Send notification

			$appointment->update([
				'status' => AppointmentStatus::CANCELED
			]);

			return redirect()->route('appointments.index')->with([
				'alert-class' => 'alert-success',
				'message' => 'Appointment has been canceled.'
			]);
		}

		abort('403');
	}
}