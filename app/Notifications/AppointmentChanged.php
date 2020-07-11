<?php

namespace App\Notifications;

use App\Appointment;
use App\Enums\AppointmentStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentChanged extends Notification implements ShouldQueue
{
	use Queueable;

	/**
	 * The appointment object.
	 *
	 * @var \App\Appointment
	 */
	public $appointment;

	/**
	 * Create a new notification instance.
	 *
	 * @param \App\Appointment $appointment
	 *
	 * @return void
	 */
	public function __construct(Appointment $appointment)
	{
		$this->appointment = $appointment;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail', 'database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		if ($notifiable->id === $this->appointment->patient_id)
			$url = route('appointments.show', $this->appointment->id);
		else
			$url = route('cases.show', $this->appointment->id);

		$info = "The appointment is scheduled at {$this->appointment->date->toDayDateTimeString()}.";

		if ($this->appointment->status === AppointmentStatus::CANCELED)
			$info = "The appointment that was scheduled at {$this->appointment->date->toDayDateTimeString()} is canceled.";

		return (new MailMessage)
					->greeting('Hello!')
					->line('There is new appointment notification.')
					->line($info)
					->action('View Appointment', $url)
					->line('Thank you for using our application!');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			'appointment_id' => $this->appointment->id
		];
	}
}