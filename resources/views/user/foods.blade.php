@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Foods Calculator</div>
				<div class="panel-body">
					<div class="row">
						<form action="" method="POST">
							@foreach($foods as $food)
							<div class="col-md-6">
								<!-- 							<div class="checkbox" id="food_{{$food->id}}">
									<label>
										<input type="checkbox" name="food" class="food_checkbox" data-kcal="{{$food->kcal}}" onclick="AddFood('{{$food->name}}',{{$food->kcal}},{{$food->id}})">
									</label>
								</div> -->
								<!-- <div class="input-group">
											<span class="input-group-addon">
														<input type="checkbox" name="food[]"  id="food_check_{{$food->id}}" class="food_checkbox" value="$food->id" onclick="AddFood('{{$food->name}}',{{$food->kcal}},{{$food->id}}, this)"> {{$food->name}} | {{$food->kcal}} Kcal
											</span>
											<input type="text" placeholder="amount" id="food_amount_{{$food->id}}" value="0" class="form-control" aria-label="...">
								</div> -->
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="list[{{$food->id}}][id]"  id="food_check_{{$food->id}}" class="food_checkbox" value="{{$food->id}}"> {{$food->name}} | {{$food->kcal}} Kcal
									</span>
									<input type="hidden" name="list[{{$food->id}}][kcal]" value="{{$food->kcal}}">
									<input type="hidden" name="list[{{$food->id}}][name]" value="{{$food->name}}">
									<input type="text" placeholder="amount" name="list[{{$food->id}}][amount]" id="food_amount_{{$food->id}}" value="0" class="form-control">
								</div>
							</div>
							@endforeach
							<!-- <div class="col-sm-6">
																		<div class="input-group">
																													<input type="text" class="form-control" placeholder="Food" name="food">
																		</div>
							</div>
							<div class="col-sm-6">
																		<div class="input-group">
																													<input type="text" class="form-control" placeholder="Amount" name="amount" aria-describedby="amount-addon" value="0">
																													<span class="input-group-addon" id="amount-addon">Kg</span>
																		</div>
							</div> -->
							<div class="col-md-12 text-center">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-success">Add Foods</button>
							</div>
						</form>
					</div>
					<div class="row" style="padding-top: 20px;">
						@if(Auth::check())
						<div class="col-sm-12 text-center" >
							<button type="button" class="btn btn-success" onclick="AddFood();" >Save Today Foods</button>
						</div>
						@endif
						<!-- <div class="col-sm-12 text-center" >
										<button type="button" class="btn btn-success" onclick="AddFood();" >Add Food</button>
						</div> -->
					</div>
				</div>
			</div>
			<div class="panel panel-default" id="result">
				<div class="panel-heading">Result</div>
				<div class="panel-body">
					<div class="row" style="">
						<div class="col-sm-6">
							<h2>Your Foods</h2>
							<div id="foodList">
								<?php 
									if(Session::has('foodList')){
										$list = Session::get('foodList');
										foreach ($list as $key => $value) { 
											if($key !== "total"){?>
											<div><span> {{$value['name']}} </span> : Amount {{$value['amount']}} - {{$value['total']}} Kcal [<a href="?del={{$key}}"> Delete</a>]</div>
										<?php }
										}
									}
								?>
							</div>
						</div>
						<div class="col-sm-6">
							<p>Your total calories is <span id="totalKcal" style="font-size: 1.5em;"><?php if(Session::has('foodList')){$list = Session::get('foodList'); print($list["total"]);} ?></span> kcal</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	var count = 0;
	var totalCal = 0;
	var Calculate = function(){
		$('#totalKcal').html(totalCal.toFixed(2));
	}
	// var CalculateCal = function(){
	// }
	var DeleteFood = function(id,cal){
		$('#food_check_' + id).prop('checked',false);
		$('#food_' + id).remove();
		totalCal -= cal;
		Calculate();
	}
	var AddFood = function(f,a,i,e){
		// var f = $('[name=food]').val();
		// var a = $('[name=amount]').val();
		var c = $('#food_amount_' + i).val();
		var cal = Math.floor((c * 100) + 1) * a;
		var isCheck = e.checked;
		if(!isCheck){
			DeleteFood(i,cal);
			return;
		}else{
				AppendFood(i,f,a,cal);
			return;
		}
	}
	var AppendFood = function(i,f,a,cal){
		var food = "<div id='food_" + i + "'><span>" + f + "</span> : Amount " + a + " = " + cal + " Kcal [<a onclick='DeleteFood(" + i + "," + cal + ")'>Delete</a>]</div>";
		$('#foodList').append(food);
		count++;
		totalCal += cal;
		Calculate();
	}
</script>
@endsection