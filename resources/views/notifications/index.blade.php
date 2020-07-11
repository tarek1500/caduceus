@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">Notifications</div>
				<div class="card-body">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Appointment</th>
								<th scope="col">Date</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($notifications as $key => $notification)
								<tr class="{{ $notification->read_at ? '' : 'font-weight-bold' }}">
									<th scope="row">{{ $key + 1 }}</th>
									<td><a href="{{ route('notifications.show', $notification->id) }}">{{ $notification->data['appointment_pain'] }}</a></td>
									<td>{{ $notification->data['appointment_date'] }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $notifications->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection