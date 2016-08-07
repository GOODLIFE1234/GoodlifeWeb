@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Foods List</div>
				<div class="panel-body">
					<a href="foods/add"><button class="btn btn-success">Add New Food</button></a>
					<table class="table table-striped">
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Kcal</th>
							<th>Manage</th>
						</tr>
						@foreach($foods as $food)
						<tr>
							<td>{{$food->id}}</td>
							<td>{{$food->name}}</td>
							<td>{{$food->kcal}}</td>
							<td>
								<a href="foods/edit/{{$food->id}}">Edit</a>
								<a href="foods/delete/{{$food->id}}">Delete</a>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection