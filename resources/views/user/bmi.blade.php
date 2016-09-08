@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">BMI Calculator</div>
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
							<h2>BMI : <?php isset($bmi)? print($bmi): "";?></h2>
							<p>
								<ul class="expert">
									<?php isset($detail)? print($detail): "";?>
									<!-- <li>
											ตั้งใจ หาเหตุผลและแรงจูงใจในการลดน้ำหนักในครั้งนี้ให้ได้ อาจจะเป็นเสื้อผ้าที่ชอบในขนาดที่เล็กกว่าขนาดตัวปัจจุบัน (แต่ต้องอยู่บนพื้นฐานของความเป็นไปได้) และบอกคนรอบข้างให้รับทราบ ให้เป็นกำลังใจ และเป็นแรงกดดันให้ตัวเองด้วย
									</li>
									<li>
											ตั้งเป้าหมาย น้ำหนักตัวที่เหมาะสมหรือที่คิดว่าควรจะเป็น แนะนำให้ตั้งเป้าหมายเป็นระยะเวลาสั้นๆ เช่น
											ภายในเวลา 1 เดือน ต้องการลดน้ำหนัก 1 กิโลกรัม เป็นต้น (การลดน้ำหนัก 1 กิโลกรัม ในเวลา 1 เดือน
											คือการรับประทานอาหารที่ให้พลังงานน้อยกว่าที่ร่างกายต้องการใช้ 7,000 กิโลแคลอรี หรือการ
											รับประทานอาหารที่ให้พลังงานน้อยกว่าที่ร่างกายต้องการใช้ประมาณ 240 กิโลแคลอรีต่อวัน)
									</li>
									<li>
											ถ่ายรูป ชั่งน้ำหนัก ไว้เป็นจุดเริ่มต้นของปฏิบัติการในครั้งนี้ เช่นเดียวกับการทดลองทางวิทยาศาสตร์ที่จำเป็นต้องมีการเปรียบเทียบก่อน-หลัง เพื่อดูการเปลี่ยนแปลงและเป็นกำลังใจ
									</li>
									<li>
											เริ่มปฏิบัติการทางโภชนาการ โดยคำนวณความต้องการพลังงานของตนเองต่อวัน แต่ให้รับประทานให้น้อยกว่าที่ต้องการ 300-400 กิโลแคลอรีต่อวัน <a class="link">ตารางแสดงความต้องการพลังงานต่อวัน</a>
									</li> -->
								</ul>
							</p>
						</div>
<!-- 						<div class="col-sm-6">
							<h2>BMR</h2>
							<p>Your BMR is at <span id="bmrResult" style="font-size: 1.5em;"></span> kcal/day</p>
						</div> -->
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