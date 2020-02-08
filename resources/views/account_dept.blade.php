@extends('layouts.main')
@section('content')
<title>Khaf Beaute Legacy: Accounting Department</title>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<h3 style="margin-left: 3%; padding-top: 3%;">
	Invoice Number
	<!-- Large modal -->	
	<div>
		<!-- Trigerring Modal with a button -->
		<input type="text" name="invoice" id="invoice" required>
		<!-- Button trigger modal -->
		<a href="javascript:void(0);" data-href="/khafbeautelegacy/khafsys/invoice" class="btn btn-m openPopup" >Check</a>
		<!-- <a type="button" class="btn btn-primary" data-href="/khafbeautelegacy/khafsys/invoice" data-toggle="modal"  data-target="#myModal" >
			check
		</a> -->
	</div>
</h3>
<!-- Check Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-xl" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<center><h5 class="modal-title" id="exampleModalLabel">INVOICE</h5></center>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
			</div>
			<center><div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</center>
	</div>
</div>
</div>

<script>$(document).ready(function(){
	$('.openPopup').on('click',function(){
		var dataURL = $(this).attr('data-href');
		$('.modal-body').load(dataURL,function(){
			$('#myModal').modal({show:true});
		});
	}); 
});
</script>

<div class="form-row mb-4">
	<div class="col" style="margin-left: 3%; padding-top: 3%;">
		<!-- Reports for Daily, Weekly,Monthly and Annual For View and Print -->
		<h1><strong>REPORTS</strong></h1>
		<table border="1" cellpadding="10">
			<div class="w2-second w2-section">
				<div class="w3-card-4" id="reportcard">
					<div class="w3-container w3-white">
						<h4>Daily<br></h4>
						<input type="date" name="dob" style="width: 50%;">
						<button type="submit" id="dailyagg" name="dailyagg" >Check</button>
						<h4>Weekly<br></h4>
						<input type="date" name="dob" style="width: 50%;">
						<button type="submit" id="weeklyagg" name="weeklyagg" >Check</button>
						<h4>Monthly<br></h4>
						<input type="date" name="dob" style="width: 50%;">
						<button type="submit" id="monthlyagg" name="monthlyagg" >Check</button>
						<h4>Yearly<br></h4>
						<input type="date" name="dob" style="width: 50%;">
						<button type="submit" id="yearlyagg" name="yearlyagg" >Check</button>
					</div>
				</div>
			</div>
		</table>
	</div>
	<div class="col" style="margin-left: 3%; padding-top: 3%;">
		<h1><strong>COSTING</strong></h1>
		<!-- Reports Costing  -->
		<table border="1" cellpadding="10">
			<div class="w2-second w2-section">
				<div class="w3-card-4" id="costcard">
					<div class="w3-container w3-white">
						<h4>Cost Per Customer (RM)<br></h4>
						<input type="text" id="cpc" name="cpc" style="width: 70%;">
						<h4>Cost Per Leads (RM)<br></h4>
						<input type="text" id="cpl" name="cpl" style="width: 70%;">
						<h4>Profits (RM)<br></h4>
						<input type="text" id="prft" name="prft" style="width: 70%;">
						<h4>Loss (RM)<br></h4>
						<input type="text" id="ls" name="ls" style="width: 70%;">
						<h4>Advertisement Cost (RM)<br></h4>
						<input type="text" id="ac" name="ac" style="width: 70%;">
						<center><br><button name="reset"  type="button" id="button" style="width: 30%;">Reset</button>
							<button name="submit"  type="button" id="button" style="width: 30%;">Submit</button></center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</table>
</div>
</div>
<br>
@endsection