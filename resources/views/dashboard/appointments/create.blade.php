@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/dashboard/appointments/create.js') }}"></script>
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('dashboard.appointments.index') }}">Appointments</a> - Create
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('dashboard.appointments.store') }}">
						@csrf

						<div class="form-group row">
							<label for="patient" class="col-md-2 col-form-label text-md-right">Patient</label>
							<div class="col-md-9">
								<select id="patient" class="form-control @error('patient') is-invalid @enderror" name="patient" required autofocus>
									@foreach ($patients as $patient)
										<option value="{{ $patient->id }}" {{ old('patient') == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
									@endforeach
								</select>
								@error('patient')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="pain" class="col-md-2 col-form-label text-md-right">Pain</label>
							<div class="col-md-9">
								<select id="pain" class="form-control @error('pain') is-invalid @enderror" name="pain" onchange="painChange(this)">
									@foreach ($pains as $pain)
										<option value="{{ $pain->id }}" {{ old('pain') == $pain->id ? 'selected' : '' }} data-specialty="{{ $pain->specialty_id }}">{{ $pain->name }}</option>
									@endforeach
								</select>
								@error('pain')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="doctor" class="col-md-2 col-form-label text-md-right">Doctor</label>
							<div class="col-md-9">
								<select id="doctor" class="form-control @error('doctor') is-invalid @enderror" name="doctor" required>
									@foreach ($doctors as $doctor)
										<option value="{{ $doctor->id }}" {{ old('doctor') == $doctor->id ? 'selected' : '' }} data-specialty="{{ $doctor->profileable->specialty_id }}">{{ $doctor->name }}</option>
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
								<input id="date" type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
								@error('date')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row mb-0">
							<div class="col-md-10 offset-md-2">
								<button type="submit" class="btn btn-primary">Create</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection