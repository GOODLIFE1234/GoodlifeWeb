@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Users</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Manage</th>
						</tr>
						@foreach($users as $user)
						<tr>
							<td>{{$user->id}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td><a href="users/delete/{{$user->id}}">Delete</a></td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection