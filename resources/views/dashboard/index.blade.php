@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col">
			<div class="card">
				<div class="card-header">Dashboard</div>
				<div class="card-body">
					<a class="btn btn-primary btn-block" href="{{ route('dashboard.users.index') }}" role="button">Users</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection