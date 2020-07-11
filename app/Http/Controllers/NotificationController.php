<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class NotificationController extends Controller
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
		$notifications = $request->user()->notifications()->orderBy('created_at', 'desc')->paginate(10);

		return view('notifications.index', [
			'notifications' => $notifications
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id)
	{
		$notification = $request->user()->notifications()->find($id);
		$appointment = Appointment::find($notification->data['appointment_id']);

		if (is_null($notification->read_at))
			$notification->markAsRead();

		return view('notifications.show', [
			'notification' => $notification,
			'appointment' => $appointment
		]);
	}
}