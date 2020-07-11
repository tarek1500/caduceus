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
				<div class="card-header">Cases</div>
				<div class="card-body">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Patient</th>
								<th scope="col">Pain</th>
								<th scope="col">Date</th>
								<th scope="col">Status</th>
								<th scope="col">Options</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($appointments as $key => $appointment)
								<tr>
									<th scope="row">{{ $key + 1 }}</th>
									<td><a href="{{ route('cases.show', $appointment->id) }}">{{ $appointment->patient->name }}</a></td>
									<td>{{ $appointment->pain->name }}</td>
									<td>{{ $appointment->date ? $appointment->date->toDayDateTimeString() : '' }}</td>
									<td>{{ App\Enums\AppointmentStatus::getStatusString($appointment->status) }}</td>
									<td class="text-center">
										@if ($appointment->status === App\Enums\AppointmentStatus::APPROVED && $appointment->date > now())
											<a class="btn btn-danger" href="{{ route('cases.update', $appointment->id) }}" onclick="event.preventDefault(); document.getElementById('cancel-{{ $appointment->id }}').submit();">Cancel</a>
											<form id="cancel-{{ $appointment->id }}" action="{{ route('cases.update', $appointment->id) }}" method="POST" style="display: none;">
												@csrf
												@method('PUT')
											</form>
										@endif
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