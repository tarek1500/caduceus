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
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Profile') }}</div>
				<div class="card-body">
					<form method="POST" action="{{ route('profile.update') }}">
						@csrf
						@method('PUT')

						<div class="form-group row">
							<label for="first_name" class="col-md-3 col-form-label text-md-right">First name</label>
							<div class="col-md-8">
								<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->profileable->first_name }}" autofocus>
								@error('first_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-md-3 col-form-label text-md-right">Last name</label>
							<div class="col-md-8">
								<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->profileable->last_name }}">
								@error('last_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-md-3 col-form-label text-md-right">E-Mail Address</label>
							<div class="col-md-8">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="old_password" class="col-md-3 col-form-label text-md-right">Old password</label>
							<div class="col-md-8">
								<input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password">
								@error('old_password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="new_password" class="col-md-3 col-form-label text-md-right">New password</label>
							<div class="col-md-8">
								<input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
								@error('new_password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="mobile" class="col-md-3 col-form-label text-md-right">Mobile number</label>
							<div class="col-md-8">
								<input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $user->mobile }}">
								@error('mobile')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						@if (Auth::user()->profileable_type === 'App\\PatientProfile')
							<div class="form-group row">
								<label for="birthdate" class="col-md-3 col-form-label text-md-right">Birthdate</label>
								<div class="col-md-8">
									<input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ $user->profileable->birthdate ? $user->profileable->birthdate->toDateString() : '' }}">
									@error('birthdate')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						@endif
						@if (Auth::user()->profileable_type === 'App\\PatientProfile' || Auth::user()->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="gender" class="col-md-3 col-form-label text-md-right">Gender</label>
								<div class="col-md-8">
									<select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
										<option value="0" {{ $user->profileable->gender === 0 ? 'selected' : '' }}>Male</option>
										<option value="1" {{ $user->profileable->gender === 1 ? 'selected' : '' }}>Female</option>
									</select>
									@error('gender')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						@endif
						@if (Auth::user()->profileable_type === 'App\\PatientProfile' || Auth::user()->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="country" class="col-md-3 col-form-label text-md-right">Country</label>
								<div class="col-md-8">
									<input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $user->profileable->country }}">
									@error('country')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						@endif
						@if (Auth::user()->profileable_type === 'App\\PatientProfile')
							<div class="form-group row">
								<label for="occupation" class="col-md-3 col-form-label text-md-right">Occupation</label>
								<div class="col-md-8">
									<input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{ $user->profileable->occupation }}">
									@error('occupation')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						@endif
						<div class="form-group row mb-0">
							<div class="col-md-9 offset-md-3">
								<button type="submit" class="btn btn-primary">
									{{ __('Update') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection