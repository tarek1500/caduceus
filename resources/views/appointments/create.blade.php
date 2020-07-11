@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<a href="{{ route('appointments.index') }}">Appointments</a> - Create
					<a class="btn btn-primary float-right" href="{{ url()->previous() }}" role="button">Back</a>
				</div>
				<div class="card-body">
					<form method="POST" action="{{ route('appointments.store') }}">
						@csrf

						<div class="form-group row">
							<label for="pain" class="col-md-2 col-form-label text-md-right">Pain</label>
							<div class="col-md-9">
								<select id="pain" class="form-control @error('pain') is-invalid @enderror" name="pain">
									@foreach ($pains as $pain)
										<option value="{{ $pain->id }}" {{ old('pain') == $pain->id ? 'selected' : '' }}>{{ $pain->name }}</option>
									@endforeach
								</select>
								@error('pain')
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