@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('dashboard.users.index') }}">Users</a> - {{ $user->name }}
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form>
						<div class="form-group row">
							<label for="first_name" class="col-md-4 col-form-label text-md-right">First name</label>
							<div class="col-md-7">
								<input id="first_name" class="form-control-plaintext" value="{{ $user->profileable->first_name }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-md-4 col-form-label text-md-right">Last name</label>
							<div class="col-md-7">
								<input id="last_name" class="form-control-plaintext" value="{{ $user->profileable->last_name }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">E-Mail address</label>
							<div class="col-md-7">
								<input id="email" class="form-control-plaintext" value="{{ $user->email }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile number</label>
							<div class="col-md-7">
								<input id="mobile" class="form-control-plaintext" value="{{ $user->mobile }}" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="type" class="col-md-4 col-form-label text-md-right">User type</label>
							<div class="col-md-7">
								<input id="type" class="form-control-plaintext" value="{{ App\Enums\UserType::getTypeString($user->type) }}" readonly>
							</div>
						</div>
						@if ($user->profileable_type === 'App\\PatientProfile')
							<div class="form-group row">
								<label for="birthdate" class="col-md-4 col-form-label text-md-right">Birthdate</label>
								<div class="col-md-7">
									<input id="birthdate" class="form-control-plaintext" value="{{ $user->profileable->birthdate ? $user->profileable->birthdate->toDateString() : '' }}" readonly>
								</div>
							</div>
						@endif
						@if ($user->profileable_type === 'App\\PatientProfile' || $user->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
								<div class="col-md-7">
									<input id="gender" class="form-control-plaintext" value="{{ App\Enums\UserGender::getGenderString($user->profileable->gender) }}" readonly>
								</div>
							</div>
						@endif
						@if ($user->profileable_type === 'App\\PatientProfile' || $user->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="country" class="col-md-4 col-form-label text-md-right">Country</label>
								<div class="col-md-7">
									<input id="country" class="form-control-plaintext" value="{{ $user->profileable->country }}" readonly>
								</div>
							</div>
						@endif
						@if ($user->profileable_type === 'App\\PatientProfile')
							<div class="form-group row">
								<label for="occupation" class="col-md-4 col-form-label text-md-right">Occupation</label>
								<div class="col-md-7">
									<input id="occupation" class="form-control-plaintext" value="{{ $user->profileable->occupation }}" readonly>
								</div>
							</div>
						@endif
						@if ($user->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="specialty" class="col-md-4 col-form-label text-md-right">Specialty</label>
								<div class="col-md-7">
									<input id="specialty" class="form-control-plaintext" value="{{ $user->profileable->specialty->name }}" readonly>
								</div>
							</div>
						@endif
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<a class="btn btn-success" href="{{ route('dashboard.users.edit', $user->id) }}" role="button">Edit</a>
								<a class="btn btn-danger" href="{{ route('dashboard.users.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-user').submit();">Delete</a>
							</div>
						</div>
					</form>
					<form id="delete-user" action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: none;">
						@csrf
						@method('DELETE')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection