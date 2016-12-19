@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Report</div>
				<div class="panel-body">
					<form method="POST" action="">
						<div class="row" style="">
							<div class="col-sm-6">
								<h2>Personal Data</h2>
								Height: {{$user->profile->height}} cm<br>
								Weight: {{$user->profile->weight}}  kg<br>
								Age: {{$user->profile->age}}  <br>
								BMI: {{$user->profile->bmi}} <br>
								<div class="alert alert-info" role="alert">If you are overweight Dental Federation as diabetes, high cholesterol ortrying to lose weight, a body mass index lower than 23.</div>
								BMR: {{$user->profile->bmr}} <br>
							</div>
							<div class="col-sm-6">
								<?php 
								$raw = json_decode($user->profile->raw); 
								$left = $user->profile->bmr - $raw->todayFood;
								$accelometer = 2.2*$user->profile->weight*$raw->todayTime;
								?>
								<h2>Calories Status</h2>
								Today Calories : {{$raw->todayFood}} <br>
								Exercise : {{$user->profile->record}}  Cal<br>
								Accelometer : {{$accelometer}} Cal<br>
								Left : {{$left}}<br>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	// var Calculate = function(){
		// $("#result").show();
		// var a = $("[name=age]").val();
		// var w = $("[name=weight]").val();
		// var h = $("[name=height]").val();
		// var g = $("[name=gender]").val();
		// var cal = 0;
		// if(g == 1){
			// cal = (13.937*w)+(4.799*h)-(5.677*a)+88.362;
		// }
		// else if(g == 2){
			// cal = (9.247*w)+(3.098*h)-(4.330*a)+447.593;
		// }
		// console.log(cal);
		// $('#bmrResult').html(cal.toFixed(2));
	// }
</script>
@endsection