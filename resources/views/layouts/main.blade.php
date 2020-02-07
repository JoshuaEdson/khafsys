<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('public/scripting/css/bootstrap.min.css') }} " rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="{{ asset('public/scripting/css/mdb.min.css') }} " rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="{{ asset('public/scripting/css/style.csss') }} " rel="stylesheet">
</head>

<body>

  <!-- Start your project here-->
  <?php
  //if()  //make user authentications here. At the moment, make a dual main for both login and signup
  ?>
@include('layouts.navbar') <!--same throughout every pages-->

@yield('content')<!--Dynamic-->

<!--until here-->

@include('layouts.footer') <!--same throughout every pages-->




  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="{{ asset('public/scripting/js/jquery-3.4.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('public/scripting/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('public/scripting/js/bootstrap.min.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('public/scripting/js/mdb.min.js') }}"></script>
</body>

</html>
