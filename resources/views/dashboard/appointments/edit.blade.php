@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('dashboard.appointments.index') }}">Appointments</a> - {{ $appointment->patient->name }}
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('dashboard.appointments.update', $appointment->id) }}">
						@csrf
						@method('PUT')

						<div class="form-group row">
							<label for="doctor" class="col-md-2 col-form-label text-md-right">Doctor</label>
							<div class="col-md-9">
								<select id="doctor" class="form-control @error('doctor') is-invalid @enderror" name="doctor" required>
									@foreach ($doctors as $doctor)
										<option value="{{ $doctor->id }}" {{ old('doctor') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
									@endforeach
								</select>
								@error('doctor')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="date" class="col-md-2 col-form-label text-md-right">Date</label>
							<div class="col-md-9">
								<input id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $appointment->date ? $appointment->date->format('Y-m-d\TH:i:s') : '' }}">
								@error('date')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-10 offset-md-2">
								<button type="submit" class="btn btn-success">Update</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection