@extends('layouts.main')
@section('content')

<?php
$designation = array
(
	array("name"=>"Team Leader", "abb" => "TL"),
	array("name"=>"Sales Online Executive", "abb" => "SOE"),
	array("name"=>"Marketing Executive", "abb" => "ME"),
	array("name"=>"Operation Executive", "abb" => "OE"),
	array("name"=>"Packaging Team", "abb" => "PT")
);

$branch = array
(
	array("name"=>"Kuala Lumpur", "abb" => "KL"),
	array("name"=>"Alor Setar", "abb" => "AS")
);

?>

<title>Khaf Beaute Legacy: My Account</title>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
	h1	{
		padding-top: 2%;
		padding-bottom: 2%;
		font-size: 36px;
		text-align: center;
	}
	h2	{
		padding-top: 5%;
		padding-bottom: 5%;

	}
	img{
		max-width:180px;
	}
	input[type=file]{
		padding:10px;
		/*background:#2d2d2d;*/
	}
	.combobox {
		height: 35px;
		/*padding: 16px 32px;*/
		/*text-decoration: all;*/
		margin: 4px 2px;
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

<h1>My Account</h1>

<div class="row">
	<div class="container-fluid bg-2 text-center" id="who" style="text-align: center;">

		<img id="blah" src="{{ asset('resources/views/pictures/noimgavailable.png') }} " alt="Image" class="img-responsive" style="display: inline">

		<p><input type='file' onchange="readURL(this);" / class="img-responsive" style="display: inline"></p>
	</div>
</div>
<form class="text-left border border-light p-5" action="#!">

	<p class="h4 mb-4">Update Account</p>
	Staff ID
	<input type="text" id="sid" class="form-control" aria-describedby="defaultRegisterFormStaffIdHelpBlock" required><br>
	<div class="form-row mb-4">
		<div class="col">
			<!-- First name -->
			First Name
			<input type="text" id="fname" class="form-control" required>
		</div>
		<div class="col">
			<!-- Last name -->
			Last Name
			<input type="text" id="lname" class="form-control" required>
		</div>
	</div>

	<!-- E-mail -->
	E-Mail
	<input type="email" id="email" class="form-control mb-4" required>

	<!-- Password -->
	Password
	<input type="password" id="pass" class="form-control" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
	<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
		Must contains characters and digits
	</small>

	<!--Staff Age -->
	Age
	<input type="number" id="age" class="form-control" min="18" max="100" step="1" aria-describedby="defaultRegisterFormAgeHelpBlock" required><br>

	<!-- Staff Date Of Birth -->
	Date of Birth
	<input type="date" id="iddob" name="dob" style="width: 100%;" required><br>


	<!-- Staff Gender -->
	<br>Gender:<br>
	<input type="radio" name="sex" id="idsex" value="male" style="width: 3%;" required>Male<br>
	<input type="radio" name="sex" id="idsex" value="female" style="width: 3%;">Female<br>

	<!-- Staff Address -->
	<br>Address
	<input type="text" id="address" class="form-control" aria-describedby="defaultRegisterFormAddressHelpBlock" required><br>

	<!--Private Phone number -->
	Company Phone Number
	<input type="text" id="companyphonenumber" class="form-control" aria-describedby="defaultRegisterFormPhoneHelpBlock" required><br>

	<!--Company Phone number -->
	Personal Phone Number
	<input type="text" id="privatephonenumber" class="form-control" aria-describedby="defaultRegisterFormPhoneHelpBlock" required><br>

	<!-- Staff User Level
		Only Available for Admin -->
		<label for="designation"></label>Designation(*ONLY AVAILABLE FOR ADMIN)
		<select class="combobox" name="designation" id="designation" style="width: 100%;" required>
			<option value="" selected>Select</option>

			<?php
			foreach ($designation as $u) {
				echo "<option value=".$u['abb'].">".$u['name']."</option>";
			}
			?>
		</select><br>

		<!-- Staff Branch -->
		<br><label for="branch"></label>Branch
		<select class="combobox" name="branch" id="branch" style="width: 100%;" required>
			<option value="" selected >Select</option>

			<?php
			foreach ($branch as $u) {
				echo "<option value=".$u['abb'].">".$u['name']."</option>";
			}
			?>
		</select><br>

		<!-- Sign up button -->
		<button class="btn btn-submit my-4 btn-block" type="submit">Submit</button>

		<hr>
	</form>
	<!-- Default form register -->
</div>

@endsection