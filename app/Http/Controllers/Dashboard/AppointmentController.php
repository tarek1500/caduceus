<?php

namespace App\Http\Controllers\Dashboard;

use App\Appointment;
use App\DoctorProfile;
use App\Enums\AppointmentStatus;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Notifications\AppointmentChanged;
use App\Pain;
use App\User;

class AppointmentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('dashboard.appointments.index', [
			'appointments' => Appointment::with([
				'patient.profileable',
				'doctor.profileable'
			])->paginate(10)
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('dashboard.appointments.create', [
			'patients' => User::with('profileable')->where('type', UserType::PATIENT)->get(),
			'doctors' => User::with('profileable')->where('type', UserType::DOCTOR)->get(),
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
		$data = $request->only(['patient', 'doctor', 'date', 'pain']);

		$appointment = Appointment::create([
			'patient_id' => $data['patient'],
			'doctor_id' => $data['doctor'],
			'date' => $data['date'],
			'status' => AppointmentStatus::APPROVED,
			'pain_id' => $data['pain']
		]);

		$appointment->patient->notify(new AppointmentChanged($appointment));
		$appointment->doctor->notify(new AppointmentChanged($appointment));

		return redirect()->route('dashboard.appointments.index')->with([
			'alert-class' => 'alert-success',
			'message' => 'Appointment has been created.'
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Appointment $appointment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Appointment $appointment)
	{
		return view('dashboard.appointments.show', [
			'appointment' => $appointment
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Appointment $appointment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Appointment $appointment)
	{
		$specialty_id = $appointment->pain->specialty_id;
		$doctors = DoctorProfile::where('specialty_id', $specialty_id)->get();

		return view('dashboard.appointments.edit', [
			'appointment' => $appointment,
			'doctors' => User::with('profileable')->where('type', UserType::DOCTOR)->whereIn('profileable_id', $doctors->pluck('id'))->get()
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \App\Http\Requests\AppointmentRequest $request
	 * @param \App\Appointment $appointment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(AppointmentRequest $request, Appointment $appointment)
	{
		$data = $request->only(['doctor', 'date']);

		$appointment->update([
			'doctor_id' => $data['doctor'],
			'date' => $data['date'],
			'status' => AppointmentStatus::APPROVED
		]);
		$appointment->patient->notify(new AppointmentChanged($appointment));
		$appointment->doctor->notify(new AppointmentChanged($appointment));

		return redirect()->route('dashboard.appointments.show', $appointment->id)->with([
			'alert-class' => 'alert-success',
			'message' => 'Appointment has been updated.'
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Appointment $appointment
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Appointment $appointment)
	{
		$appointment->delete();

		return redirect()->route('dashboard.appointments.index')->with([
			'alert-class' => 'alert-success',
			'message' => 'Appointment has been deleted.'
		]);
	}
}