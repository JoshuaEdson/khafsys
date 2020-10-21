@extends('layouts.main')
@section('content')

<title>IVI IIR 4.0: Data Analysis</title>
<style>
	canvas{
		text-align: center;
	}
	.center {
		/*margin: 0;*/
		padding-top: 30%;
		margin-top: 30%;
		/*right: 100%;*/
/*		-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);*/
}
</style>

<!-- Header for the dashboard. -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- Add jQuery lib here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<div style="color: blue; text-align: center;">
	<h1><strong>DATA ANALYSIS: FINANCIAL PROBLEM</strong></h1>
</div>

<div class="container-fluid text-center">
	<div class="row">
		<div class="col-sm-12">
			<div class="container p-3 my-8 border">
				<canvas id="myChart" width="1500" height="1200"></canvas>
				<!-- <canvas id="forecast" width="100" height="50"></canvas> -->
				<div class="col-sm-12 p3"><center>
					<button id="0" type="button">View Data</button>
					<button id="1" type="button">Download</button>
				</center></div><br><br></div>
			</div>
		</div>
	</div>
<script>
//Retrieve Data  - No Income
const NoIncomeNoCost = <?php echo json_encode($NoIncomeNoCost, true) ?>;
const NoIncomeAddictCost = <?php echo json_encode($NoIncomeAddictCost, true) ?>;
const NoIncomeEduCost = <?php echo json_encode($NoIncomeEduCost, true) ?>;
const NoIncomeNFMCost = <?php echo json_encode($NoIncomeNFMCost, true) ?>;
const NoIncomeUICost = <?php echo json_encode($NoIncomeUICost, true) ?>;
const NoIncomeOtherCost = <?php echo json_encode($NoIncomeOtherCost, true) ?>;

//Retrieve Data  - Daily Income
const DailyIncomeNoCost = <?php echo json_encode($DailyIncomeNoCost, true) ?>;
const DailyIncomeAddictCost = <?php echo json_encode($DailyIncomeAddictCost, true) ?>;
const DailyIncomeEduCost = <?php echo json_encode($DailyIncomeEduCost, true) ?>;
const DailyIncomeNFMCost = <?php echo json_encode($DailyIncomeNFMCost, true) ?>;
const DailyIncomeUICost = <?php echo json_encode($DailyIncomeUICost, true) ?>;
const DailyIncomeOtherCost = <?php echo json_encode($DailyIncomeOtherCost, true) ?>;

//Retrieve Data  - Low Income
const LowIncomeNoCost = <?php echo json_encode($LowIncomeNoCost, true) ?>;
const LowIncomeAddictCost = <?php echo json_encode($LowIncomeAddictCost, true) ?>;
const LowIncomeEduCost = <?php echo json_encode($LowIncomeEduCost, true) ?>;
const LowIncomeNFMCost = <?php echo json_encode($LowIncomeNFMCost, true) ?>;
const LowIncomeUICost = <?php echo json_encode($LowIncomeUICost, true) ?>;
const LowIncomeOtherCost = <?php echo json_encode($LowIncomeOtherCost, true) ?>;

