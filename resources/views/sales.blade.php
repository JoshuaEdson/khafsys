@extends('layouts.main')
@section('content')
<?php
//Example data but soon will be taken straight from the database.
$staffid = array
(
	array("name"=>"K001", "abb" => "K001"),
	array("name"=>"K002", "abb" => "K002"),
	array("name"=>"K003", "abb" => "K003"),
	array("name"=>"K004", "abb" => "K004"),
	array("name"=>"K005", "abb" => "K005")
);

?>
<title>Khaf Beaute Legacy: Sales</title>
<style>
	input{
		margin-bottom: 1%;
	}
	.combobox{
		width: 25%;
		margin-bottom: 1%;
		height: 50%;
	}
	h1{
		font-family: sans-serif;
		font-weight: bold;
		text-align: center;
		padding-top: 1%;
	}
</style>
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#blah')
				.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
<h1>SALES SECTION</h1>
<div class="form-row mb-4">
	<div class="col">
		<table border="1" cellpadding="10">
			<div class="w2-second w2-section" style="margin-left: 3%; padding-top: 3%;">
				
				<h3>INVOICE NUMBER:</h3>
				<p>Auto Set By System</p><br>
				<div class="w3-card-4" id="reportcard">
					<div class="w3-container w3-white" >
						<h4>STAFF ID:<br></h4>
						<select class="combobox" name="staffid" id="staffid" style="width: 70%;" required>
							<option value="" selected>Select</option>
							<?php
							foreach ($staffid as $u) {
								echo "<option value=".$u['abb'].">".$u['name']."</option>";
							}
							?>
						</select><br>
						<h4>STAFF NAME:</h4>
						<input type="text" name="sname" style="width: 70%;">
						<h4>CUSTOMER NAME:<br></h4>
						<input type="text" name="cname" style="width: 70%;">
						<h4>CONTACT NUMBER:<br></h4>
						<input type="text" name="contactnumber" style="width: 70%;">
						<h4>ADDRESS:</h4>
						<input type="text" name="address" style="width: 70%; margin-bottom: 10%;">
					</div>
				</div>
			</div>
		</table>
	</div>
	<div class="col">
		<!-- Reports Costing  -->
		<table border="1" cellpadding="10">
			<div class="w2-second w2-section" style="margin-left: 3%; padding-top: 17%">
				<div class="w3-card-4" id="costcard">
					<div class="w3-container w3-white">
						<h4>ORDER ID:<br></h4>
						<input type="text" id="oid" name="oid" style="width: 70%;">
						<h4>PURCHASE DATE:<br></h4>
						<input type="date" id="purchasedate" name="purchasedate" style="width: 70%;">
						<h4>PRODUCT PURCHASED:<br></h4>
						<input type="text" id="prft" name="prft" style="width: 70%;">
						<h4>REMARKS:<br></h4>
						<input type="text" name="remarks" style="width: 70%;">
						<h4>UPLOAD RESIT<br></h4>
						<p><input type='file' onchange="readURL(this);"></p>
						
					</div>
				</div>
			</div>
		</table>
	</div>
	</div>
</table>
</div>
</div>
<center>
	<!-- Coding part it shows total. Calculation is simple as we fetch the price from the db and just add it all -->
	<h3 style="margin-top: 5%;">TOTAL:</h3><br>
	<h1><?php ?></h1>

	<button name="reset"  type="button" id="button" style="width: 10%; margin-bottom: 3%;">Reset</button>
	<button name="submit"  type="button" id="button" style="width: 10%;">Submit</button>
</center>





@endsection