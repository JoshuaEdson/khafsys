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
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<style>
	form{
		/*margin: 0.5%;*/
		padding-bottom: 5%;
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

<div id="response"
class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
<?php if(!empty($message)) { echo $message; } ?>
</div>
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
<div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
	<?php if(!empty($message)) { echo $message; } ?>
</div>
	<script>
		allColumnsname = <?php echo json_encode($allColumnsname ?? '', true) ?>;
		data = <?php echo json_encode($data ?? '' , true) ?>;
		tables = <?php echo json_encode($tables ?? '' , true) ?>;
		tablename = <?php echo json_encode($tablename ?? '' , true) ?>;
		console.log(tables);
	</script>
<form id="dataManagement" action="{{ route('analysis.uploadData', $tablename)}}" name="uploadData" method="post" enctype="multipart/form-data">
	@csrf
	<div class="container-fluid bg-2 text-center border border-light" id="who" style="text-align: left; width: 25%;" >
		
		<div class="input-row">
			<input type="file" name="file" id="file" accept=".csv"><br>
			Dataset Name:  <input type="text" name="datasetName"><br>
			<input class="btn" name="upload" id="submit" type="submit" value="UPLOAD"/>
			<input class="btn" type="reset" onclick="reset();" value="Reset"> 
			<br/>
		</div>
		<!-- </form> -->
	</div>

	<div class="text-left p-3 m-1 border border-light">
		<!-- {{ csrf_token() }} -->

	<p class="h4 mb-4 ">DATA</p>
	<!-- <div style="padding-bottom: 1px;"> -->

		<label for="tableUsed">Datasets:</label>
		<select class="combobox" name="tableList" id="tableUsed" style="width:250px; height: 25px;">
			<option value="No Datasets Selected" selected>Select</option>
			@foreach($tables as $table)
			<option value="{{ $table }}" {{ ( $table == $tablename) ? 'selected' : '' }}> 
			{{ $table }} </option>
			@endforeach
		</select>
		<input class="btn" name="dataTable" id="submit" type="submit" value="Go">
	</form>
	<table id="table" class="table table-striped table-bordered" width="100%">

		{!! $data->links() !!}  
		<thead name="allColumnsname" id="allColumnsname" width="100%">
			<tr> 
				@foreach($allColumnsname ?? '' as $acn)
				<th class="th-sm" value="{{ $acn }} "> {{ $acn }} </th>
				@endforeach
			</tr>
		</thead>
		<tbody name="data" id="data">
			@foreach($data as $data)
			<tr>
				@foreach($allColumnsname ?? '' as $acn)
				<td>{{ $data -> $acn }}</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script> 
	function reset() { 
		document.getElementById("uploadData").reset(); 
	} 
	</script>
	@endsection