@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Exercise Calculator</div>
				<div class="panel-body">
					<form action="" method="POST">
						<div class="row">
							<div class="col-sm-6">
								<select name="id" id="actId">
									<option value="">- Select Activity -</option>
									<?php foreach($exercises as $data){ ?>
									<option value="{{$data->id}}">{{$data->name}}</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Weight" name="weight" aria-describedby="weight-addon" value="0">
									<span class="input-group-addon" id="weight-addon">Kg</span>
								</div>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;">
							<div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Hours" name="hours" aria-describedby="hours-addon" value="1">
									<span class="input-group-addon" id="hours-addon">hrs</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Minutes" name="minutes" aria-describedby="minutes-addon" value="0">
									<span class="input-group-addon" id="minutes-addon">mins</span>
								</div>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;">
							<div class="col-sm-12 text-center" >
								<!-- <button type="button" class="btn btn-success" onclick="AddExercise();" >Add Exercise</button> -->
								{{csrf_field()}}
								<button type="submit" class="btn btn-success" >Add Exercise</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-default" id="result">
				<div class="panel-heading">Result</div>
				<div class="panel-body">
					<div class="row" style="">
						<div class="col-sm-6">
							<h2>Your Exercise</h2>
							<div id="activityList">
								<?php 
									if(Session::has('exerciseList')){
										$list = Session::get('exerciseList');
										foreach ($list as $key => $value) { 
											if($key !== "total"){?>
											<div><span> {{$value['name']}} </span> - {{$value['mins']}} mins [<a href="?del={{$key}}"> Delete</a>]</div>
										<?php }
										}
									}
								?>
							</div>
						</div>
						<div class="col-sm-6">
							<p>Your total calories is <span id="totalKcal" style="font-size: 1.5em;"><?php if(Session::has('exerciseList')){$list = Session::get('exerciseList'); print($list["total"]);} ?></span> kcal</p>
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
	var DeleteExercise = function(id,cal){
		$('#act_' + id).remove();
		totalCal -= cal;
		Calculate();
	}
	var AddExercise = function(){
		var actId = $('#actId').val();
		var actName = $('#actId option[value="' + actId + '"]').html();
		var w = $('[name=weight]').val();
		var hr = $('[name=hours]').val();
		var mn = $('[name=minutes]').val();
		var cal = (w*((hr*60)+mn)*0.117);
		var activity = "<div id='act_" + count + "'><span>" + actName + "</span> : " + cal + "kcal [<a onclick='DeleteExercise(" + count + "," + cal + ")'>Delete</a>]</div>";
		$('#activityList').append(activity);
		count++;
		totalCal += cal;
		Calculate();
	}
	var Calculate = function(){
		$('#totalKcal').html(totalCal.toFixed(2));
	}
</script>
@endsection