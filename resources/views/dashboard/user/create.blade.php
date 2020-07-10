@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/dashboard/users/create.js') }}"></script>
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('dashboard.users.index') }}">Users</a> - Create
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('dashboard.users.store') }}">
						@csrf

						<div class="form-group row">
							<label for="username" class="col-md-2 col-form-label text-md-right">Username</label>
							<div class="col-md-9">
								<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
								@error('username')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-md-2 col-form-label text-md-right">Password</label>
							<div class="col-md-9">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label for="type" class="col-md-2 col-form-label text-md-right">Type</label>
							<div class="col-md-9">
								<select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required onchange="typeChange(this)">
									<option value="0" {{ old('type') == 0 ? 'selected' : '' }}>Patient</option>
									<option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Doctor</option>
									<option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Admin</option>
								</select>
								@error('type')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>
						<div class="form-group row {{ old('type') != 1 ? 'd-none' : '' }}">
							<label for="specialty" class="col-md-2 col-form-label text-md-right">Specialty</label>
							<div class="col-md-9">
								<select id="specialty" class="form-control @error('specialty') is-invalid @enderror" name="specialty">
									@foreach ($specialties as $specialty)
										<option value="{{ $specialty->id }}" {{ old('specialty') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
									@endforeach
								</select>
								@error('specialty')
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