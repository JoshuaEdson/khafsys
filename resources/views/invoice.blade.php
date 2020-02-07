@extends('layouts.temporarymain')
@section('content')
<style>
  h5{
    padding-left: 5%;
    font-size: 25px;
    /*padding-right: 5%;*/
  }
</style>
<title>Khaf Beaute Legacy: Invoice</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <div class="row">
      <div class="col-xs-1 text-center">
        <img src=" {{ asset('resources/views/pictures/header.png') }}" width="100%">
      </div>
      <div class="col-9 text-right" style="padding-top: 5%;">

        <h5>Invoice No: </h5>  <!--invoice number -->
        <h5>Issue Date: </h5>
        <h5>Shipping Date: </h5>    
      </div>
      <div class="col-8 text-left" style="padding-top: 5%; margin-left: 7%; padding-bottom: 3%;">
        <h5>Issued To:</h5>
        <h5>Contact Number:</h5>

      </div>
      <!-- </div> -->
      <hr>
      <div class="row" style="margin-left: 12%; margin-right: 12%; font-size: 15px;"> 
        <table class="table table-bordered">
          <tr>
            <th class="text-center" style="font-size: 25px;">ITEM CODE</th>
            <th class="text-center" style="font-size: 25px;">PRICE(RM)/UNIT</th>
            <th class="text-center" style="font-size: 25px;">QUANTITY</th>
            <th class="text-center" style="font-size: 25px;">SUBTOTAL</th>
          </tr>
          <tr>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
            <td class="text-center"></td>
          </tr>
          <tr>
            <td colspan="3" class="text-right" style="font-size: 25px;">GRAND TOTAL</td>
            <td class="text-center"></td>
          </tr>
        </table>

        <div class="row">
          <div class="col-xs-7">
            <div class="span7">
              <div class="panel panel-default">
                <div class="panel-heading"><br>
                  <h4 style="margin-left: 3%;">Contact Details</h4>
                </div>
                <div class="panel-body" style="margin-left: 3%;">
                  <p> Staff: </p>
                  <p> Email: </p>
                  <p> Contact Number: </p>
                  <p><br></p>
                  <p><br></p>
                </div>
              </div>
            </div>
          </div>
        </div>        
</div></div>
        <div style="text-align: center;">
          <p>Computer-generated invoice. No signature is required.
          </p></div>

      @endsection