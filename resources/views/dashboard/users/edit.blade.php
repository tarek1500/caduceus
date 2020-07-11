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
					<form method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
						@csrf
						@method('PUT')

						<div class="form-group row">
							<label for="username" class="col-md-2 col-form-label text-md-right">Username</label>
							<div class="col-md-9">
								<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" autofocus>
								@error('username')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="first_name" class="col-md-2 col-form-label text-md-right">First name</label>
							<div class="col-md-9">
								<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->profileable->first_name }}">
								@error('first_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="last_name" class="col-md-2 col-form-label text-md-right">Last name</label>
							<div class="col-md-9">
								<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->profileable->last_name }}">
								@error('last_name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-md-2 col-form-label text-md-right">E-Mail address</label>
							<div class="col-md-9">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-md-2 col-form-label text-md-right">Password</label>
							<div class="col-md-9">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="mobile" class="col-md-2 col-form-label text-md-right">Mobile number</label>
							<div class="col-md-9">
								<input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $user->mobile }}">
								@error('mobile')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						@if ($user->profileable_type === 'App\\PatientProfile')
							<div class="form-group row">
								<label for="birthdate" class="col-md-2 col-form-label text-md-right">Birthdate</label>
								<div class="col-md-9">
									<input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ $user->profileable->birthdate ? $user->profileable->birthdate->toDateString() : '' }}">
									@error('birthdate')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						@endif
						@if ($user->profileable_type === 'App\\PatientProfile' || $user->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="gender" class="col-md-2 col-form-label text-md-right">Gender</label>
								<div class="col-md-9">
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
						@if ($user->profileable_type === 'App\\PatientProfile' || $user->profileable_type === 'App\\DoctorProfile')
							<div class="form-group row">
								<label for="country" class="col-md-2 col-form-label text-md-right">Country</label>
								<div class="col-md-9">
									<input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $user->profileable->country }}">
									@error('country')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						@endif
						@if ($user->profileable_type === 'App\\PatientProfile')
							<div class="form-group row">
								<label for="occupation" class="col-md-2 col-form-label text-md-right">Occupation</label>
								<div class="col-md-9">
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