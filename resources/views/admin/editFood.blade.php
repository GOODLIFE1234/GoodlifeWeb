@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Add Food</div>
				<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" id="name"  value="{{$food->name}}" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="kcal">Based Calories</label>
							<input type="text" name="kcal" class="form-control" id="kcal" value="{{$food->kcal}}" placeholder="Calories">
						</div>
						{{ csrf_field() }}
						<input type="hidden" value="{{$food->id}}" name="id">
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection