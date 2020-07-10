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
					Users
					<a class="btn btn-primary float-right" href="{{ route('dashboard.users.create') }}" role="button">Create</a>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Username</th>
								<th scope="col">E-Mail address</th>
								<th scope="col">Type</th>
								<th scope="col">Options</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
								<tr>
									<th scope="row">{{ $user->id }}</th>
									<td><a href="{{ route('dashboard.users.show', $user->id) }}">{{ $user->username }}</a></td>
									<td>{{ $user->email }}</td>
									<td>{{ App\Enums\UserType::getTypeString($user->type) }}</td>
									<td class="text-center">
										<div class="btn-group" role="group" aria-label="Basic example">
											<a class="btn btn-success" href="{{ route('dashboard.users.edit', $user->id) }}" role="button">Edit</a>
											<a class="btn btn-danger" href="{{ route('dashboard.users.destroy', $user->id) }}" onclick="event.preventDefault(); document.getElementById('delete-{{ $user->id }}').submit();">Delete</a>
										</div>
										<form id="delete-{{ $user->id }}" action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: none;">
											@csrf
											@method('DELETE')
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $users->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection