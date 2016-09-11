@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">BMR Calculator</div>
				<div class="panel-body">
					<form method="POST" action="">
						<div class="row" >
							<div class="col-sm-6">
								<div class="row">
									<div class="col-sm-12">
										<strong>Gender</strong>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name="gender" value="1" aria-label="..." checked="">
											</span>
											<input type="text" class="form-control" aria-label="..." value="Male" disabled="">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="input-group">
											<span class="input-group-addon">
												<input type="radio" name="gender" value="2" aria-label="...">
											</span>
											<input type="text" class="form-control" value="Female" aria-label="..." disabled="">
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Age" name="age" aria-describedby="age-addon">
									<span class="input-group-addon" id="age-addon">Years</span>
								</div>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;">
							<div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Weight" name="weight" aria-describedby="weight-addon">
									<span class="input-group-addon" id="weight-addon">Kg</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Height" name="height" aria-describedby="height-addon">
									<span class="input-group-addon" id="height-addon">cm</span>
								</div>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;">
							<div class="col-sm-12 text-center" >
								<!-- <button type="button" class="btn btn-success" onclick="Calculate();" >Calculate</button> -->
								{{csrf_field()}}
								<button type="submit" class="btn btn-success" >Calculate</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-default" id="result" >
				<div class="panel-heading">Result</div>
				<div class="panel-body">
					<div class="row" style="">
						<div class="col-sm-12">
							<h2>BMR : <?php isset($bmi)? print($bmi): "";?></h2>
							<p>
								<ul class="expert">
									<?php isset($detail)? print($detail): "";?>
								</ul>
							</p>
							<small>Your BMR (Basal Metabolic Rate) is an estimate of how many calories you'd burn if you were to do nothing but rest for 24 hours. It represents the minimum amount of energy needed to keep your body functioning, including breathing and keeping your heart beating.</small>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	var Calculate = function(){
		$("#result").show();
		var a = $("[name=age]").val();
		var w = $("[name=weight]").val();
		var h = $("[name=height]").val();
		var g = $("[name=gender]").val();
		var cal = 0;
		if(g == 1){
			cal = (13.937*w)+(4.799*h)-(5.677*a)+88.362;
		}
		else if(g == 2){
			cal = (9.247*w)+(3.098*h)-(4.330*a)+447.593;
		}
		console.log(cal);
		$('#bmrResult').html(cal.toFixed(2));
	}
</script>
@endsection