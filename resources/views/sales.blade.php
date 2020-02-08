@extends('layouts.main')
@section('content')
<?php
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
		margin-bottom: 3%;
	}
	.combobox{
		width: 25%;
		margin-bottom: 3%;
		height: 50%;
	}
</style>

<div class="container-fluid text-left" style="padding-top: 3%; padding-left: 3%; padding-bottom: 10%;">
	<h4>Invoice Number:</h4>
	<p>Auto Set By System</p><br>
	<h4>Staff ID:</h4>
	<select class="combobox" name="staffid" id="staffid" required>
		<option value="" selected>Select</option>
		<?php
		foreach ($staffid as $u) {
			echo "<option value=".$u['abb'].">".$u['name']."</option>";
		}
		?>
	</select><br>
	<h4>Staff Name:</h4>
	<input type="text" style="width: 25%;" placeholder="Auto Generate after picking the staff id">

</div> 



@endsection