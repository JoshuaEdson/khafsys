@extends('layouts.temporarymain')
@section('content')

<?php

$usrlvl = array
(
  array("name"=>"Admin", "abb" => "admin"),
  array("name"=>"Supervisor", "abb" => "sv"),
  array("name"=>"Normal User", "abb" => "normal")

);


?>

<style>
    .combobox {
        width: 100%;
        height: 50%;
        padding: 12px 32px;
        text-decoration: none;
        margin: 4px 2px;
    }
    /*input  {
        width: 100%;
        height: 50%;
        padding: 12px 32px;
        text-decoration: none;
        margin: 4px 2px;
    }*/
</style>

<!-- Default form register -->
<form class="text-left border border-light p-5" action="#!">

    <p class="h4 mb-4">Sign up</p>

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

    <!--Staff Age -->
    Age
    <input type="number" id="age" class="form-control" min="18" max="100" step="1" aria-describedby="defaultRegisterFormAgeHelpBlock" required><br>

    <!-- Staff Date Of Birth -->
    Date of Birth
    <input type="date" id="iddob" name="dob" style="width: 100%;"><br>


    <!-- Staff Gender -->
    <br>Gender:<br>
    <input type="radio" name="sex" id="idsex" value="male" style="width: 3%;">Male<br>
    <input type="radio" name="sex" id="idsex" value="female" style="width: 3%;">Female<br>


    <!-- E-mail -->
    <br>E-Mail
    <input type="email" id="email" class="form-control mb-4" required>
</div>

<!-- Password -->
Password
<input type="password" id="pass" class="form-control" aria-describedby="defaultRegisterFormPasswordHelpBlock" required>
<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
    Must contains characters and digits
</small>

<!-- Staff Address -->
Address
<input type="text" id="address" class="form-control" aria-describedby="defaultRegisterFormAddressHelpBlock" required><br>

<!--Private Phone number -->
Company Phone Number
<input type="text" id="companyphonenumber" class="form-control" aria-describedby="defaultRegisterFormPhoneHelpBlock" required><br>

<!--Company Phone number -->
Personal Phone Number
<input type="text" id="privatephonenumber" class="form-control" aria-describedby="defaultRegisterFormPhoneHelpBlock" required><br>

<!-- Staff User Level -->
<label for="usrlvl"></label>User Mode
<select class="combobox" name="usrlvl" id="usrlvl">
  <option value="" selected>Select</option>
 
  <?php
  foreach ($usrlvl as $u) {
   echo "<option value=".$u['abb'].">".$u['name']."</option>";
  }
  ?>
</select><br>


<!-- Sign up button -->
<button class="btn btn-info my-4 btn-block" type="submit">Sign up</button>

<hr>

<!-- Terms of service -->
<center><p>By clicking
    <em>Sign up</em> you agree to our
    <a href="" target="_blank">terms of service</a></p></center>

</form>
<!-- Default form register -->

@endsection