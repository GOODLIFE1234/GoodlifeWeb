@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Exercises List</div>
				<div class="panel-body">
					<a href="exercises/add"><button class="btn btn-success">Add New Exercise</button></a>
					<table class="table table-striped">
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Kcal</th>
							<th>Manage</th>
						</tr>
						@foreach($exercises as $exercise)
						<tr>
							<td>{{$exercise->id}}</td>
							<td>{{$exercise->name}}</td>
							<td>{{$exercise->kcal}}</td>
							<td>
								<a href="exercises/edit/{{$exercise->id}}">Edit</a>
								<a href="exercises/delete/{{$exercise->id}}">Delete</a>
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