//Retrieve Data  - Medium Income
const MediumIncomeNoCost = <?php echo json_encode($MediumIncomeNoCost, true) ?>;
const MediumIncomeAddictCost = <?php echo json_encode($MediumIncomeAddictCost, true) ?>;
const MediumIncomeEduCost = <?php echo json_encode($MediumIncomeEduCost, true) ?>;
const MediumIncomeNFMCost = <?php echo json_encode($MediumIncomeNFMCost, true) ?>;
const MediumIncomeUICost = <?php echo json_encode($MediumIncomeUICost, true) ?>;
const MediumIncomeOtherCost = <?php echo json_encode($MediumIncomeOtherCost, true) ?>;

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
var data = [{
	x: 'No income',
	y: 'No', 
	r: NoIncomeNoCost,	
	label: 'No Income No Expenses'
},{
	x: 'Daily income',
	y: 'No',
	r: DailyIncomeNoCost,
	label: 'Daily Income No Expenses'
},{
	x: 'Low income',
	y: 'No',
	r: LowIncomeNoCost,
	label: 'Low Income No Expenses'
},{
	x: 'Medium income',
	y: 'No',
	r: MediumIncomeNoCost,
	label: 'Medium Income No Expenses'
},{
	x: 'High income',
	y: 'No',
	r: HighIncomeNoCost,
	label: 'High Income No Expenses'
},{
	x: 'No income',
	y: 'Addiction in spending more than needs',
	r: NoIncomeAddictCost,
	label: 'No Income Addiction Expenses'
	
},{
	x: 'Daily income',
	y: 'Addiction in spending more than needs',
	r: DailyIncomeAddictCost,
	label: 'Daily Income Addiction Expenses'
},{
	x: 'Low income',
	y: 'Addiction in spending more than needs',
	r: LowIncomeAddictCost,
	label: 'Low Income Addiction Expenses'
},{
	x: 'Medium income',
	y: 'Addiction in spending more than needs',
	r: MediumIncomeAddictCost,
	label: 'Medium Income Addiction Expenses'
},{
	x: 'High income',
	y: 'Addiction in spending more than needs',
	r: HighIncomeAddictCost,
	label: 'High Income Addiction Expenses'
},{
	x: 'No income',
	y: 'Education expenses',
	r: NoIncomeEduCost,
	label: 'No Income Education Expenses'
},{
	x: 'Daily income',
	y: 'Education expenses',
	r: DailyIncomeEduCost,
	label: 'Daily Income Education Expenses'
},{
	x: 'Low income',
	y: 'Education expenses',
	r: LowIncomeEduCost,
	label: 'Low Income Education Expenses'
},{
	x: 'Medium income',
	y: 'Education expenses',
	r: MediumIncomeEduCost,
	label: 'Medium Income Education Expenses'
},{
	x: 'High income',
	y: 'Education expenses',
	r: HighIncomeEduCost,
	label: 'High Income Education Expenses'
},{
	x: 'No income',
	y: 'New family members (new born)',
	r: NoIncomeNFMCost,
	label: 'No Income NFM Expenses'
	
},{
	x: 'Daily income',
	y: 'New family members (new born)',
	r: DailyIncomeNFMCost,
	label: 'Daily Income NFM Expenses'
},{
	x: 'Low income',
	y: 'New family members (new born)',
	r: LowIncomeNFMCost,
	label: 'Low Income NFM Expenses'
},{
	x: 'Medium income',
	y: 'New family members (new born)',
	r: MediumIncomeNFMCost,
	label: 'Medium Income NFM Expenses'
},{
	x: 'High income',
	y: 'New family members (new born)',
	r: HighIncomeNFMCost,
	label: 'High Income NFM Expenses'
},{
	x: 'No income',
	y: 'Others',
	r: NoIncomeOtherCost,
	label: 'No Income Other Expenses'
	
},{
	x: 'Daily income',
	y: 'Others',
	r: DailyIncomeOtherCost,
	label: 'Daily Income Other Expenses'
},{
	x: 'Low income',
	y: 'Others',
	r: LowIncomeOtherCost,
	label: 'low Income Other Expenses'
},{
	x: 'Medium income',
	y: 'Others',
	r: MediumIncomeOtherCost,
	label: 'Medium Income Other Expenses'
},{
	x: 'High income',
	y: 'Others',
	r: HighIncomeOtherCost,
	label: 'High Income Other Expenses'
},{
	x: 'No income',
	y: 'Unexpected illness',
	r: NoIncomeUICost,
	label: 'No Income UI Expenses'
},{
	x: 'Daily income',
	y: 'Unexpected illness',
	r: DailyIncomeUICost,
	label: 'Daily Income UI Expenses'
},{
	x: 'Low income',
	y: 'Unexpected illness',
	r: LowIncomeUICost,
	label: 'Low Income UI Expenses'
},{
	x: 'Medium income',
	y: 'Unexpected illness',
	r: MediumIncomeUICost,
	label: 'Medium Income UI Expenses'
},{
	x: 'High income',
	y: 'Unexpected illness',
	r: HighIncomeUICost,
	label: 'High Income UI Expenses'
}];

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
			// fillOpacity: 0.1,
			// borderColor: '#000000',
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
			// mode: 'index',
			callbacks: {
				label: function (tooltipItems, data) {
					const labels = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label;
					const dataVal = data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].r;
					DataPercent = (dataVal * 100) / 1075;
					DataPercent = DataPercent.toFixed(2);
					return label = labels + ": " + dataVal + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";

					// data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].label; <- get all labels from each data. This is done. Just take this and visualize the data.
					// tooltipItems.index; -- show the flow of data plotting. from left to right.
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