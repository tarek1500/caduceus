@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('notifications.index') }}">Notifications</a> - {{ $appointment->pain->name }}
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form>
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
						@if (Auth::user()->type === App\Enums\UserType::PATIENT)
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<a class="btn btn-primary" href="{{ route('appointments.show', $appointment->id) }}">Show</a>
								</div>
							</div>
						@elseif (Auth::user()->type === App\Enums\UserType::DOCTOR)
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<a class="btn btn-primary" href="{{ route('cases.show', $appointment->id) }}">Show</a>
								</div>
							</div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection