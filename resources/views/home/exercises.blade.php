@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Exercise Calculator</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-6">
							<select name="actid" id="actId">
								<option value="">- Select Activity -</option>
								<option value="227">Aerobics, general </option>
								<option value="228">Aerobics, high impact </option>
								<option value="229">Aerobics, low impact </option>
								<option value="230">Archery (nonhunting) </option>
								<option value="231">Automobile repair </option>
								<option value="232">Backpacking, general </option>
								<option value="233">Badminton, competitive </option>
								<option value="234">Badminton, social, general </option>
								<option value="235">Basketball, game </option>
								<option value="237">Basketball, officiating </option>
								<option value="238">Basketball, shooting baskets </option>
								<option value="239">Basketball, wheelchair </option>
								<option value="240">Bicycling, &lt;10mph, leisure </option>
								<option value="241">Bicycling, &gt;20mph, racing </option>
								<option value="242">Bicycling, 10-11.9mph, light effort </option>
								<option value="243">Bicycling, 12-13.9mph, moderate effort </option>
								<option value="244">Bicycling, 14-15.9mph, vigorous effort </option>
								<option value="245">Bicycling, 16-19mph, very fast, racing </option>
								<option value="246">Bicycling, BMX or mountain </option>
								<option value="253">Billiards, pool</option>
								<option value="254">Bowling </option>
								<option value="255">Boxing, in ring, general </option>
								<option value="256">Boxing, punching bag </option>
								<option value="257">Boxing, sparring </option>
								<option value="258">Broomball </option>
								<option value="259">Calisthenics (pushups, sit-ups), vigorous effort </option>
								<option value="260">Calisthenics,  light/moderate effort </option>
								<option value="262">Canoeing, rowing, &gt;6 mph, vigorous effort </option>
								<option value="264">Canoeing, rowing, light effort </option>
								<option value="265">Canoeing, rowing, moderate effort </option>
								<option value="266">Carpentry, general </option>
								<option value="267">Carrying heavy loads, such as bricks </option>
								<option value="268">Child care</option>
								<option value="270">Circuit training, general </option>
								<option value="273">Cleaning, light  effort </option>
								<option value="272">Cleaning, moderate effort</option>
								<option value="271">Cleaning, vigorous effort </option>
								<option value="274">Coaching </option>
								<option value="275">Construction, remodeling </option>
								<option value="276">Cooking or food preparation </option>
								<option value="277">Cricket</option>
								<option value="278">Croquet</option>
								<option value="279">Curling </option>
								<option value="280">Dancing, aerobic, ballet or modern, twist </option>
								<option value="281">Dancing, ballroom, fast </option>
								<option value="282">Dancing, ballroom, slow </option>
								<option value="283">Dancing, general </option>
								<option value="284">Darts, wall or lawn </option>
								<option value="285">Diving, springboard or platform </option>
								<option value="286">Electrical work, plumbing </option>
								<option value="287">Farming, baling hay, cleaning barn </option>
								<option value="288">Farming, milking by hand </option>
								<option value="289">Farming, shoveling grain </option>
								<option value="290">Fencing </option>
								<option value="291">Fishing from boat, sitting </option>
								<option value="292">Fishing from river bank, standing</option>
								<option value="293">Fishing in stream, in waders </option>
								<option value="294">Fishing, general </option>
								<option value="295">Fishing, ice, sitting </option>
								<option value="297">Football, competitive </option>
								<option value="296">Football, playing catch </option>
								<option value="298">Football, touch, flag, general </option>
								<option value="299">Frisbee playing, general </option>
								<option value="300">Frisbee, ultimate </option>
								<option value="301">Gardening, general </option>
								<option value="302">Golf, carrying clubs </option>
								<option value="303">Golf, general </option>
								<option value="304">Golf, miniature or driving range </option>
								<option value="305">Golf, pulling clubs </option>
								<option value="306">Golf, using power cart </option>
								<option value="307">Gymnastics, general </option>
								<option value="308">Hacky sack </option>
								<option value="309">Handball, general </option>
								<option value="310">Handball, team </option>
								<option value="311">Health club exercise, general </option>
								<option value="312">Hiking, cross country </option>
								<option value="313">Hockey, field </option>
								<option value="314">Hockey, ice </option>
								<option value="315">Horse grooming </option>
								<option value="316">Horse racing, galloping </option>
								<option value="317">Horseback riding, general</option>
								<option value="319">Horseback riding, slow</option>
								<option value="318">Horseback riding, trotting </option>
								<option value="320">Hunting, general </option>
								<option value="321">Jai alai </option>
								<option value="322">Jogging, general </option>
								<option value="323">Judo, karate, kick boxing, tae kwan do </option>
								<option value="324">Kayaking </option>
								<option value="325">Kickball </option>
								<option value="326">Lacrosse </option>
								<option value="327">Marching band, playing instrument</option>
								<option value="328">Marching, rapidly, military </option>
								<option value="329">Moto-cross </option>
								<option value="330">Moving furniture, household </option>
								<option value="332">Moving household items, carrying boxes </option>
								<option value="333">Mowing lawn, general </option>
								<option value="334">Mowing lawn, riding mower </option>
								<option value="335">Music playing, cello, flute, horn, woodwind</option>
								<option value="336">Music playing, drums </option>
								<option value="337">Music playing, guitar, classical, folk(sitting) </option>
								<option value="338">Music playing, guitar, rock/roll band(standing) </option>
								<option value="339">Music playing, piano, organ, violin, trumpet </option>
								<option value="340">Paddleboat </option>
								<option value="341">Painting, papering, plastering, scraping </option>
								<option value="436">Playing with children</option>
								<option value="342">Polo </option>
								<option value="343">Pushing or pulling stroller with child </option>
								<option value="344">Race walking </option>
								<option value="345">Racquetball, casual, general </option>
								<option value="346">Racquetball, competitive </option>
								<option value="347">Raking lawn </option>
								<option value="348">Rock climbing, ascending rock </option>
								<option value="349">Rock climbing, rapelling </option>
								<option value="350">Rope jumping, fast </option>
								<option value="351">Rope jumping, moderate, general </option>
								<option value="352">Rope jumping, slow </option>
								<option value="353">Rowing, stationary, light effort </option>
								<option value="354">Rowing, stationary, moderate effort </option>
								<option value="355">Rowing, stationary, very vigorous effort </option>
								<option value="356">Rowing, stationary, vigorous effort </option>
								<option value="357">Rugby </option>
								<option value="367">Running, 10 mph (6 min mile) </option>
								<option value="368">Running, 10.9 mph (5.5 min mile) </option>
								<option value="358">Running, 5 mph (12 min mile) </option>
								<option value="359">Running, 5.2 mph (11.5 min mile) </option>
								<option value="360">Running, 6 mph (10 min mile) </option>
								<option value="361">Running, 6.7 mph (9 min mile) </option>
								<option value="362">Running, 7 mph (8.5 min mile) </option>
								<option value="363">Running, 7.5mph (8 min mile) </option>
								<option value="364">Running, 8 mph (7.5 min mile) </option>
								<option value="365">Running, 8.6 mph (7 min mile) </option>
								<option value="366">Running, 9 mph (6.5 min mile) </option>
								<option value="369">Running, cross country </option>
								<option value="370">Running, general </option>
								<option value="372">Running, on a track, team practice </option>
								<option value="373">Running, stairs, up </option>
								<option value="374">Running, training, pushing wheelchair </option>
								<option value="376">Sailing, boat/board sailing, windsurfing </option>
								<option value="377">Sailing, in competition</option>
								<option value="379">Shoveling snow, by hand </option>
								<option value="380">Shuffleboard, lawn bowling </option>
								<option value="381">Sitting-playing with children-light </option>
								<option value="382">Skateboarding </option>
								<option value="383">Skating, ice, 9 mph or less </option>
								<option value="384">Skating, ice, general </option>
								<option value="385">Skating, ice, rapidly, &gt; 9 mph </option>
								<option value="386">Skating, ice, speed, competitive </option>
								<option value="387">Skating, roller </option>
								<option value="388">Ski jumping</option>
								<option value="389">Ski machine, general </option>
								<option value="400">Ski-mobiling, water </option>
								<option value="390">Skiing, cross-country, &gt;8.0 mph, racing </option>
								<option value="391">Skiing, cross-country, moderate effort </option>
								<option value="392">Skiing, cross-country, slow or light effort </option>
								<option value="393">Skiing, cross-country, uphill, maximum effort </option>
								<option value="394">Skiing, cross-country, vigorous effort </option>
								<option value="395">Skiing, downhill, light effort </option>
								<option value="396">Skiing, downhill, moderate effort </option>
								<option value="397">Skiing, downhill, vigorous effort, racing </option>
								<option value="398">Skiing, snow, general </option>
								<option value="399">Skiing, water </option>
								<option value="401">Skin diving, scuba diving, general </option>
								<option value="402">Sledding, tobogganing, bobsledding, luge </option>
								<option value="403">Snorkeling </option>
								<option value="404">Snow shoeing </option>
								<option value="405">Snowmobiling </option>
								<option value="406">Soccer, casual, general </option>
								<option value="407">Soccer, competitive </option>
								<option value="408">Softball or baseball, fast or slow pitch </option>
								<option value="409">Softball, officiating </option>
								<option value="410">Squash </option>
								<option value="411">Stair-treadmill ergometer, general </option>
								<option value="413">Stretching, hatha yoga </option>
								<option value="414">Surfing, body or board </option>
								<option value="415">Sweeping </option>
								<option value="416">Swimming laps, freestyle, fast, vigorous effort </option>
								<option value="417">Swimming laps, freestyle, light/moderate effort </option>
								<option value="418">Swimming, backstroke, general </option>
								<option value="419">Swimming, breaststroke, general </option>
								<option value="420">Swimming, butterfly, general </option>
								<option value="421">Swimming, leisurely, general </option>
								<option value="422">Swimming, sidestroke, general </option>
								<option value="423">Swimming, sychronized </option>
								<option value="424">Swimming, treading, water, fast, vigorous effort </option>
								<option value="425">Swimming, treading, water, moderate effort </option>
								<option value="426">Table tennis, ping pong</option>
								<option value="427">Tai chi </option>
								<option value="428">Teaching aerobics class </option>
								<option value="429">Tennis, doubles </option>
								<option value="430">Tennis, general </option>
								<option value="431">Tennis, singles </option>
								<option value="432">Unicycling </option>
								<option value="433">Volleyball, beach </option>
								<option value="434">Volleyball, competitive, in gymnasium </option>
								<option value="435">Volleyball, noncompetitive; 6-9 member team </option>
								<option value="438">Walking, 2.0 mph, slow pace </option>
								<option value="439">Walking, 3.0 mph, moderate pace, walking dog </option>
								<option value="440">Walking, 3.5 mph, uphill </option>
								<option value="441">Walking, 4.0 mph, very brisk pace </option>
								<option value="442">Walking, carrying infant or 15-lb load </option>
								<option value="443">Walking, grass track </option>
								<option value="444">Walking, upstairs </option>
								<option value="445">Walking, using crutches </option>
								<option value="446">Wallyball, general </option>
								<option value="447">Water aerobics, water calisthenics </option>
								<option value="448">Water polo </option>
								<option value="449">Water volleyball </option>
								<option value="450">Weight lifting or body building, vigorous effort </option>
								<option value="451">Weight lifting, light or moderate effort </option>
								<option value="452">Whitewater rafting, kayaking, or canoeing </option>
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
							<button type="button" class="btn btn-success" onclick="AddExercise();" >Add Exercise</button>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default" id="result">
				<div class="panel-heading">Result</div>
				<div class="panel-body">
					<div class="row" style="">
						<div class="col-sm-6">
							<h2>Your Exercise</h2>
							<div id="activityList">
								
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