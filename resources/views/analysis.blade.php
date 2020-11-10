@extends('layouts.main')
@section('content')


<title>IVI IIR 4.0: Analysis Tool</title>
<style>

	.center {
		padding-top: 30%;
		margin-top: 30%;																			
	}
	h3 {
		text-align: left;"
		margin: 20px;
		padding-top: 20px;
		padding-left: 40px;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<style>
	form{
		/*margin: 0.5%;*/
		padding-bottom: 10%;
	}
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


<h1>UPLOAD DATA</h1>

<div class="row">
	<div class="container-fluid bg-2 text-center" id="who" style="text-align: center;">
		<input type="file" id="fileInput" name="file" style="width:317px" />
		<input class="btn" id="ajaxUploadButton" type="submit" value="Upload" />
		<!-- <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script> -->
		<!-- <p><input type='file' onchange="readURL(this);" style="display: inline"></p>  -->
		<!--class="img-responsive" -->
	</div>
</div>
<!-- <script>
	$(document).ready(function () {
		$.noConflict();
		$('#table').DataTable();
	});</script> -->
	<!-- <div class="container"> -->
		<form class="text-left p-3 m-3 border border-light">
			<script>
				allColumnsname = <?php echo json_encode($allColumnsname ?? '', true) ?>;
				data = <?php echo json_encode($data ?? '' , true) ?>;

			</script>
			<p class="h4 mb-4 ">DATA</p>
			<div style="padding-bottom: 20px;">
					<label for="dbUsed">Current Datasets:</label>
					<select class="combobox" name="allColumnsname1" id="dbUsed">
						@foreach($allColumnsname as $acn1)
						<option value="{{ $acn1 }} "> {{ $acn1 }} </option>
						@endforeach
					</select><br>
			</div>
			<table id="table" class="table table-striped table-bordered" width="100%">
				<thead width="100%">
					<tr>
						{!! $data->links() !!}
						@foreach($allColumnsname ?? '' as $acn)
						<th class="th-sm" value="{{ $acn }} "> {{ $acn }} </th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach($data as $data)
					<tr>
						@foreach($allColumnsname ?? '' as $acn)
						<td>{{ $data -> $acn }}</td>
						@endforeach
					</tr>
					@endforeach
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</form>
		<!-- </div> -->
		<!-- Default form register -->

		@endsection