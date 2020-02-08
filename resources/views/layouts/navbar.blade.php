<!--Navbar-->
<style>
  .logoimg {
    width: 8%;
    height: 8%;
    padding-right: 2%;
  }
</style>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<nav class="navbar navbar-expand-lg navbar-dark primary-color" >

  <!-- Navbar Picture -->
   <img src="{{ asset('resources/views/pictures/logo.png') }}" class="logoimg" href="#">

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topNavBar"
    aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="topNavBar">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/khafbeautelegacy/khafsys/admin_dashboard">DASHBOARD
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/khafbeautelegacy/khafsys/acct_dept">ACCOUNTING</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">SALES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">LEADS</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="/khafbeautelegacy/khafsys/myaccount">MY ACCOUNT</a>
      </li>

      <!-- Dropdown -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>-->
 
    </ul>
    <!-- Links -->

<!--     <form class="form-inline">
      <div class="md-form my-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      </div>
    </form> -->
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->