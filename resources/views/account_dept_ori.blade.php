@extends('layouts.main')
@section('content')

<title>Khaf Beaute Legacy: Account Departments</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-amber.css">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
<style>
	input{
		width: 37%;
	}
	#costinput{
		width: 50%;
	}
	#button{
		width: 15%;
		height: 15%;
		margin-left: 5%;
		margin-right: 5%;
		/*my reference, # is for id type*/
	}
	h3{
		padding-top: 3%;
		padding-left: 3%;
	}
	h1{
		margin-left: 6%;
		font-weight: bold;
		font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
	}
	button{
		margin-left: 20%;
	}
	#reportcard{
		margin-right: 5%;
		margin-left: 6%;
		padding-bottom: 5%;
	}
	#costcard{
		margin-right: 15%;
		margin-left: 6%;
		padding-bottom: 5%;
	}
</style>
<script src="jquery-3.4.1.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto&display=swap' rel='stylesheet'>
<script>
	$(document).ready(function(){
		$("input").focus(function(){
			$(this).css("background-color", "rgb(255,233,236)");
		});
		$("input").blur(function(){
			$(this).css("background-color", "#ffffff");
		});

		$("body").css({
			"font-family": "Roboto",
			"font-size": "16px"
		});
		$("body, select, input, button").css({
			"font-family": "Roboto",
			"font-size": "16px"
		});
		$("tr:even").not(':first').hover(function() {
			$(this).css({"background-color": "#ffc0cb","color": "#282828"});
		},
		function() {
			$(this).css({"background-color":"white", "color": "black"});
		});
		// $("tr:odd").hover(function(){
		// 	$(this).css({"background-color":"#fecdc1","color": "#282828"});
		// },
		function() {
			$(this).css({"background-color":"white", "color": "black"});
		});
});

</script>
<h3>
	Invoice Number
	<!-- Large modal -->

	<div>
		<!-- Trigerring Modal with a button -->
		<input type="text" name="invoice" id="invoice" required>
		<a href="/khafbeautelegacy/khafsys/invoice"  data-href="/khafbeautelegacy/khafsys/invoice" class="btn btn-warning btn-xs openPopup">Check</a>
	</div></h3>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Invoice</h4>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<script>$(document).ready(function(){
		$('.openPopup').on('click',function(){
			var dataURL = $(this).attr('href');
			$('.modal-body').load(dataURL,function(){
				$('#myModal').modal({show:true});
			});
		}); 
	});
</script>

<div class="form-row mb-4">
	<div class="col">
		<!-- Reports for Daily, Weekly,Monthly and Annual For View and Print -->
		<h1>REPORTS</h1>
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
	<div class="col">
		<h1>COSTING</h1>
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