@extends('layouts.main')
@section('content')
<title>Khaf Beaute Legacy: Leads</title>
<style>
	input{
		margin-bottom: 1%;
	}
</style>

<div class="form-row mb-4">
	<div class="col">
		<table border="1" cellpadding="10">
			<div class="w2-second w2-section" style="margin-left: 3%; padding-top: 3%;margin-right: 3%;">
				<strong><h2>CHECK IN LEADS</h2></strong>
				<p></p><br>
				<div class="w3-card-4" id="reportcard">
					<div class="w3-container w3-white" >
						<h4>FIRST NAME:<br></h4>
						<input type="text" name="fname" style="width: 70%;">
						<h4>LAST NAME:<br></h4>
						<input type="text" name="lname" style="width: 70%;">
						<h4>CONTACT NUMBER:<br></h4>
						<input type="text" name="contactnumber" style="width: 70%;">
						<h4>ADDRESS:</h4>
						<input type="text" name="address" style="width: 70%;">
					</div>
				</div>
			</div>
		</table>
	</div>
</div>

<center>
	<button name="reset"  type="button" id="button" style="width: 10%;">Reset</button>
	<button name="submit"  type="button" id="button" style="width: 10%;">Submit</button>
</center><br><br><br><br><br><br>



@endsection