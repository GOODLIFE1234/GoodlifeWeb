@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Food Planner</div>
				<div class="panel-body">
					<div>
						<a href="<?php echo e(url('/member/add-food')); ?>"><button type="submit" class="btn btn-success">Add Foods</button></a>
						<a class="pull-right" href="<?php echo e(url('/member/foods-planner-history')); ?>">[History]</a>
					</div>
					<form method="POST" action="">
						<div class="row" style="padding-top: 20px;">
							<div class="col-sm-12">
								<?php if(session::has('today')): ?>
								<?php
								$planner    = session::get('today');
								$today      = date('l');
								$weekTotal  = 0;
								$todayTotal = 0;
								?>
								<table class="table table-bordered">
									<tr>
										<th></th>
										<th>Monday</th>
										<th>Tuesday</th>
										<th>Wednesday</th>
										<th>Thursday</th>
										<th>Friday</th>
										<th>Saturday</th>
										<th>Sunday</th>
									</tr>
									<tr>
										<td>Breakfast</td>
										<?php foreach ($planner as $key => $day): if($key !== 'Week'){?>
										<td>
											<?php foreach ($day->breakfast as $fkey => $food): if($food != null){?>
											<?php
											$querystring = "?d=" . $key . "&t=breakfast&id=" . $fkey;
											$totalCal    = $food->amount * $food->kcal;
											$weekTotal += $totalCal;
											if ($key === $today) {
											$todayTotal += $totalCal;
											}
											?>
											<div><?php echo e($food->name); ?> <?php echo e($totalCal); ?> cal <a href="<?php echo url('/member/food-planner/delete' . $querystring); ?>" onclick="return confirm('delete');">[Delete]</a></div>
											<?php } endforeach?>
										</td>
										<?php } endforeach?>
										<!-- <td>Somtum 150 cal <a href="#">[Delete]</a></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td> -->
									</tr>
									<tr>
										<td>Lunch</td>
										<?php foreach ($planner as $key => $day): if($key !== 'Week'){?>
										<td>
											<?php foreach ($day->lunch as $fkey => $food): if($food != null){?>
											<?php
											$querystring = "?d=" . $key . "&t=lunch&id=" . $fkey;
											$totalCal    = $food->amount * $food->kcal;
											$weekTotal += $totalCal;
											if ($key === $today) {
											$todayTotal += $totalCal;
											}
											?>
											<div><?php echo e($food->name); ?> <?php echo e($totalCal); ?> cal <a href="<?php echo url('/member/food-planner/delete' . $querystring); ?>" onclick="return confirm('delete');">[Delete]</a></div>
											<?php } endforeach?>
										</td>
										<?php } endforeach?>
									</tr>
									<tr>
										<td>Dinner</td>
										<?php foreach ($planner as $key => $day): if($key !== 'Week'){?>
										<td>
											<?php foreach ($day->dinner as $fkey => $food): if($food != null){?>
											<?php
											$querystring = "?d=" . $key . "&t=dinner&id=" . $fkey;
											$totalCal    = $food->amount * $food->kcal;
											$weekTotal += $totalCal;
											if ($key === $today) {
											$todayTotal += $totalCal;
											}
											?>
											<div><?php echo e($food->name); ?> <?php echo e($totalCal); ?> cal <a href="<?php echo url('/member/food-planner/delete' . $querystring); ?>" onclick="return confirm('delete');">[Delete]</a></div>
											<?php } endforeach?>
										</td>
										<?php } endforeach?>
									</tr>
									<tr>
										<td>Snack</td>
										<?php foreach ($planner as $key => $day): if($key !== 'Week'){?>
										<td>
											<?php foreach ($day->snack as $fkey => $food): if($food != null){?>
											<?php
											$querystring = "?d=" . $key . "&t=snack&id=" . $fkey;
											$totalCal    = $food->amount * $food->kcal;
											$weekTotal += $totalCal;
											if ($key === $today) {
											$todayTotal += $totalCal;
											}
											?>
											<div><?php echo e($food->name); ?> <?php echo e($totalCal); ?> cal <a href="<?php echo url('/member/food-planner/delete' . $querystring); ?>" onclick="return confirm('delete');">[Delete]</a></div>
											<?php } endforeach?>
										</td>
										<?php } endforeach?>
									</tr>
								</table>
								<?php endif; ?>
							</div>
						</div>
						<div class="row" style="padding-top: 20px;">
							<?php if(session::has('today')): ?>
							<div class="col-sm-12" >
								<div><strong>Total Calories</strong>: <?php echo e($weekTotal); ?></div>
								<hr>
								<div><strong>BMR</strong>: <?php if(Auth::user()->profile !== null): ?> <?php echo e(Auth::user()->profile->bmr); ?> <?php else: ?> <a href="<?php echo e(url('/bmr')); ?>">*Click here to calculate BMR*</a> <?php endif; ?></div>
								<div><strong>Today Calories</strong>: <?php echo e($todayTotal); ?></div>
								<div>
									<?php
									$left = 0;
									if (Auth::user()->profile !== null) {
									$left = Auth::user()->profile->bmr - $todayTotal;
									}
									?>
									<strong>Left</strong>: <?php if($left >= 0): ?> <span style="color: green;"><?php echo e($left); ?></span> <?php elseif($left < 0): ?> <span style="color: red;"><?php echo e($left); ?></span> <?php endif; ?>
								</div>
							</div>
							<?php 
								$raw = session::get("rawData");
								// echo var_dump($raw);
								$raw->todayFood = $weekTotal;
								Auth::user()->profile->saveRaw(json_encode($raw));
							?>
							<?php endif; ?>
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