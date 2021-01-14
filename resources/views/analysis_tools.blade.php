@extends('layouts.main')
@section('content')


<title>IVI IIR 4.0: Analysis Tool</title>
<style>
	canvas {
		text-align: center;
		max-height: 500px;
		position: relative;
	}
	.center {
		padding-top: 30%;
		margin-top: 30%;																			
	}
	h1 {
		text-align: center;"
		margin: 20px;
		padding-top: 20px;
		padding-left: 40px;
	}

	input[type="checkbox"] {
		/*height: */
		/*width: 100%;*/
		padding: 12px 20px;
		margin: 10px 10px 0px 0px;
		box-sizing: border-box;
		font: 100% Lucida Sans, Verdana;
	}
	select{
		padding: 3px 7%;
		margin: 10px 20px 10px 10px;
	}
	label{
		font-weight: bold;
	}
	h3 {
		font-weight: bold;
		font: Lucida Sans, Verdana;
		/*text-decoration: underline;*/
	}
	h5 {
		font: Lucida Sans, Verdana;
	}
	li {
		font: Lucida Sans, Verdana;
	}

</style>

<!-- Header for the dashboard. -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- Add jQuery lib here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<div>
	<h1 style="font-weight: bold;">GRAPH ANALYSIS</h1>
</div>
<form id="toolForm" action="{{ route('analysis.postData', $tablename)}}" method="post" >
	@csrf
	<div  style=" padding-left: 2%;">
		<label for="tableUsed">Datasets:</label>
		<select class="combobox col-sm-2" name="tableList" id="tableUsed" style="width:250px; height: 35px; ">
			<option value="No Datasets Selected" selected>Select</option>
			@foreach($tables as $table)
			<option value="{{ $table }}" {{ ( $table == $tablename) ? 'selected' : '' }}> 
			{{ $table }} </option>
			@endforeach
		</select>
		<input class="btn" name="dataTable" id="submit" type="submit" value="Go">
	</div>
	<div class="col-sm-12" style="margin-bottom: 10%; height:*;">
		<div class="row" style="padding: 10px;">
			<div class="col-sm-12">
				<div class="container col-sm-4" style="float: left;">
					<label>Graph Types:</label><br>
					<span class="form-check">
						<div class="checkboxContainer row" id="checkboxId">
							<div class="col-xs-12 col-sm-12 col-md-6">
								<input type="checkbox" name="LineGraph" id="LineGraph" value="line" <?php if(isset($_POST['LineGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Line Graph<br>
								<input type="checkbox" name="BarGraph" id="BarGraph" value="bar" <?php if(isset($_POST['BarGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Bar Graph<br>
								<input type="checkbox" name="RadarGraph" id="RadarGraph" value="radar" <?php if(isset($_POST['RadarGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Radar Graph<br>
								<input type="checkbox" name="DoughnutGraph" id="DoughnutGraph" value="doughnut" <?php if(isset($_POST['DoughnutGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Doughnut Graph
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<input type="checkbox" name="PieGraph" id="PieGraph" value="pie" <?php if(isset($_POST['PieGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Pie Graph<br>
								<input type="checkbox" name="PolarAreaGraph" id="PolarAreaGraph" value="polarArea" <?php if(isset($_POST['PolarAreaGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Polar Area Graph<br>
								<input type="checkbox" name="BubbleGraph" id="BubbleGraph" value="bubble" <?php if(isset($_POST['BubbleGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Bubble Graph<br>
								<input type="checkbox" name="ScatterGraph" id="ScatterGraph" value="scatter" <?php if(isset($_POST['ScatterGraph'])) echo "checked='checked'"; ?> onclick=" ValidateGraphSelected();">Scatter Graph
							</div>
							<script>
								function ValidateGraphSelected()  
								{  
									var checkboxes = document.forms[0];
									var numberOfCheckedItems = 0;  
									for(var i = 0; i < checkboxes.length; i++)  
									{  
										if(checkboxes[i].checked)  {
											numberOfCheckedItems++;  
										}
									}  
									if(numberOfCheckedItems > 1)  
									{  
										alert("Maximum 1 Graph Only Supported!");  
										$('input:checkbox').prop('checked', false);
										return false;  
									} 
								}
							</script>
						</div>
					</span>
					<div style="padding-top: 20px;">
						<center>
							<label for="datasets">Data 1:</label>
							<select class="combobox" name="allColumnsname1" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn1)
								<option value="{{ $acn1 }}" {{ ( $acn1 == $var1) ? 'selected' : '' }}> 
								{{ $acn1 }} </option>
								@endforeach
							</select><br>
							<label for="datasets2">Data 2:</label>
							<select class="combobox" name="allColumnsname2" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn2)
								<option value="{{ $acn2 }}" {{ ( $acn2 == $var2) ? 'selected' : '' }}> 
								{{ $acn2 }} </option>
								@endforeach
							</select><br>
							<label for="datasets3">Data 3:</label>
							<select class="combobox" name="allColumnsname3" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn3)
								<option value="{{ $acn3 }}" {{ ( $acn3 == $var3) ? 'selected' : '' }}> 
								{{ $acn3 }} </option>
								@endforeach
							</select><br>
						</center>
						<center>
							<div style="padding-top: 5%;">

								<input class="btn" id="submitbtn" type="submit" name="submit" onsubmit="return validateMyForm()">
								<!-- <input class="btn" id="resetbtn" type="reset" name="reset" value="Reset">  -->
								<script>
									$(function () {
										$("#resetbtn").on("click", function () {
											alert("Reset");
											document.getElementById("toolForm").onreset;
										});
									});
								</script>
								<script>
									$(function () {
										$("#submitbtn").on("click", function () {
											const DDBox1 = document.getElementsByName("allColumnsname1")[0].value;
											const DDBox2 = document.getElementsByName("allColumnsname2")[0].value;
											const DDBox3 = document.getElementsByName("allColumnsname3")[0].value;
											var line = document.getElementById("LineGraph");
											var bar = document.getElementById("BarGraph");
											var radar = document.getElementById("RadarGraph");
											var doughnut = document.getElementById("DoughnutGraph");
											var pie = document.getElementById("PieGraph");
											var polarArea = document.getElementById("PolarAreaGraph");
											var bubble = document.getElementById("BubbleGraph");
											var scatter = document.getElementById("ScatterGraph");

											if (DDBox1 == ""){
												alert("Please Pick Data at Data 1 First!");
												return false;
											} else if(DDBox1 != "" && DDBox2 == "" && DDBox3 != ""){
												alert("Please Pick Data at Data 2 First!");
												return false;
											} else if(DDBox1 != "" && DDBox2 != "" && DDBox3 != ""){
												if(bubble.checked){
												// alert("line");
												return true;
											} else {
												alert("ONLY BUBBLE GRAPH SUPPORTS 3 DATA!");
												return false;
											}
										}
									});
									});
								</script>
							</div>
						</center>
					</div>
				</div>
				<?php
				if($Data3Setlabela == ""){
					?>
					<div class="container col-sm-8 p-1 my-1 border" style="float: right; height:100%;">
						<canvas id="myChart" style="width:*;  height:*"></canvas></div>
					<?php } else { ?>
						@foreach($Data1SetlabelX as $d => $valD)
						<div class="container col-sm-8 p-1 my-1 border" style="float: right;">
							<canvas id="myChart{{$d}}" style="width:*;  height:*;"></canvas></div>
							@endforeach
						<?php } ?>	
					</div>
				</div>
			</div>	
		</form>
	</div>
</div>
</div>
<div class="col-sm-12 my-3">
	<h3 style="font-weight: bold; ">DATA TABLE :</h3>
	<div class="col-sm-12 border">
		<?php
		if($Data3Setlabela == ""){
			?>
			<table id="table" class="table table-striped table-bordered" width="100%">
				<?php
				if ($Data2SetlabelX == null) {?>
					<thead>
						<tr> 
							<th></th>
							<?php foreach ($Data1SetlabelX as $key) {?>
								<th class="th-sm" value="{{ $key }} "> {{ $key }} </th>
							<?php }
						} else if ($Data2SetlabelX != null) { ?>
							<th></th>
							@foreach($Data2SetlabelX ?? '' as $acn)
							<th class="th-sm" value="{{ $acn }} "> {{ $acn }} </th>
							@endforeach
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					if ($rData1Chunked == null){?>
						<td style="font-weight: bold;">Respondents</td>
						@foreach($Data1SetlabelY as $index => $data)
						<td scope="row">{{$data}}({{number_format((($data * 100) / $totalData),2)}} %)</td>
						@endforeach
					<?php } 
					else if($rData1Chunked != null){?>
						@foreach($rData1Chunked as $index => $data)
						<tr>
							<td scope="row" style="font-weight: bold;">{{$Data1SetlabelX[$index]}}</td>
							@foreach($Data2SetlabelX ?? '' as $acn => $val)
							<td >{{ $data[$acn] }}({{number_format((($data[$acn] * 100) / $totalData),2)}} %)</td>
							@endforeach
						</tr>
						@endforeach
					<?php } ?>		
				</tbody>
			</table>
			<?php 
		} else if($Data3Setlabela != ""){?>
			@foreach($Data1SetlabelX as $j => $data1)
			@foreach($rData2Chunked as $r => $rdata)
			<h5 style="padding-top: 2%;"><strong>{{$Data1SetlabelX[$r]}}</strong></h5>
			<table id="table" class="table table-striped table-bordered" width="100%">
				<thead>
					<tr> 
						<th></th>
						@foreach($Data3SetlabelX ?? '' as $acn)
						<th class="th-sm" value="{{ $acn }} "> {{ $acn }} </th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					<?php $t = $totalData3; ?>
					@foreach($rData2Chunked as $index => $data3)
					@foreach($data3 as $indData => $allData3)
					@foreach($Data2SetlabelX as $d => $d3)
					<tr>
						<td scope="row" style="font-weight: bold;">{{$d3}}</td>
						@foreach($Data3SetlabelX ?? '' as $acn => $val)
						<?php if($d == 0) { ?>
							<td >{{ $rdata[$acn] }}({{number_format((($rdata[$acn] * 100) / $totalData),2)}} %)</td>
						<?php } else { 
							?>
							<td >{{ $rdata[$t] }}({{number_format((($rdata[$t] * 100) / $totalData),2)}} %)</td>
							<?php $t++;
						} ?>
						@endforeach
					</tr>
					@endforeach
					<?php break; ?>
					@endforeach
					<?php break; ?>
					@endforeach
				</tbody>
			</table>
			@endforeach
			<?php break; ?>
			@endforeach
		<?php } ?>
	</div>

</div>
<div class="col-sm-12 my-3">
	<div class="col-sm-12 m-1" style="padding-top: 3%; padding-bottom: 10%; float: left;">
		<h3 style="text-decoration: underline;">WELCOME TO GRAPH ANALYSIS</h3>
		<h6>THIS TOOLS CONTAINS SOME RESTRICTION ON DATA VISUALIZATION. BELOW ARE THE GUIDELINES:</h5>
			<ol>
				<li>THIS TOOLS ONLY SUPPORTS ONE TYPE OF GRAPH TO VISUALIZE DATA.</li>
				<li>IN THIS GRAPH ANALYSIS TOOLS, KINDLY CONSIDER THE FORMAT BELOW:</li>
			</ol>
			<div class="container col-sm-2 p-1 my-1" style="float: left; margin: 1%;">					
				<ul>
					<li>GRAPHS THAT SUPPORTS 1 DATA:</li>
					<ol>
						<li>LINE GRAPH</li>
						<li>BAR GRAPH</li>
						<li>RADAR GRAPH</li>
						<li>DOUGHNUT GRAPH</li>
						<li>PIE GRAPH</li>
						<li>POLAR AREA GRAPH</li>
						<li>SCATTER GRAPH</li>
					</ol>
				</ul>
			</div>
			<div class="container col-sm-2 p-1 my-1" style="float: left;margin: 1%;">				
				<ul>
					<li>GRAPHS THAT SUPPORTS 2 DATA:</li>
					<ol>
						<li>LINE GRAPH</li>
						<li>BAR GRAPH</li>
						<li>DOUGHNUT GRAPH</li>
						<li>PIE GRAPH</li>
						<li>BUBBLE GRAPH</li>
						<li>SCATTER GRAPH</li>
					</ol>
				</ul>
			</div>
			<div class="container col-sm-2 p-1 my-1" style="float: left;margin: 1%;">				
				<ul>
					<li>GRAPHS THAT SUPPORTS 3 DATA:</li>
					<ol>
						<li>BUBBLE GRAPH</li>
					</ol>
				</ul>
			</div>
			<div class="container col-sm-4 my-1" style="float: left;margin: 1%;">		
				<ul>
					<li>DATA LABEL AXIS FORMATTING SHOULD BE AS FOLLOW TO MATCH THE AXIS ON THE GRAPHS:</li>
					<ol>
						<li>DATA 1 IS CONSIDERED AS DATA</li>
						<li>DATA 2 IS CONSIDERED AS X-AXIS</li>
						<li>DATA 3 IS CONSIDERED AS Y-AXIS (RIGHT)</li>
					</ol>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	//Function to Retrieve Data 

	
	console.log({{$totalData}});

	var obj1 = <?php echo json_encode($Data1SetlabelY ?? '', true) ?>;
	var obj2 = <?php echo json_encode($Data1SetlabelX ?? '', true) ?>;
	var obj3 = <?php echo json_encode($Data2SetlabelY ?? '', true) ?>;
	var obj4 = <?php echo json_encode($Data2SetlabelX ?? '', true) ?>;
	var obj5 = <?php echo json_encode($Data3SetlabelY ?? '', true) ?>;
	var obj6 = <?php echo json_encode($Data3SetlabelX ?? '', true) ?>;
	var obj7 = <?php echo json_encode($Data4SetlabelY ?? '', true) ?>;
	var obj8 = <?php echo json_encode($Data4SetlabelX ?? '', true) ?>;


	var var1 = <?php echo json_encode($var1 ?? '', true) ?>;
	var var2 = <?php echo json_encode($var2 ?? '', true) ?>;
	var var3 = <?php echo json_encode($var3 ?? '', true) ?>;

	//testing
	var Data_1 = <?php echo json_encode($Data_1 ?? '', true) ?>;
	var Data_2 = <?php echo json_encode($Data_2 ?? '', true) ?>;
	var Data_3 = <?php echo json_encode($Data_3 ?? '', true) ?>;



	const graphType1 = <?php echo json_encode($checkboxLine1 ?? '', true) ?>;
	const graphType2 = <?php echo json_encode($checkboxLine2 ?? '', true) ?>;
	const graphType3 = <?php echo json_encode($checkboxLine3 ?? '', true) ?>;
	const graphType4 = <?php echo json_encode($checkboxLine4 ?? '', true) ?>;
	const graphType5 = <?php echo json_encode($checkboxLine5 ?? '', true) ?>;
	const graphType6 = <?php echo json_encode($checkboxLine6 ?? '', true) ?>;
	const graphType7 = <?php echo json_encode($checkboxLine7 ?? '', true) ?>;
	const graphType8 = <?php echo json_encode($checkboxLine8 ?? '', true) ?>;

	const xData1 = <?php echo json_encode($xData1 ?? '', true) ?>;
	const yData1 = <?php echo json_encode($yData1 ?? '', true) ?>;
	const XYData1 = <?php echo json_encode($XYData1 ?? '', true) ?>;
	var rData1 = <?php echo json_encode($rData1 ?? '', true) ?>;
	const XYData1Chunked = <?php echo json_encode($XYData1Chunked ?? '', true) ?>;
	var rData1Chunked = <?php echo json_encode($rData1Chunked ?? '', true) ?>;

	const xData2 = <?php echo json_encode($xData2 ?? '', true) ?>;
	const yData2 = <?php echo json_encode($yData2 ?? '', true) ?>;
	const yData3 = <?php echo json_encode($yData3 ?? '', true) ?>;
	const XYData2 = <?php echo json_encode($XYData2 ?? '', true) ?>;
	const rData2 = <?php echo json_encode($rData2 ?? '', true) ?>;
	const XYData2Chunked = <?php echo json_encode($XYData2Chunked ?? '', true) ?>;
	var rData2Chunked = <?php echo json_encode($rData2Chunked ?? '', true) ?>;

	// var checkBox = document.getElementById("checkboxID").value;

	if (graphType1 == 'line')
	{
		const ctx = document.getElementById('myChart').getContext('2d');
		var coloR = [];
		var dynamicColors = function() {
			var r = Math.floor(Math.random() * 255);
			var g = Math.floor(Math.random() * 255);
			var b = Math.floor(Math.random() * 255);
			return "rgb(" + r + "," + g + "," + b + ")";
		};
		for (var i in rData1) {
			coloR.push(dynamicColors());
		}
		xCategoryVal = obj2;
		yCategoryVal = obj4;
		y2CategoryVal = obj6;
		var data = [];
		var xAxes = [];
		var yAxes = [];
		var title = [];
		var label = [];
		var labels = [];
		var datas = [];
		if(yCategoryVal == "" && y2CategoryVal =="")  
		{	
			datas = xData1.map((x, i) => {
				return {
					x: x,
					y: yData1[i],
					label: XYData1[i]
				};
			});
			console.log(datas);
						//Axes
						xAxes = [{
							ticks: {
								autoSkip: false,
							},
							display: true,
							type:'category',
							// position: 'bottom',
							labels: xCategoryVal,
							scaleLabel: {
								display: true,
								labelString: var1
							},
							gridLines: {
								display:true,
							}
						}]
						yAxes= [{
							ticks: {
								autoSkip: false,
							},
							scaleLabel: {
								display: true,
								labelString: 'Respondents'
							},
							gridLines: {
								display:true,
							}
						}]
						data = {
							datasets: [{
								label:  var1 + ' Data',
								data: datas,
								backgroundColor: coloR,
								borderColor: coloR,
								fill: false,
							}]
						}

						datalabels= {
							formatter: function(value, context) {
								return (((value.y *100) / {{$totalData}}).toFixed(2)) + "%";
							},
							anchor: 'end',
							align: 'end',
							offset: 0.01
						}

						labels = 'LINE GRAPH FOR ' + var1.toUpperCase();
						label= function (tooltipItems, data) {
							const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label;
							const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].y;
							var percentRes = ((dataVal * 100) / {{$totalData}});
							percentRes = percentRes.toFixed(2);
							return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
						}
						title= function(tooltipItem, data){
							return "Impacts To " + var1;
						}
					} else if(yCategoryVal != "" && y2CategoryVal =="")  
					{
						var data = {
							labels: <?php echo json_encode($Data2SetlabelX ?? '', true) ?>,
							datasets: [
							<?php foreach ($Data1SetlabelX as $allDataIndex => $allDataValue): ?>{
								label: "{{$allDataValue}}",
								data: rData1Chunked[{{$allDataIndex}}],
								backgroundColor: coloR[{{$allDataIndex}}],
								borderColor: coloR[{{$allDataIndex}}],
								fill: false,
						      // notice the gap in the data and the spanGaps: true
						      
						  },<?php endforeach ?>
						  ]
						};
						// console.log(rData1[0]);
						xAxes= [{
							scaleLabel: {
								display: true,
								labelString: var2
							},
							ticks: {
								autoSkip: false,
							},
							offset: 150,
							gridLines: {
								display:true,
							},
							display: true,
							type:'category',
							labels: yCategoryVal,
						}]
						yAxes= [{
							scaleLabel: {
								display: true,
								labelString: "Respondents"
							},
							ticks: {
								autoSkip: false,
							},
							gridLines: {
								display:true,
							},
							offset: 150,
							display: true,
								// type:'category',
								// labels: yCategoryVal,
							}]

							labels = 'RELATIONSHIP BETWEEN ' + var1.toUpperCase() + ' AND ' + var2.toUpperCase();

							label= function (tooltipItems, data) {
								const labels = data.datasets[tooltipItems.datasetIndex].label;
								const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index];
								var percentRes = ((dataVal * 100) / {{$totalData}});
								percentRes = percentRes.toFixed(2);
								return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
							}

							title= function(tooltipItem, data){
								return "Impacts To " + var1 +" and " + var2;
							}

							datalabels= {
								formatter: function(value, context) {
									return (((value *100) / {{$totalData}}).toFixed(2)) + "%";
								},
								anchor: 'end',
								align: 'end',
								offset: 0.01
							}
						} 
						else if(yCategoryVal != "" && y2CategoryVal !="")  
						{
							document.getElementsByName("allColumnsname1").selectedIndex = 0;
							document.getElementsByName("allColumnsname2").selectedIndex = 0;
							document.getElementsByName("allColumnsname3").selectedIndex = 0;
							document.getElementsByName("allColumnsname4").selectedIndex = 0;
							alert("Line Graph only supports up to 2 Data!");
							myChart.destroy();
							// dataTemp1 = xData1.map((x, i) => {
							// 	return {
							// 		x: x,
							// 		y: yData1[i],
							// 		r: rData1[i],
							// 		labels: XYData1[i],
							// 	};
							// });
							// dataTemp2 = xData2.map((x, j) => {
							// 	return {
							// 		x: x,
							// 		y: yData2[j],
							// 		r: rData2[j],
							// 		labels: XYData2[j],
							// 	}
							// });
							// data = {
							// 	datasets: [{
							// 		label: 'Relationship Between ' + var1 + ' and ' + var2,
							// 		data: dataTemp1,
							// 		backgroundColor: 'rgb(139,0,0)' ,
							// 		borderColor: 'rgb(139,0,0)' ,
							// 		fill: false,
							// 		yAxisID: 'A'
							// 	},{
							// 		label: 'Relationship Between ' + var1 + ' and ' + var3,
							// 		data: dataTemp2,
							// 		backgroundColor: 'rgb(0,0,255)',
							// 		borderColor: 'rgb(0,0,255',
							// 		fill: false,
							// 		yAxisID: 'B'
							// 	}]
							// }
							// xAxes= [{
							// 	scaleLabel: {
							// 		display: true,
							// 		labelString: var1
							// 	},
							// 	ticks: {
							// 		autoSkip: false,
							// 	},
							// 	offset: 150,
							// 	gridLines: {
							// 		display:true,
							// 	},
							// 	display: true,
							// 	type:'category',
							// 	labels: xCategoryVal,
							// 	position: 'bottom',
							// }];
							// yAxes= [{
							// 	id: 'A',
							// 	scaleLabel: {
							// 		display: true,
							// 		labelString: var2
							// 	},
							// 	ticks: {
							// 		autoSkip: false,
							// 	},
							// 	gridLines: {
							// 		display:true,
							// 	},
							// 	offset: 150,
							// 	display: true,
							// 	type:'category',
							// 	labels: yCategoryVal,
							// 	position: 'left'							
							// },{
							// 	id: 'B',
							// 	scaleLabel: {
							// 		display: true,
							// 		labelString: var3
							// 	},
							// 	ticks: {
							// 		autoSkip: false,
							// 	},
							// 	gridLines: {
							// 		display:true,
							// 	},
							// 	offset: 150,
							// 	display: true,
							// 	type:'category',
							// 	labels: y2CategoryVal,
							// 	position: 'right'							
							// }]
							// labels = 'Relationship Between ' + var1 + ', ' + var2 + ' and ' + var3;
							// label= function (tooltipItems, data) {
							// 	const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].labels;
							// 	const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].r;
							// 	var percentRes = ((dataVal * 100) / {{$totalData}});
							// 	percentRes = percentRes.toFixed(2);
							// 	return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
							// }
							// title= function(tooltipItem, data){
							// 	return "Impacts To " + var1 +" and " + var2;
							// }
						}
						console.log(labels);
						var myChart = new Chart(ctx, {
							type: graphType1,
							data: data, 
							options:{
								plugins: {
									datalabels: datalabels
								},
								title: {
									display: true,
									text: labels
								},
								responsive: true,
								scales: {
									xAxes: xAxes, 
									yAxes: yAxes
								},
								tooltips: {
									callbacks: {
										label: label,
										title: title
									}
								}
							}
						});
					}

					if (graphType2 == 'bar'){
						const ctx = document.getElementById('myChart').getContext('2d');
						var coloR = [];

						var dynamicColors = function() {
							var r = Math.floor(Math.random() * 255);
							var g = Math.floor(Math.random() * 255);
							var b = Math.floor(Math.random() * 255);
							return "rgb(" + r + "," + g + "," + b + ")";
						};

						for (var i in obj2) {
							coloR.push(dynamicColors());
						}

						xCategoryVal = obj2;
						yCategoryVal = obj4;
						y2CategoryVal = obj6;
						xAxes = [];
						yAxes =[];
						labels = [];
						label = [];
						title = [];
						datas = [];

						if(yCategoryVal == "" && y2CategoryVal =="")  
						{	
							datas= {
								datasets: [{
									labels: xCategoryVal,
									label: var1,
									data: obj1,
									backgroundColor: 'rgb(0,35,102)',
									borderColor: 'rgb(0,35,102)',
									fill: false,
								}]
							}

							label = 'Bar Graph For ' + var1;
						//Axes
						xAxes = [{
							// for(i = 0; i < )
							ticks: {
								autoSkip: false,
							},
							display: true,
							type:'category',
							position: 'bottom',
							id:'x-prime',
							labels: obj2,
							scaleLabel: {
								display: true,
								labelString: var1
							}
						}]

						yAxes= [{
							scaleLabel: {
								display: true,
								labelString: 'Respondents'
							}
						}]

						labels = function (tooltipItems, data) {
							var i, label = [], l = data.datasets.length;
							for (i = 0; i < l; i++) {
								IndivData =  data.datasets[i].labels[tooltipItems.index];
								IndivDataNum = data.datasets[i].data[tooltipItems.index];
								DataPercent = (IndivDataNum * 100) / {{$totalData}};
								DataPercent = DataPercent.toFixed(2);
								label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";
							}
							return label;
						}

						title = function(tooltipItem, data){
							dataTitle = document.getElementById("")
							return "Impacts To " + var1;
						}

						datalabels= {
							formatter: function(value, context) {
								return (((value *100) / {{$totalData}}).toFixed(2)) + "%";
							},
							anchor: 'end',
							align: 'end',
							offset: 0.01
						}

					} if(yCategoryVal != "" && y2CategoryVal =="")  
					{		
						var datas = {
							labels: <?php echo json_encode($Data2SetlabelX ?? '', true) ?>,
							datasets: [
							<?php foreach ($Data1SetlabelX as $allDataIndex => $allDataValue): ?>{
								label: "{{$allDataValue}}",
								data: rData1Chunked[{{$allDataIndex}}],
								backgroundColor: coloR[{{$allDataIndex}}],
								borderColor: coloR[{{$allDataIndex}}],
								fill: false,
						      // notice the gap in the data and the spanGaps: true
						      
						  },<?php endforeach ?>
						  ]
						};
					//Axes
					xAxes = [{
						ticks: {
							autoSkip: false,
						},
						display: true,
						type:'category',
						position: 'bottom',
						labels: yCategoryVal,
						scaleLabel: {
							display: true,
							labelString: var2
						}
					}]

					yAxes= [{
						scaleLabel: {
							display: true,
							labelString: 'Respondents'
						}
					}]

					label = 'Relationship Between ' + var1 + ' and ' + var2;

					labels= function (tooltipItems, data) {
						const labels = data.datasets[tooltipItems.datasetIndex].label;
						const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index];
						var percentRes = ((dataVal * 100) / {{$totalData}});
						percentRes = percentRes.toFixed(2);
						return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
					}

					title = function(tooltipItem, data){
						return "Impacts To " + var1 +" and " + var2;
					}
					datalabels= {
						formatter: function(value, context) {
							return (((value *100) / {{$totalData}}).toFixed(2)) + "%";
						},
						anchor: 'end',
						align: 'end',
						offset: 0.01
					}
				} 
				else if(yCategoryVal != "" && y2CategoryVal !="")  
				{		
					datas= {
						datasets: [{
							labels: obj2,
							label: var1,
							data: obj1,
							backgroundColor: 'rgb(0,35,102)',
							borderColor: 'rgb(0,35,102)',
							borderWidth: 3,
							fill: false,
						},
						{
							labels: obj4,
							label: var2,
							data: obj3,
							backgroundColor: 'rgb(227,38,54)',
							borderColor: 'rgb(227,38,54)',
							borderWidth: 3,
							fill: false,
						},{
							labels: obj6,
							label: var3,
							data: obj5,
							backgroundColor: 'rgb(0,128,0)',
							borderColor: 'rgb(0,128,0)',
							borderWidth: 3,
							fill: false,
						}],
					}
					//Axes
					xAxes = [{
						ticks: {
							autoSkip: false,
						},
						display: true,
						type:'category',
						position: 'bottom',
						labels: xCategoryVal,
						scaleLabel: {
							display: true,
							labelString: var1 + ' and ' + var2
						}
					}]

					yAxes= [{
						scaleLabel: {
							display: true,
							labelString: 'Respondents'
						}
					}]

					label = 'Relationship Between ' + var1 + ' and ' + var2 + ' and ' + var3;

					labels = function (tooltipItems, data) {
						var i, label = [], l = data.datasets.length;
						for (i = 0; i < l; i++) {
							IndivData = data.datasets[i].data[tooltipItems.index];
							IndivData1 = (IndivData * 100) / {{$totalData}};
							IndivData1 = IndivData1.toFixed(2);
							label[i] = data.datasets[i].label + ": " + data.datasets[i].labels[tooltipItems.index] + ' : ' + IndivData1 + '% ; Total Respondents = ' + IndivData;
						}
						return label;
					}

					title = function(tooltipItem, data){
						return "Impacts To " + var1 +" and " + var2;
					}
				} 

				var barChart = new Chart(ctx, {
					type: graphType2,
                    // The data for our dataset
                    data: datas,
                    options: {
                    	plugins: {
                    		datalabels: datalabels

                    	},
                    	title: {
                    		display: true,
                    		text: label
                    	},
                    	scales: {
                    		xAxes: xAxes, 
                    		yAxes:yAxes
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: labels,
                    			title: title
                    		}
                    	}
                    }
                });
			} 

			if (graphType3 == 'radar'){
				const ctx = document.getElementById('myChart').getContext('2d');
				var coloR = [];

				var dynamicColors = function() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					return "rgb(" + r + "," + g + "," + b + "," + 0.4 +")";
				};

				for (var i in obj2) {
					coloR.push(dynamicColors());
				}

				xCategoryVal = obj2;
				yCategoryVal = obj4;
				xAxes = [];
				yAxes =[];
				labels = [];
				title = [];
				datas = [];
				console.log(obj1,obj2,obj3,obj4)

				if(yCategoryVal != "")
				{	
					document.getElementsByName("allColumnsname1").selectedIndex = 0;
					document.getElementsByName("allColumnsname2").selectedIndex = 0;
					document.getElementsByName("allColumnsname3").selectedIndex = 0;
					document.getElementsByName("allColumnsname4").selectedIndex = 0;
					alert("Radar Graph only supports 1 Data at a time!");
					radarChart.destroy();
				} 

				else if(yCategoryVal == "")
				{	
					datas= {
						labels: obj2,
						datasets: [{
							label: 'RADAR GRAPH FOR ' + var1.toUpperCase(), 
                    		// fill: true,
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}],
                    }

                    labels= function (tooltipItems, data) {
                    	var i, label = [], l = data.datasets.length;
                    	for (i = 0; i < l; i++) {
                    		IndivData =  data.datasets[i].labels[tooltipItems.index];
                    		IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    		DataPercent = (IndivDataNum * 100) / {{$totalData}};
                    		DataPercent = DataPercent.toFixed(2);
                    		label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";
                    	}
                    	return label;
                    }

                    title= function(tooltipItem, data){
                    	return "Impacts To " + var1;
                    }
                }

                var radarChart = new Chart(ctx, {
                	type: graphType3,
                    // The data for our dataset
                    data: datas,
                    options: {
                    	plugins: {
                    		datalabels: {
                    			anchor: 'end',
                    			align: 'end',
                    			offset: 0.01
                    		}
                    	},
                    	scale: {
                    		angleLines: {
                    			display: false
                    		}
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: labels,
                    			title: title
                    		}
                    	}
                    }
                });
            }

            if (graphType4 == 'doughnut'){
            	const ctx = document.getElementById('myChart').getContext('2d');
            	var coloR = [];

            	var dynamicColors = function() {
            		var r = Math.floor(Math.random() * 255);
            		var g = Math.floor(Math.random() * 255);
            		var b = Math.floor(Math.random() * 255);
            		return "rgb(" + r + "," + g + "," + b +","+ 0.8 +")";
            	};

            	for (var i in obj2) {
            		coloR.push(dynamicColors());
            	}

            	xCategoryVal = obj2;
            	yCategoryVal = obj4;
            	xAxes = [];
            	yAxes =[];
            	labels = [];
            	title = [];
            	datas = [];

            	if(yCategoryVal != "")
            	{	

            		var datas = {
            			labels: <?php echo json_encode($Data2SetlabelX ?? '', true) ?>,
            			datasets: [
            			<?php foreach ($Data1SetlabelX as $allDataIndex => $allDataValue): ?>{

            				label: "{{$allDataValue}}",
            				data: rData1Chunked[{{$allDataIndex}}],
            				backgroundColor: coloR,
            				borderColor: coloR,
								// fill: false,
						      // notice the gap in the data and the spanGaps: true
						  },<?php endforeach ?>
						  ]
						};

						labels= function (tooltipItems, data) {
							const labels = data.datasets[tooltipItems.datasetIndex].label;
							const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index];
							var percentRes = ((dataVal * 100) / {{$totalData}});
							percentRes = percentRes.toFixed(2);
							return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
						}

						title = function(tooltipItem, data){
							return "Impacts To " + var1 +" and " + var2;
						}
					} 
					else if(yCategoryVal == "")
					{	
						datas= {
							labels: obj2,
							datasets: [{
								labels: obj2,
								label: var1,
								data: obj1,
								backgroundColor: coloR,
								borderColor: coloR,
								fill: false,
							}]
						}

						//Axes
						xAxes = [{
							ticks: {
								autoSkip: false,
							},
							display: true,
							type:'category',
							position: 'bottom',
							id:'x-prime',
							labels: obj2,
							scaleLabel: {
								display: true,
								labelString: var1
							}
						}]

						yAxes= [{
							ticks: {
								max: 1200,
								min: 0,
								stepSize: 100,
							},
							scaleLabel: {
								display: true,
								labelString: 'Respondents'
							}
						}]

						labels = function (tooltipItems, data) {
							var i, label = [], l = data.datasets.length;
							for (i = 0; i < l; i++) {
								IndivData =  data.datasets[i].labels[tooltipItems.index];
								IndivDataNum = data.datasets[i].data[tooltipItems.index];
								DataPercent = (IndivDataNum * 100) / {{$totalData}};
								DataPercent = DataPercent.toFixed(2);
								label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";
							}
							return label;
						}

						title = function(tooltipItem, data){
							dataTitle = document.getElementById("")
							return "Impacts To " + var1;
						}
					}

					var doughnutChart = new Chart(ctx, {
						type: graphType4,
                    // The data for our dataset
                    data: datas,
                    options: {
                    	plugins: {
                    		datalabels: {
                    			formatter: function(value) {
                    				return ((value *100) / {{$totalData}}).toFixed(2) + "%";
                    			},
            					// anchor: 'end',
            					// align: 'end',
            					offset: 0.01
            				}
            			},
            			tooltips: {
            				callbacks: {
            					label: labels,
            					title: title
            				}
            			}
            		}
            	});
				}  

				if (graphType5 == 'pie'){
					const ctx = document.getElementById('myChart').getContext('2d');
					var coloR = [];

					var dynamicColors = function() {
						var r = Math.floor(Math.random() * 255);
						var g = Math.floor(Math.random() * 255);
						var b = Math.floor(Math.random() * 255);
						return "rgb(" + r + "," + g + "," + b + ","+ 0.8 + ")";
					};

					for (var i in obj1) {
						coloR.push(dynamicColors());
					}

					xCategoryVal = obj2;
					yCategoryVal = obj4;
					xAxes = [];
					yAxes =[];
					labels = [];
					title = [];
					datas = [];

					if(yCategoryVal != "")
				{	//Data Sets
					var datas = {
						labels: <?php echo json_encode($Data2SetlabelX ?? '', true) ?>,
						datasets: [
						<?php foreach ($Data1SetlabelX as $allDataIndex => $allDataValue): ?>{

							label: "{{$allDataValue}}",
							data: rData1Chunked[{{$allDataIndex}}],
							backgroundColor: coloR,
							borderColor: coloR,
								// fill: false,
						      // notice the gap in the data and the spanGaps: true
						  },<?php endforeach ?>
						  ]
						};

						labels= function (tooltipItems, data) {
							const labels = data.datasets[tooltipItems.datasetIndex].label;
							const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index];
							var percentRes = ((dataVal * 100) / {{$totalData}});
							percentRes = percentRes.toFixed(2);
							return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
						}

						title = function(tooltipItem, data){
							return "Impacts To " + var1 +" and " + var2;
						}
					} 
					else if(yCategoryVal == "")
					{	
						datas= {
							labels: obj2,
							datasets: [{
								labels: obj2,
								label: var1,
								data: obj1,
								backgroundColor: coloR,
								borderColor: coloR,
								fill: false,
							}]
						}
						xAxes = [{
							ticks: {
								autoSkip: false,
							},
							display: true,
							type:'category',
							position: 'bottom',
							id:'x-prime',
							labels: obj2,
							scaleLabel: {
								display: true,
								labelString: var1
							}
						}]

						yAxes= [{
							ticks: {
								max: 1200,
								min: 0,
								stepSize: 100,
							},
							scaleLabel: {
								display: true,
								labelString: 'Respondents'
							}
						}]

						labels = function (tooltipItems, data) {
							var i, label = [], l = data.datasets.length;
							for (i = 0; i < l; i++) {
								IndivData =  data.datasets[i].labels[tooltipItems.index];
								IndivDataNum = data.datasets[i].data[tooltipItems.index];
								DataPercent = (IndivDataNum * 100) / {{$totalData}};
								DataPercent = DataPercent.toFixed(2);
								label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";
							}
							return label;
						}

						title = function(tooltipItem, data){
							dataTitle = document.getElementById("")
							return "Impacts To " + var1;
						}
					}


					var pieChart = new Chart(ctx, {
						type: graphType5,
                    // The data for our dataset
                    data: datas,
                    options: {
                    	plugins: {
                    		datalabels: {
                    			formatter: function(value) {
                    				return ((value *100) / {{$totalData}}).toFixed(2) + "%";
                    			},
            					// anchor: 'end',
            					// align: 'end',
            					offset: 0.01
            				}
            			},
            			title: {
            				display: true,
            				text: 'PIE GRAPH FOR ' + var1.toUpperCase()
            			},
            			tooltips: {
            				callbacks: {
            					label: labels,
            					title:title
            				}
            			}
            		}
            	});
				} 

				if (graphType6 == 'polarArea'){
					const ctx = document.getElementById('myChart').getContext('2d');
					var coloR = [];

					var dynamicColors = function() {
						var r = Math.floor(Math.random() * 255);
						var g = Math.floor(Math.random() * 255);
						var b = Math.floor(Math.random() * 255);
						return "rgb(" + r + "," + g + "," + b + "," + 0.4 +")";
					};

					for (var i in obj2) {
						coloR.push(dynamicColors());
					}
					xCategoryVal = obj2;
					yCategoryVal = obj4;
					xAxes = [];
					yAxes =[];
					labels = [];
					title = [];
					datas = [];
					console.log(obj1,obj2,obj3,obj4)

					if(yCategoryVal != "")
					{	
						document.getElementsByName("allColumnsname1").selectedIndex = 0;
						document.getElementsByName("allColumnsname2").selectedIndex = 0;
						document.getElementsByName("allColumnsname3").selectedIndex = 0;
						document.getElementsByName("allColumnsname4").selectedIndex = 0;
						alert("Polar Area Graph only supports 1 Data at a time!");
						polarAreaChart.destroy();
					} 

					else if(yCategoryVal == "")
					{	
						datas= {
							labels: obj2,
							datasets: [{
								label: 'RADAR GRAPH FOR ' + var1.toUpperCase(), 
                    		// fill: true,
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}],
                    }

                    labels= function (tooltipItems, data) {
                    	var i, label = [], l = data.datasets.length;
                    	for (i = 0; i < l; i++) {
                    		IndivData =  data.datasets[i].labels[tooltipItems.index];
                    		IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    		DataPercent = (IndivDataNum * 100) / {{$totalData}};
                    		DataPercent = DataPercent.toFixed(2);
                    		label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";
                    	}
                    	return label;
                    }

                    title= function(tooltipItem, data){
                    	return "Impacts To " + var1;
                    }
                }

                var polarAreaChart = new Chart(ctx, {
                	type: 'polarArea',
                    // The data for our dataset
                    data: datas,
                    options: {
                    	plugins: {
                    		datalabels: {
                    			formatter: function(value) {
                    				return ((value *100) / {{$totalData}}).toFixed(2) + "%";
                    			},
            					// anchor: 'end',
            					// align: 'end',
            					offset: 0.01
            				}
            			},
            			scale: {
            				angleLines: {
            					display: false
            				}
            			},
            			tooltips: {
            				callbacks: {
            					label: labels,
            					title: title
            				}
            			}
            		}
            	});
            }
            if (graphType7 == 'bubble')
            {
            	
            	var coloR = [];

            	xCategoryVal = obj2;
            	yCategoryVal = obj4;
            	y2CategoryVal = obj6;
            	var data = [];

            	if(yCategoryVal == "")
            	{	
            		document.getElementsByName("allColumnsname1").selectedIndex = 0;
            		document.getElementsByName("allColumnsname2").selectedIndex = 0;
            		document.getElementsByName("allColumnsname3").selectedIndex = 0;
            		document.getElementsByName("allColumnsname4").selectedIndex = 0;
            		alert("Bubble Graph only supports 2 Data!");
            		myChart.destroy();
            	} else if(yCategoryVal != ""  && y2CategoryVal != "")
            	{
            		// alert("This newly developed. Data Table Has Done and Graph Is Still Under Construction. Thank you");
            		var dynamicColors = function() {
            			var r = Math.floor(Math.random() * 255);
            			var g = Math.floor(Math.random() * 255);
            			var b = Math.floor(Math.random() * 255);
            			return "rgb(" + r + "," + g + "," + b + "," + 0.5 + ")";
            		};

            		for (var i in xData1) {
            			coloR.push(dynamicColors());
            		}

            		

            		xAxes= [{
            			scaleLabel: {
            				display: true,
            				labelString: var2
            			},
            			ticks: {
            				autoSkip: false,
            			},
            			offset: 150,
            			gridLines: {
            				display:false,
            			},
            			display: true,
            			type:'category',
            			labels: yCategoryVal,
            		}]

            		yAxes= [{
            			scaleLabel: {
            				display: true,
            				labelString: var3
            			},
            			ticks: {
            				autoSkip: false,
            			},
            			gridLines: {
            				display:false,
            			},
            			offset: 150,
            			display: true,
            			type:'category',
            			labels: y2CategoryVal,
            		}]

            		label = 'Relationship Between ' + var1 + ' and ' + var2 + ' and ' + var3;

            		<?php foreach ($Data1SetlabelX as $d1X=> $valueD1X) { ?>
            			const ctx{{$d1X}} = document.getElementById('myChart{{$d1X}}').getContext('2d');

            			data = yData1.map((x, i) => {
            				return {
            					x: x,
            					y: yData3[i],
            					r: (((rData2Chunked[{{$d1X}}][i] * 100) / {{$totalData}}).toFixed(2)),
            				// (((rData2[i] * 100) / {{$totalData}}).toFixed(2)),
            				label: XYData1[i],
            				labels: XYData1[i],
            			};
            		});

            			var myChart = new Chart(ctx{{$d1X}}, {
            				type: graphType7,
            				data: {
            					datasets: [{
            						label: label,
            						data: data,
            						backgroundColor: coloR,
            						borderColor: coloR,
            					}]
            				}, 
            				options:{
            					plugins: {
            						datalabels: {
            							formatter: function(value) {
            								return value.r + '%';
            							},
            							anchor: 'end',
            							align: 'end',
            							offset: 0.01
            						}
            					},
            					title: {
            						display: true,
            						text: 'BUBBLE GRAPH FOR ' + var1.toUpperCase() + ' AND ' + var2.toUpperCase() + ' ({{$valueD1X}})',
            					},
            					responsive: true,
            					scales: {
            						xAxes: xAxes, 
            						yAxes: yAxes,
            					},
            					tooltips: {
            						callbacks: {
            							label: function (tooltipItems, data) {
            								const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label;
            								const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].r;

            						// dataVal1 = Math.round(dataVal1);
            						return label = labels + ": " + dataVal  + "% of Respondent(s).";
            					},
            					title: function(tooltipItem, data){
            						return "Impacts To " + var1 +" and " + var2;
            					}
            				}
            			}
            		}
            	});
            		<?php } ?>

            	} else {
            		const ctx = document.getElementById('myChart').getContext('2d');
            		data = xData1.map((x, i) => {
            			return {
            				x: x,
            				y: yData1[i],
            				r: (((rData1[i] * 100) / {{$totalData}}).toFixed(2)),
            				label: XYData1[i]
            			};
            		});

            		var dynamicColors = function() {
            			var r = Math.floor(Math.random() * 255);
            			var g = Math.floor(Math.random() * 255);
            			var b = Math.floor(Math.random() * 255);
            			return "rgb(" + r + "," + g + "," + b + "," + 0.5 + ")";
            		};

            		for (var i in rData1) {
            			coloR.push(dynamicColors());
            		}

            		xAxes= [{
            			scaleLabel: {
            				display: true,
            				labelString: var1
            			},
            			ticks: {
            				autoSkip: false,
            			},
            			offset: 150,
            			gridLines: {
            				display:false,
            			},
            			display: true,
            			type:'category',
            			labels: xCategoryVal,
            		}]

            		yAxes= [{
            			scaleLabel: {
            				display: true,
            				labelString: var2
            			},
            			ticks: {
            				autoSkip: false,
            			},
            			gridLines: {
            				display:false,
            			},
            			offset: 150,
            			display: true,
            			type:'category',
            			labels: yCategoryVal,
            		}]

            		label = 'Relationship Between ' + var1 + ' and ' + var2;

            		var myChart = new Chart(ctx, {
            			type: graphType7,
            			data: {
            				datasets: [{
            					label: label,
            					data: data,
            					backgroundColor: coloR,
            					borderColor: coloR,
            				}]
            			}, 
            			options:{
            				plugins: {
            					datalabels: {
            						formatter: function(value) {
            							return value.r + '%';
            						},
            						anchor: 'end',
            						align: 'end',
            						offset: 0.01
            					}
            				},
            				title: {
            					display: true,
            					text: 'BUBBLE GRAPH FOR ' + var1.toUpperCase() + ' AND ' + var2.toUpperCase()
            				},
            				responsive: true,
            				scales: {
            					xAxes: xAxes, 
            					yAxes: yAxes,
            				},
            				tooltips: {
            					callbacks: {
            						label: function (tooltipItems, data) {
            							const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label;
            							const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].r;

            						// dataVal1 = Math.round(dataVal1);
            						return label = labels + ": " + dataVal  + "% of Respondent(s).";
            					},
            					title: function(tooltipItem, data){
            						return "Impacts To " + var1 +" and " + var2;
            					}
            				}
            			}
            		}
            	});
            	}  	
            }
            if (graphType8 == 'scatter')
            {
            	const ctx = document.getElementById('myChart').getContext('2d');
            	var coloR = [];
            	var dynamicColors = function() {
            		var r = Math.floor(Math.random() * 255);
            		var g = Math.floor(Math.random() * 255);
            		var b = Math.floor(Math.random() * 255);
            		return "rgb(" + r + "," + g + "," + b + ")";
            	};

            	for (var i in rData1) {
            		coloR.push(dynamicColors());
            	}

            	xCategoryVal = obj2;
            	yCategoryVal = obj4;
            	y2CategoryVal = obj6;

            	var data = [];
            	var xAxes = [];
            	var yAxes = [];
            	var title = [];
            	var label = [];
            	var labels = [];
            	var datas = [];


            	if(yCategoryVal == "" && y2CategoryVal =="")  
            	{	
            		datas = xData1.map((x, i) => {
            			return {
            				x: x,
            				y: yData1[i],
            				label: XYData1[i]
            			};
            		});

            		console.log(datas);
						//Axes
						xAxes = [{
							ticks: {
								autoSkip: false,
							},
							display: true,
							type:'category',
							labels: xData1,
							scaleLabel: {
								display: true,
								labelString: var1
							},
							gridLines: {
								display:true,
							}
						}]

						yAxes= [{
							ticks: {
								autoSkip: false,
							},
							scaleLabel: {
								display: true,
								labelString: 'Respondents'
							},
							gridLines: {
								display:true,
							}
						}]

						data = {
							datasets: [{
								label:  var1 + ' Data',
								data: datas,
								backgroundColor: coloR,
								borderColor: coloR,
								fill: false,
							}]
						}
						labels = 'BUBBLE GRAPH FOR ' + var1.toUpperCase();

						label= function (tooltipItems, data) {
							const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label;
							const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].y;
							var percentRes = ((dataVal * 100) / {{$totalData}});
							percentRes = percentRes.toFixed(2);
							return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
						}
						title= function(tooltipItem, data){
							return "Impacts To " + var1;
						}

						datalabels= {
							formatter: function(value, context) {
								return (((value.y *100) / {{$totalData}}).toFixed(2)) + "%";
							},
							anchor: 'end',
							align: 'end',
							offset: 0.01
						}

					} else if(yCategoryVal != "" && y2CategoryVal =="")  
					{
						var data = {
							labels: <?php echo json_encode($Data2SetlabelX ?? '', true) ?>,
							datasets: [
							<?php foreach ($Data1SetlabelX as $allDataIndex => $allDataValue): ?>{
								label: "{{$allDataValue}}",
								data: rData1Chunked[{{$allDataIndex}}],
								backgroundColor: coloR[{{$allDataIndex}}],
								borderColor: coloR[{{$allDataIndex}}],
								fill: false,

							},<?php endforeach ?>
							]
						};
						xAxes= [{
							scaleLabel: {
								display: true,
								labelString: var2
							},
							ticks: {
								autoSkip: false,
							},
							offset: 150,
							gridLines: {
								display:true,
							},
							display: true,
							type:'category',
							labels: yCategoryVal,
						}]
						yAxes= [{
							scaleLabel: {
								display: true,
								labelString: "Respondents"
							},
							ticks: {
								autoSkip: false,
							},
							gridLines: {
								display:true,
							},
							offset: 150,
							display: true,
								// type:'category',
								// labels: yCategoryVal,
							}]
							labels = 'RELATIONSHIP BETWEEN ' + var1.toUpperCase() + ' AND ' + var2.toUpperCase();
							label= function (tooltipItems, data) {
								const labels = data.datasets[tooltipItems.datasetIndex].label;
								const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index];
								var percentRes = ((dataVal * 100) / {{$totalData}});
								percentRes = percentRes.toFixed(2);
								return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
							}
							title= function(tooltipItem, data){
								return "Impacts To " + var1 +" and " + var2;
							}
							datalabels= {
								formatter: function(value, context) {
									return (((value *100) / {{$totalData}}).toFixed(2)) + "%";
								},
								anchor: 'end',
								align: 'end',
								offset: 0.01
							}

						} 
						else if(yCategoryVal != "" && y2CategoryVal !="")  
						{

							dataTemp1 = xData1.map((x, i) => {
								return {
									x: x,
									y: yData1[i],
									r: rData1[i],
									labels: XYData1[i]
								};
							})

							dataTemp2 = xData2.map((x, j) => {
								return {
									x: x,
									y: yData2[j],
									r: rData2[j],
									labels: XYData2[j]
								}
							})

							data = {
								datasets: [{
									label: 'Relationship Between ' + var1 + ' and ' + var2,
									data: dataTemp1,
									backgroundColor: 'rgb(139,0,0)' ,
									borderColor: 'rgb(139,0,0)' ,
									fill: false,
									yAxisID: 'A'
								},{
									label: 'Relationship Between ' + var1 + ' and ' + var3,
									data: dataTemp2,
									backgroundColor: 'rgb(0,0,255)',
									borderColor: 'rgb(0,0,255',
									fill: false,
									yAxisID: 'B'
								}]
							}

							console.log(data);

							xAxes= [{
								scaleLabel: {
									display: true,
									labelString: var1
								},
								ticks: {
									autoSkip: false,
								},
								offset: 150,
								gridLines: {
									display:true,
								},
								display: true,
								type:'category',
								labels: xCategoryVal,
								position: 'bottom',
							}];

							yAxes= [{
								id: 'A',
								scaleLabel: {
									display: true,
									labelString: var2
								},
								ticks: {
									autoSkip: false,
								},
								gridLines: {
									display:true,
								},
								offset: 150,
								display: true,
								type:'category',
								labels: yCategoryVal,
								position: 'left'							
							},{
								id: 'B',
								scaleLabel: {
									display: true,
									labelString: var3
								},
								ticks: {
									autoSkip: false,
								},
								gridLines: {
									display:true,
								},
								offset: 150,
								display: true,
								type:'category',
								labels: y2CategoryVal,
								position: 'right'							
							}]

							labels = 'Relationship Between ' + var1 + ', ' + var2 + ' and ' + var3;

							label= function (tooltipItems, data) {
								const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].labels;
								const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].r;
								var percentRes = ((dataVal * 100) / {{$totalData}});
								percentRes = percentRes.toFixed(2);
								return label = labels + ": " + dataVal + " Respondent(s) : "  + percentRes + "%";
							}
							title= function(tooltipItem, data){
								return "Impacts To " + var1 +" and " + var2;
							}
						}

						var myChart = new Chart(ctx, {
							type: graphType8,
							data: data, 
							options:{
								plugins: {
									datalabels: datalabels
								},
								title: {
									display: true,
									text: labels
								},
								responsive: true,
								scales: {
									xAxes: xAxes, 
									yAxes: yAxes
								},
								tooltips: {
									callbacks: {
										label: label,
										title: title
									}
								}
							}
						});
					}
				</script>
				@endsection