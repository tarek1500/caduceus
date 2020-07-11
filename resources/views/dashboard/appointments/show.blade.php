@extends('layouts.app')

@section('content')
<div class="container">
	@if (session('message'))
		<div class="alert {{ session('alert-class') }} alert-dismissible fade show" role="alert">
			{{ session('message') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('dashboard.appointments.index') }}">Appointments</a> - {{ $appointment->patient->name }}
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form>
						<div class="form-group row">
							<label for="patient_name" class="col-md-4 col-form-label text-md-right">Patient name</label>
							<div class="col-md-7">
								<input id="patient_name" class="form-control-plaintext" value="{{ $appointment->patient->name }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="doctor_name" class="col-md-4 col-form-label text-md-right">Doctor name</label>
							<div class="col-md-7">
								<input id="doctor_name" class="form-control-plaintext" value="{{ $appointment->doctor ? $appointment->doctor->name : '' }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="date" class="col-md-4 col-form-label text-md-right">Date</label>
							<div class="col-md-7">
								<input id="date" class="form-control-plaintext" value="{{ $appointment->date ? $appointment->date->toDayDateTimeString() : '' }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
							<div class="col-md-7">
								<input id="status" class="form-control-plaintext" value="{{ App\Enums\AppointmentStatus::getStatusString($appointment->status) }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="pain" class="col-md-4 col-form-label text-md-right">Pain</label>
							<div class="col-md-7">
								<input id="pain" class="form-control-plaintext" value="{{ $appointment->pain->name }}" readonly>
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<a class="btn btn-success" href="{{ route('dashboard.appointments.edit', $appointment->id) }}" role="button">Edit</a>
								<a class="btn btn-danger" href="{{ route('dashboard.appointments.destroy', $appointment->id) }}" onclick="event.preventDefault(); document.getElementById('delete-appointment').submit();">Delete</a>
							</div>
						</div>
					</form>
					<form id="delete-appointment" action="{{ route('dashboard.appointments.destroy', $appointment->id) }}" method="POST" style="display: none;">
						@csrf
						@method('DELETE')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection