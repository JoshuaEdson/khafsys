@extends('layouts.temporarymain')
@section('content')

<style>
	h1	
	{
		text-align: center;
		font-size: 35px;
		padding-top: 3%;
	}
	
</style>

<title>Khaf Beauty Legacy: Sign In</title>
<!-- Material form login -->

<center><div class="w3-container" style="width: 50%; height: 100%;">
<div>
	<br>
	<h1><strong>Sign in</strong></h1>

	<!--Card content-->
	<div div class="w3-card-4 w3-grey" style="width:50%">
		<br>
		<!-- Form -->
		<form class="text-center" style="color: #757575;" action="#!">

			<!-- Email -->
			<div class="md-form">
				<input type="email" id="materialLoginFormEmail" class="form-control">
				<label for="materialLoginFormEmail">E-mail</label>
			</div>

			<!-- Password -->
			<div class="md-form">
				<input type="password" id="materialLoginFormPassword" class="form-control">
				<label for="materialLoginFormPassword">Password</label>
			</div>
			<div class="d-flex justify-content-around">
					<!-- Remember me -->
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
						<label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
					</div>
				<div>
					<!-- Forgot password -->
					<a href="">Forgot password?</a>
				</div>
			</div>
			<br>
			<!-- Sign in button -->
			<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>
			<br><br>
			<!-- Register -->
			<p>Not a member?
				<a href="/khafbeautelegacy/khafsys/signup">Register</a>
			</p>
			<br>
		</form>
		<!-- Form -->
	</div>
</div>
<br>
</div></center>
<!-- Material form login -->
@endsection