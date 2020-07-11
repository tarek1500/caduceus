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
					Appointments
					<a class="btn btn-primary float-right" href="{{ route('dashboard.appointments.create') }}" role="button">Create</a>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Patient</th>
								<th scope="col">Doctor</th>
								<th scope="col">Status</th>
								<th scope="col">Options</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($appointments as $appointment)
								<tr>
									<th scope="row">{{ $appointment->id }}</th>
									<td><a href="{{ route('dashboard.appointments.show', $appointment->id) }}">{{ $appointment->patient->name }}</a></td>
									<td>{{ $appointment->doctor ? $appointment->doctor->name : '' }}</td>
									<td>{{ App\Enums\AppointmentStatus::getStatusString($appointment->status) }}</td>
									<td class="text-center">
										<div class="btn-group" role="group" aria-label="Basic example">
											<a class="btn btn-success" href="{{ route('dashboard.appointments.edit', $appointment->id) }}" role="button">Edit</a>
											<a class="btn btn-danger" href="{{ route('dashboard.appointments.destroy', $appointment->id) }}" onclick="event.preventDefault(); document.getElementById('delete-{{ $appointment->id }}').submit();">Delete</a>
										</div>
										<form id="delete-{{ $appointment->id }}" action="{{ route('dashboard.appointments.destroy', $appointment->id) }}" method="POST" style="display: none;">
											@csrf
											@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $appointments->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection