@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Foods Calculator</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Food" name="food">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Amount" name="amount" aria-describedby="amount-addon" value="0">
								<span class="input-group-addon" id="amount-addon">Kg</span>
							</div>
						</div>
					</div>
					<div class="row" style="padding-top: 20px;">
						<div class="col-sm-12 text-center" >
							<button type="button" class="btn btn-success" onclick="AddFood();" >Add Food</button>
						</div>
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
								
							</div>
						</div>
						<div class="col-sm-6">
							<p>Your total calories is <span id="totalKcal" style="font-size: 1.5em;"></span> kcal</p>
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
	var DeleteFood = function(id,cal){
		$('#food_' + id).remove();
		totalCal -= cal;
		Calculate();
	}
	var AddFood = function(){
		var f = $('[name=food]').val();
		var a = $('[name=amount]').val();
		var cal = Math.floor((Math.random() * 100) + 1) * a;
		var food = "<div id='food_" + count + "'><span>" + f + "</span> : Amount " + a + " = " + cal + " Kcal [<a onclick='DeleteFood(" + count + "," + cal + ")'>Delete</a>]</div>";
		$('#foodList').append(food);
		count++;
		totalCal += cal;
		Calculate();
	}
	var Calculate = function(){
		$('#totalKcal').html(totalCal.toFixed(2));
	}
</script>
@endsection