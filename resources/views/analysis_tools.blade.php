@extends('layouts.main')
@section('content')

<?php

$univ = array
(
	array("name"=>"Universiti Putra Malaysia","abb"=>"UPM"),
	array("name"=>"Universiti Kebangsaan Malaysia","abb"=>"UKM"),
	array("name"=>"Universiti Malaya","abb"=>"UM"),
	array("name"=>"Universiti Sains Malaysia","abb"=>"USM"),
	array("name"=>"Universiti Teknologi Malaysia","abb"=>"UTM")
);

?>

<title>IVI IIR 4.0: Analysis Tool</title>
<style>
	canvas {
		text-align: center;
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

</style>

<!-- Header for the dashboard. -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- Add jQuery lib here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<div>
	<h1><strong>RELATIONSHIP ANALYSIS TOOL</strong></h1>
</div>
<div class="container-fluid" style="margin-bottom: 2%;">
	<div class="row" style="padding: 10px;">
		<div class="col-sm-12 m-3">
			<div class="container col-sm-8 p-1 my-1" style="float: left;">
				<canvas id="myChart" width="1920" height="1080"></canvas></div>
				<div class="container col-sm-3 m-3" style="float: left;">
					<label>Graph Types:</label><br>
					<span class="form-check">
						<div class="checkboxContainer row" id="checkboxId">
							<div class="col-xs-12 col-sm-12 col-md-6 form-check">
								<input type="checkbox" name="checkboxID" id="LineGraph" value="#" onclick="return ValidateGraphSelected();">Line Graph<br>
								<input type="checkbox" name="checkboxID" id="BarGraph" value="#" onclick="return ValidateGraphSelected();">Bar Graph<br>
								<input type="checkbox" name="checkboxID" id="RadarGraph" value="#" onclick="return ValidateGraphSelected();">Radar Graph<br>
								<input type="checkbox" name="checkboxID" id="DoughnutGraph" value="#" onclick="return ValidateGraphSelected();">Doughnut Graph<br>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6">
								<input type="checkbox" name="checkboxID" id="PieGraph" value="#" onclick="return ValidateGraphSelected();">Pie Graph<br>
								<input type="checkbox" name="checkboxID" id="PolarAreaGraph" value="#" onclick="return ValidateGraphSelected();">Polar Area Graph<br>
								<input type="checkbox" name="checkboxID" id="BubbleGraph" value="#" onclick="return ValidateGraphSelected();">Bubble Graph<br>
								<input type="checkbox" name="checkboxID" id="ScatterGraph" value="#" onclick="return ValidateGraphSelected();">Scatter Graph
							</div>
							<script>
								function ValidateGraphSelected()  
								{  
									var checkboxes = document.getElementsByName("checkboxID");  
									var numberOfCheckedItems = 0;  
									for(var i = 0; i < checkboxes.length; i++)  
									{  
										if(checkboxes[i].checked)  
											numberOfCheckedItems++;  
									}  
									if(numberOfCheckedItems > 2)  
									{  
										alert("Maximum 2 Graphs Only Supported!");  
										$('input:checkbox').prop('checked', false);
										return false;  
									}  else if (numberOfCheckedItems == 0){
										alert("Please Pick a Graph");
									}
								}  
							</script>
						</div>
					</span>
					<div style="padding-top: 20px;">
						<label for="datasets">Data 1:</label>
						<select class="combobox" name="allColumnsname1" id="datasets1">
							<option value="Select" selected>Select</option>
							@foreach($allColumnsname as $acn1)
							<option value="{{ $acn1 }} "> {{ $acn1 }} </option>
							@endforeach
						</select>
						<label for="datasets2">Data 2:</label>
						<select class="combobox" name="allColumnsname2" id="datasets2">
							<option value="Select" selected>Select</option>
							@foreach($allColumnsname as $acn2)
							<option value="{{ $acn2 }} "> {{ $acn2 }} </option>
							@endforeach
						</select>
						<label for="datasets">Data 3:</label>
						<select class="combobox" name="allColumnsname3" id="datasets3">
							<option value="Select" selected>Select</option>
							@foreach($allColumnsname as $acn3)
							<option value="{{ $acn3 }} "> {{ $acn3 }} </option>
							@endforeach
						</select>
						<label for="datasets">Data 4:</label>
						<select class="combobox" name="allColumnsname4" id="datasets4">
							<option value="Select" selected>Select</option>
							@foreach($allColumnsname as $acn4)
							<option value="{{ $acn4 }} "> {{ $acn4 }} </option>
							@endforeach
						</select>
						<center>
							<div style="padding-top: 5%;">
								<input class="btn" id="submitbtn" type="submit" name="submit" onclick="getData();">
								<input class="btn" id="resetbtn" type="reset" name="reset"> 
								<script>
									$(function () {
										$("#resetbtn").bind("click", function () {
											$("#datasets1")[0].selectedIndex = 0;
											$("#datasets2")[0].selectedIndex = 0;
											$("#datasets3")[0].selectedIndex = 0;
											$("#datasets4")[0].selectedIndex = 0;
											$('input:checkbox').prop('checked', false);
										});
									});
								</script>
							</div>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
//Function to Retrieve Data 

function getData() {
	const DDBox1 = $("#datasets1")[0].value;
	const DDBox2 = $("#datasets2")[0].value;
	const DDBox3 = $("#datasets3")[0].value;
	const DDBox4 = $("#datasets4")[0].value;

	if (DDBox1 == 'Select'){
		alert("Please Pick Data at Data 1 First!");
		$("#datasets1")[0].selectedIndex = 0;
		$("#datasets2")[0].selectedIndex = 0;
		$("#datasets3")[0].selectedIndex = 0;
		$("#datasets4")[0].selectedIndex = 0;
	} else if(DDBox1 != 'Select' && DDBox2 == 'Select' && (DDBox3 != 'Select' || DDBox4 != 'Select')){
		alert("Please Pick Data at Data 2 First!");
		$("#datasets3")[0].selectedIndex = 0;
		$("#datasets4")[0].selectedIndex = 0;
	} else if(DDBox1 != 'Select' && DDBox2 != 'Select' && DDBox3 == 'Select' && DDBox4 != 'Select'){
		alert("Please Pick Data at Data 3 First!");
		$("#datasets4")[0].selectedIndex = 0;
	}


	// const datasets1 =JSON.parse( DDBox1);
	alert(JSON.parse(DDBox1));

}

//Retrieve Data  - High Income 
const HighIncomeNoCost = <?php echo json_encode($HighIncomeNoCost, true) ?>;
const HighIncomeAddictCost = <?php echo json_encode($HighIncomeAddictCost, true) ?>;
const HighIncomeEduCost = <?php echo json_encode($HighIncomeEduCost, true) ?>;
const HighIncomeNFMCost = <?php echo json_encode($HighIncomeNFMCost, true) ?>;
const HighIncomeUICost = <?php echo json_encode($HighIncomeUICost, true) ?>;
const HighIncomeOtherCost = <?php echo json_encode($HighIncomeOtherCost, true) ?>;

xCategoryVal = ['No income', 'Daily income', 'Low income', 'Medium income', 'High income'];
yCategoryVal = ['Unexpected illness', 'Others', 'New family members (new born)', 'Education expenses', 'Addiction in spending more than needs', 'No'];

var coloR = [];

var dynamicColors = function() {
	var r = Math.floor(Math.random() * 255);
	var g = Math.floor(Math.random() * 255);
	var b = Math.floor(Math.random() * 255);
	return "rgba(" + r + "," + g + "," + b +','+ '0.2'+ ")";
};

const ctx = document.getElementById('myChart').getContext('2d');

//defining the data
var data = [{data}];
 
for (var i in data) {
	coloR.push(dynamicColors());
}

var myChart = new Chart(ctx, {
	type: 'bubble',
	data: {
		datasets: [{
			label: 'Financial Relationship Between Income Type and Cost Increaments',
			data: data,
			backgroundColor: coloR,
		}]
	}, 
	options:{
		responsive: true,
		scales: {
			xAxes: [{
				gridLines: {
					display:false
				},
				display: true,
				type:'category',
				labels: xCategoryVal,
			}], 
			yAxes: [{
				gridLines: {
					display:false
				},
				display: true,
				type:'category',
				labels: yCategoryVal,
			}],
		},
		tooltips: {
			callbacks: {
				label: function (tooltipItems, data) {
					const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label;
					const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].r;
					DataPercent = (dataVal * 100) / 1075;
					DataPercent = DataPercent.toFixed(2);
					return label = labels + ": " + dataVal + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";

				},
				title: function(tooltipItem, data){
					return "Impacts To Financial:";
				}
			},
		}
	}
});
</script>
@endsection