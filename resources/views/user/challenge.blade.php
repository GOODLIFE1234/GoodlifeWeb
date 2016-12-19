@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default" id="result">
				<div class="panel-heading">Challenge</div>
				<div class="panel-body">
					<div class="row" style="">
						<div class="col-sm-6">
							<h2 style="
							text-align: center;
							">Today Challenge</h2>
							<div id="activityList">
								<h3 style="
								text-align: center;
								background-color: white;
								">{{$user->profile->record}} cal</h3>
							</div>
							<div class="text-center" style="color: green">
								<?php if($user->profile->record >= $user->profile->challenge){?>
									You have succeed the challenge
								<?php }?>
							</div>
						</div>
						<div class="col-sm-6">
							<p>Your Status<span id="totalKcal" style="font-size: 1.5em;"></span></p>
							<p>
								<?php
									$raw = json_decode($user->profile->raw);
								?>
								Goal: {{$user->profile->challenge}} cal <br>
								Today Ditance: {{$raw->todayDistance}} m
								<br>
								Today Velocity: {{($raw->todayVelocity * 18) / 5}} km/h<br>
								Next Challenge: {{ $user->profile->challenge + ($user->profile->challenge * $user->profile->percent / 100)}} cal
								<br style="
								margin-bottom: 50px;
								">
							</p>
							<div>
								<form method="post" action="{{url('/member/chage-percent')}}">
									{{csrf_field()}}
									<input type="hidden" name="id" value="{{$user->id}}" />
									<input type="text" style="width: 50px;text-align: right;padding: 0 10px;" name="percent" value="{{$user->profile->percent}}"><button onclick="return confirm('Confirm change percentage?');">Change Percent</button>
								</form>
							</div>
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
	if(typeof Android !== 'undefined'){
		Android.updateChallenge('<?=url('/api/save-progress')?>',<?=$user->id?>);
		setTimeout(function(){
			window.location.reload(1);
		}, 10000);
	}
</script>
@endsection