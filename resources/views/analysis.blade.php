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
			<div class="container col-sm-12 p-3 my-3 border">
				<canvas id="myChart" width="800" height="500"></canvas>
				<!-- <canvas id="forecast" width="100" height="50"></canvas> -->
				<div class="col-sm-12"><center>
					<button id="0" type="button">View Data</button>
					<button id="1" type="button">Download</button>
				</center></div><br><br></div>
		<div class="col-sm-6">
				<div class="container p-3 my-3 border">
					<canvas id="myChart" width="800" height="500"></canvas>
					<div class="col-sm-12"><center>
						<button id="0" type="button">View Data</button>
						<button id="1" type="button">Download</button>
					</center></div><br><br></div>
				</div>
			</div>
		<div style="color: blue; text-align: center;">
			<h1><strong>DATA ANALYSIS: PSYCHOLOGICAL PROBLEM</strong></h1>
		</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="container p-3 my-3 border">
						<canvas id="myChart2" width="800" height="600"></canvas>
						<div class="col-sm-12"><center>
							<button id="0" type="button">View Data</button>
							<button id="1" type="button">Download</button>
						</center></div></div>

						<div class="container p-3 my-3 border">
							<canvas id="myChart2" width="800" height="600"></canvas>
							<div class="col-sm-12"><center>
								<button id="0" type="button">View Data</button>
								<button id="1" type="button">Download</button>
							</center></div></div>
						</div>
					</div>
				</div></div>
				<script>

					const color = [];
					const xlabels = [];
					const incomeType = <?php echo json_encode($IncomeType, true) ?>;
					const costType = <?php echo json_encode($CostType, true) ?>;
					const psychologicalType = <?php echo json_encode($PsychologicalType, true) ?>;
					const abusedType = <?php echo json_encode($AbusedType, true) ?>;

					const PsychologicalData = <?php echo json_encode($CountPsychological, true) ?>;
					const AbusedData= <?php echo json_encode($CountAbused, true) ?>;
					const incomeData = <?php echo json_encode($CountIncome, true) ?>;
					const costData = <?php echo json_encode($CountCost, true) ?>;

					const ctx = document.getElementById('myChart').getContext('2d');

					var dynamicColors = function() {
						var r = Math.floor(Math.random() * 255);
						var g = Math.floor(Math.random() * 255);
						var b = Math.floor(Math.random() * 255);
						return "rgb(" + r + "," + g + "," + b + ")";
					};
					for (var i in incomeType) {
						this.dynamicColors;
						color.push(dynamicColors());
					}
					var myChart = new Chart(ctx, {
						type: 'line',
						data: {
							datasets: [{
								labels: incomeType,
								label: 'Income',
								data: incomeData,
								backgroundColor: 'rgb(0,35,102)',
								borderColor: 'rgb(0,35,102)',
								borderWidth: 3,
								fill: false,
								xAxisID: "x-prime",
							},
							{
								labels : costType,
								label: 'Expenses',
								data: costData,
								backgroundColor: 'rgb(227,38,54)',
								borderColor: 'rgb(227,38,54)',
								borderWidth: 3,
								fill: false,
								xAxisID: "x-sec",
							}, 
							{
								labels: psychologicalType,
								label: 'Psychological',
								data: PsychologicalData,
								backgroundColor: 'rgb(0,35,102)',
								borderColor: 'rgb(0,35,102)',
								borderWidth: 3,
								fill: false,
								yAxisID: "y-prime",
							},
							{
								labels: abusedType,
								label: 'Abused',
								data: AbusedData,
								backgroundColor: 'rgb(0,35,102)',
								borderColor: 'rgb(0,35,102)',
								borderWidth: 3,
								fill: false,
								yAxisID: "y-sec",
							}],
						}, 
						options:{
							tooltips: {
								enabled: true,
								mode: 'single',
								backgroundColor: 'rgba(0,0,0,0.9)',
								titleFontSize: 14,
								titleFontStyle: 'bold',
								titleFontColor: "#FFF",
								bodyFontSize: 12,
								bodyFontStyle: 'normal',
								bodyFontColor: "#FFF",
								footerFontSize: 12,
								footerFontStyle: 'normal',
								footerFontColor: "#FFF",
								cornerRadius: 5,
								callbacks: {
									label: function (tooltipItems, data) {
										var i, label = [], l = data.datasets.length;
										for (i = 0; i < l; i++) {
											IndivData = data.datasets[i].data[tooltipItems.index];
											IndivData1 = (IndivData * 100) / 1075;
											IndivData1 = IndivData1.toFixed(2);
											label[i] = data.datasets[i].label + ": " + data.datasets[i].labels[tooltipItems.index] + ' : ' + IndivData1 + '% ; Total Respondents = ' + IndivData;

										}
										return label;
									},
									title: function(tooltipItem, data){
										return "Impacts To Financial:";
									}
								},
							},
							scales: {
								xAxes: [{
									ticks: {
										autoSkip: false,
									},
									display: true,
									type:'category',
									position: 'bottom',
									id:'x-prime',
									labels: incomeType,
								}, {
									ticks: {
										autoSkip: false,
									},
									type:'category',
									position: 'top',
									id:'x-sec',
									labels: costType,
								}],
								yAxes: [{
									ticks: {
										autoSkip: false,
									},
									display: true,
									type:'category',
									position: 'left',
									id:'y-prime',
									labels: psychologicalType,
								}, {
									ticks: {
										autoSkip: false,
									},
									type:'category',
									position: 'right',
									id:'y-sec',
									labels: abusedType,
								}],
							},
						},
					});
				</script>

				<!-- Psychological Problem -->
				<script>
					const psychologicalType = <?php echo json_encode($PsychologicalType, true) ?>;
					const abusedType = <?php echo json_encode($AbusedType, true) ?>;

					const psychologicalData = <?php echo json_encode($CountPsychological, true) ?>;
					const abusedData = <?php echo json_encode($CountAbused, true) ?>;
					const ctx2 = document.getElementById('myChart2').getContext('2d');

					var dynamicColors = function() {
						var r = Math.floor(Math.random() * 255);
						var g = Math.floor(Math.random() * 255);
						var b = Math.floor(Math.random() * 255);
						return "rgb(" + r + "," + g + "," + b + ")";
					};
					for (var i in incomeType) {
						this.dynamicColors;
						color.push(dynamicColors());
					}
					var myChart2 = new Chart(ctx2, {
						type: 'line',
						data: {
							datasets: [{
								labels: psychologicalType,
								label: 'Psychological Factors',
								data: psychologicalData,
								backgroundColor: 'rgb(0,35,102)',
								borderColor: 'rgb(0,35,102)',
								borderWidth: 3,
								fill: false,
								xAxisID: "x1",
							},
							{
								labels : abusedType,
								label: 'Abused Factors',
								data: abusedData,
								backgroundColor: 'rgb(227,38,54)',
								borderColor: 'rgb(227,38,54)',
								borderWidth: 3,
								fill: false,
								xAxisID: "x2",
							}],
						}, 
						options:{
							tooltips: {
								enabled: true,
								mode: 'single',
								backgroundColor: 'rgba(0,0,0,0.9)',
								titleFontSize: 14,
								titleFontStyle: 'bold',
								titleFontColor: "#FFF",
								bodyFontSize: 12,
								bodyFontStyle: 'normal',
								bodyFontColor: "#FFF",
								footerFontSize: 12,
								footerFontStyle: 'normal',
								footerFontColor: "#FFF",
								cornerRadius: 5,
								callbacks: {
									label: function (tooltipItems, data) {
										var i, label = [], l = data.datasets.length;
										for (i = 0; i < l; i++) {
											IndivData = data.datasets[i].data[tooltipItems.index];
											IndivData1 = (IndivData * 100) / 1075;
											IndivData1 = IndivData1.toFixed(2);
											label[i] = data.datasets[i].label + ": " + data.datasets[i].labels[tooltipItems.index] + ' : ' + IndivData1 + '% ; Total Respondents = ' + IndivData;

										}
										return label;
									},
									title: function(tooltipItem, data){
										return "Impacts To Psychological:";
									},
								},
							},
							scales: {
								yAxes: [{
									ticks: {
										max: 1100,
										min: 0,
										stepSize: 100
									}
								}],
								xAxes: [{
									ticks: {
										autoSkip: false,
									},
									display: true,
									type:'category',
									position: 'bottom',
									id:'x1',
									labels: psychologicalType,
								}, {
									type:'category',
									position: 'top',
									id:'x2',
									labels: abusedType,
								}],
							},
						},
					});
				</script>


				<!-- Psychological Problem -->
				<script>
					const psychologicalType = <?php echo json_encode($PsychologicalType, true) ?>;
					const abusedType = <?php echo json_encode($AbusedType, true) ?>;

					const psychologicalData = <?php echo json_encode($CountPsychological, true) ?>;
					const abusedData = <?php echo json_encode($CountAbused, true) ?>;
					const ctx2 = document.getElementById('myChart2').getContext('2d');

					var dynamicColors = function() {
						var r = Math.floor(Math.random() * 255);
						var g = Math.floor(Math.random() * 255);
						var b = Math.floor(Math.random() * 255);
						return "rgb(" + r + "," + g + "," + b + ")";
					};
					for (var i in incomeType) {
						this.dynamicColors;
						color.push(dynamicColors());
					}
					var myChart2 = new Chart(ctx2, {
						type: 'line',
						data: {
							datasets: [{
								labels: psychologicalType,
								label: 'Psychological Factors',
								data: psychologicalData,
								backgroundColor: 'rgb(0,35,102)',
								borderColor: 'rgb(0,35,102)',
								borderWidth: 3,
								fill: false,
								xAxisID: "x1",
							},
							{
								labels : abusedType,
								label: 'Abused Factors',
								data: abusedData,
								backgroundColor: 'rgb(227,38,54)',
								borderColor: 'rgb(227,38,54)',
								borderWidth: 3,
								fill: false,
								xAxisID: "x2",
							}],
						}, 
						options:{
							tooltips: {
								enabled: true,
								mode: 'single',
								backgroundColor: 'rgba(0,0,0,0.9)',
								titleFontSize: 14,
								titleFontStyle: 'bold',
								titleFontColor: "#FFF",
								bodyFontSize: 12,
								bodyFontStyle: 'normal',
								bodyFontColor: "#FFF",
								footerFontSize: 12,
								footerFontStyle: 'normal',
								footerFontColor: "#FFF",
								cornerRadius: 5,
								callbacks: {
									label: function (tooltipItems, data) {
										var i, label = [], l = data.datasets.length;
										for (i = 0; i < l; i++) {
											IndivData = data.datasets[i].data[tooltipItems.index];
											IndivData1 = (IndivData * 100) / 1075;
											IndivData1 = IndivData1.toFixed(2);
											label[i] = data.datasets[i].label + ": " + data.datasets[i].labels[tooltipItems.index] + ' : ' + IndivData1 + '% ; Total Respondents = ' + IndivData;

										}
										return label;
									},
									title: function(tooltipItem, data){
										return "Impacts To Psychological:";
									},
								},
							},
							scales: {
								yAxes: [{
									ticks: {
										max: 1100,
										min: 0,
										stepSize: 100
									}
								}],
								xAxes: [{
									ticks: {
										autoSkip: false,
									},
									display: true,
									type:'category',
									position: 'bottom',
									id:'x1',
									labels: psychologicalType,
								}, {
									type:'category',
									position: 'top',
									id:'x2',
									labels: abusedType,
								}],
							},
						},
					});
				</script>

















				@endsection