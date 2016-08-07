@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Exercise</div>
				<div class="panel-body">
					<form action="exercises/update" method="POST">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="name" name="name" class="form-control" id="name" value="{{$exercise->name}}" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="kcal">Based Calories</label>
							<input type="password" name="kcal" class="form-control" id="kcal" value="{{$exercise->kcal}}" placeholder="Calories">
						</div>
						{{ csrf_field() }}
						<input type="hidden" value="{{$exercise->id}}" name="id">
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection