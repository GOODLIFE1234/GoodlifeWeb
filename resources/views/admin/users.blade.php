@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form method="get" action="">
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name" class="col-md-4 control-label">Search : Name or Surname</label>
							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="n" value="{{ old('n') }}">
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-primary">
								Search
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
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
						<th>Name</th>
						<th>Surname</th>
						<th>Manage</th>
					</tr>
					@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->username}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->surname}}</td>
						<td><a href="users/delete/{{$user->id}}" onclick="return confirm('Confirm delete?');">Delete</a></td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>
</div>
@endsection