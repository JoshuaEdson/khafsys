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
					<form action="{{ route('analysis.postData')}}" method="post" onsubmit=" return validateMyForm()">
						@csrf
						<label>Graph Types:</label><br>
						<span class="form-check">
							<div class="checkboxContainer row" id="checkboxId">
								<div class="col-xs-12 col-sm-12 col-md-6">
									<input type="checkbox" name="LineGraph" id="checkboxID" value="line" onclick=" ValidateGraphSelected();">Line Graph<br>
									<input type="checkbox" name="BarGraph" id="checkboxID" value="bar" onclick=" ValidateGraphSelected();">Bar Graph<br>
									<input type="checkbox" name="RadarGraph" id="checkboxID" value="radar" onclick=" ValidateGraphSelected();">Radar Graph<br>
									<input type="checkbox" name="DoughnutGraph" id="checkboxID" value="doughnut" onclick=" ValidateGraphSelected();">Doughnut Graph
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6">
									<input type="checkbox" name="PieGraph" id="checkboxID" value="pie" onclick=" ValidateGraphSelected();">Pie Graph<br>
									<input type="checkbox" name="PolarAreaGraph" id="checkboxID" value="polarArea" onclick=" ValidateGraphSelected();">Polar Area Graph<br>
									<input type="checkbox" name="BubbleGraph" id="checkboxID" value="bubble" onclick=" ValidateGraphSelected();">Bubble Graph<br>
									<input type="checkbox" name="ScatterGraph" id="checkboxID" value="scatter" onclick=" ValidateGraphSelected();">Scatter Graph
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
										if(numberOfCheckedItems > 2)  
										{  
											alert("Maximum 2 Graphs Only Supported!");  
											$('input:checkbox').prop('checked', false);
											return false;  
										} 
									}
								</script>
							</div>
						</span>

						<div style="padding-top: 20px;">
							<label for="datasets">Data 1:</label>
							<select class="combobox" name="allColumnsname1" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn1)
								<option value="{{ $acn1 }} "> {{ $acn1 }} </option>
								@endforeach
							</select>
							<label for="datasets2">Data 2:</label>
							<select class="combobox" name="allColumnsname2" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn2)
								<option value="{{ $acn2 }} "> {{ $acn2 }} </option>
								@endforeach
							</select>
							<label for="datasets3">Data 3:</label>
							<select class="combobox" name="allColumnsname3" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn3)
								<option value="{{ $acn3 }} "> {{ $acn3 }} </option>
								@endforeach
							</select>
							<label for="datasets4">Data 4:</label>
							<select class="combobox" name="allColumnsname4" id="datasets">
								<option value="" selected>Select</option>
								@foreach($allColumnsname as $acn4)
								<option value="{{ $acn4 }} "> {{ $acn4 }} </option>
								@endforeach
							</select>
							<center>
								<div style="padding-top: 5%;">
									
									<input class="btn" id="submitbtn" type="submit" name="submit">
									<input class="btn" id="resetbtn" type="reset" name="reset"> 
									<script>
										$(function () {
											$("#resetbtn").bind("click", function () {
												document.getElementsByName("allColumnsname1").selectedIndex = 0;
												document.getElementsByName("allColumnsname2").selectedIndex = 0;
												document.getElementsByName("allColumnsname3").selectedIndex = 0;
												document.getElementsByName("allColumnsname4").selectedIndex = 0;
												$('input:checkbox').prop('checked', false);
											});
										});
									</script>
								</div>
							</center>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	//Function to Retrieve Data 

	function validateMyForm() {
		const DDBox1 = document.getElementsByName("allColumnsname1")[0].value;
		const DDBox2 = document.getElementsByName("allColumnsname2")[0].value;
		const DDBox3 = document.getElementsByName("allColumnsname3")[0].value;
		const DDBox4 = document.getElementsByName("allColumnsname4")[0].value;

		if (DDBox1 == ""){
			alert("Please Pick Data at Data 1 First!");
			document.getElementsByName("allColumnsname1").selectedIndex = 0;
			document.getElementsByName("allColumnsname2").selectedIndex = 0;
			document.getElementsByName("allColumnsname3").selectedIndex = 0;
			document.getElementsByName("allColumnsname4").selectedIndex = 0;
			return false;
		} else if(DDBox1 != "" && DDBox2 == "" && (DDBox3 != "" || DDBox4 != "")){
			alert("Please Pick Data at Data 2 First!");
			document.getElementsByName("allColumnsname3").selectedIndex = 0;
			document.getElementsByName("allColumnsname4").selectedIndex = 0;
			return false;
		} else if(DDBox1 != "" && DDBox2 != "" && DDBox3 == "" && DDBox4 != ""){
			alert("Please Pick Data at Data 3 First!");
			document.getElementsByName("allColumnsname4").selectedIndex = 0;
			return false;
		}
	}

			//getData
			var obj1 = <?php echo json_encode($Data1SetlabelY ?? '', true) ?>;
			var obj2 = <?php echo json_encode($Data1SetlabelX ?? '', true) ?>;
			var obj3 = <?php echo json_encode($Data2SetlabelY ?? '', true) ?>;
			var obj4 = <?php echo json_encode($Data2SetlabelX ?? '', true) ?>;
			var obj5 = <?php echo json_encode($Data3SetlabelY ?? '', true) ?>;
			var obj6 = <?php echo json_encode($Data3SetlabelX ?? '', true) ?>;
			var obj7 = <?php echo json_encode($Data4SetlabelY ?? '', true) ?>;
			var obj8 = <?php echo json_encode($Data4SetlabelX ?? '', true) ?>;
			console.log(obj1, obj2, obj3);

			var var1 = <?php echo json_encode($var1 ?? '', true) ?>;
			var var2 = <?php echo json_encode($var2 ?? '', true) ?>;

			const graphType1 = <?php echo json_encode($checkboxLine1 ?? '', true) ?>;
			const graphType2 = <?php echo json_encode($checkboxLine2 ?? '', true) ?>;
			const graphType3 = <?php echo json_encode($checkboxLine3 ?? '', true) ?>;
			const graphType4 = <?php echo json_encode($checkboxLine4 ?? '', true) ?>;
			const graphType5 = <?php echo json_encode($checkboxLine5 ?? '', true) ?>;
			const graphType6 = <?php echo json_encode($checkboxLine6 ?? '', true) ?>;
			const graphType7 = <?php echo json_encode($checkboxLine7 ?? '', true) ?>;
			const graphType8 = <?php echo json_encode($checkboxLine8 ?? '', true) ?>;

			const xData = <?php echo json_encode($xData ?? '', true) ?>;
			const yData = <?php echo json_encode($yData ?? '', true) ?>;
			const XYData = <?php echo json_encode($XYData ?? '', true) ?>;
			const rData = <?php echo json_encode($rData ?? '', true) ?>;
			console.log(xData, yData, XYData, rData);
			
			var checkBox = document.getElementById("checkboxID").value;
			if (graphType1 == 'line'){
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
				var lineChart = new Chart(ctx, {
					type: graphType1,
                    // The data for our dataset
                    data: {
                    	labels: obj2,
                    	datasets: [{
                    		label: 'LINE GRAPH FOR ' + var1.toUpperCase(), 
                    		fill: false,
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}],
                    },
                    options: {
                    	// title: {
                    	// 	display: true,
                    	// 	text: 'LINE GRAPH FOR ' + var1.toUpperCase()
                    	// },
                    	scales: {
                    		xAxes: [{
                    			ticks: {
                    				autoSkip: false,
                    			},
                    		}],
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: function (tooltipItems, data) {
                    				var i, label = [], l = data.datasets.length;
                    				for (i = 0; i < l; i++) {
                    					IndivData =  data.datasets[i].labels[tooltipItems.index];
                    					IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    					DataPercent = (IndivDataNum * 100) / 1075;
                    					DataPercent = DataPercent.toFixed(2);
                    					label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";


                    				}
                    				return label;
                    			},
                    			title: function(tooltipItem, data){
                    				dataTitle = document.getElementById("")
                    				return "Impacts To " + var1;
                    			}
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
				var barChart = new Chart(ctx, {
					type: graphType2,
                    // The data for our dataset
                    data: {
                    	labels: obj2,
                    	datasets: [{
                    		label: 'BAR GRAPH FOR ' + var1.toUpperCase(), 
                    		fill: false,
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}],
                    },
                    options: {
                    	scales: {
                    		xAxes: [{
                    			ticks: {
                    				autoSkip: false,
                    			},
                    		}],
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: function (tooltipItems, data) {
                    				var i, label = [], l = data.datasets.length;
                    				for (i = 0; i < l; i++) {
                    					IndivData =  data.datasets[i].labels[tooltipItems.index];
                    					IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    					DataPercent = (IndivDataNum * 100) / 1075;
                    					DataPercent = DataPercent.toFixed(2);
                    					label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";
                    				}
                    				return label;
                    			},
                    			title: function(tooltipItem, data){
                    				return "Impacts To " + var1;
                    			}
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
				var barChart = new Chart(ctx, {
					type: graphType3,
                    // The data for our dataset
                    data: {
                    	labels: obj2,
                    	datasets: [{
                    		label: 'RADAR GRAPH FOR ' + var1.toUpperCase(), 
                    		// fill: true,
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}],
                    },
                    options: {
                    	tooltips: {
                    		callbacks: {
                    			label: function (tooltipItems, data) {
                    				var i, label = [], l = data.datasets.length;
                    				for (i = 0; i < l; i++) {
                    					IndivData =  data.datasets[i].labels[tooltipItems.index];
                    					IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    					DataPercent = (IndivDataNum * 100) / 1075;
                    					DataPercent = DataPercent.toFixed(2);
                    					label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";


                    				}
                    				return label;
                    			},
                    			title: function(tooltipItem, data){
                    				return "Impacts To " + var1;
                    			}
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
					return "rgb(" + r + "," + g + "," + b + ")";
				};

				for (var i in obj2) {
					coloR.push(dynamicColors());
				}
				var scatterChart = new Chart(ctx, {
					type: graphType4,
                    // The data for our dataset
                    data: {
                    	labels: obj2,
                    	datasets: [{
                    		// label: 'DOUGHNUT GRAPH FOR ' + var1.toUpperCase(), 
                    		// fill: true,
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}],
                    },
                    options: {
                    	title: {
                    		display: true,
                    		text: 'DOUGHNUT GRAPH FOR ' + var1.toUpperCase()
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: function (tooltipItems, data) {
                    				var i, label = [], l = data.datasets.length;
                    				for (i = 0; i < l; i++) {
                    					IndivData =  data.datasets[i].labels[tooltipItems.index];
                    					IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    					DataPercent = (IndivDataNum * 100) / 1075;
                    					DataPercent = DataPercent.toFixed(2);
                    					label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";


                    				}
                    				return label;
                    			},
                    			title: function(tooltipItem, data){
                    				return "Impacts To " + var1;
                    			}
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
					return "rgb(" + r + "," + g + "," + b + ")";
				};

				for (var i in obj2) {
					coloR.push(dynamicColors());
				}
				var scatterChart = new Chart(ctx, {
					type: graphType5,
                    // The data for our dataset
                    data: {
                    	labels: obj2,
                    	datasets: [{
                    		// label: 'PIE GRAPH FOR ' + var1.toUpperCase(), 
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}]
                    },
                    options: {
                    	title: {
                    		display: true,
                    		text: 'PIE GRAPH FOR ' + var1.toUpperCase()
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: function (tooltipItems, data) {
                    				var i, label = [], l = data.datasets.length;
                    				for (i = 0; i < l; i++) {
                    					IndivData =  data.datasets[i].labels[tooltipItems.index];
                    					IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    					DataPercent = (IndivDataNum * 100) / 1075;
                    					DataPercent = DataPercent.toFixed(2);
                    					label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";


                    				}
                    				return label;
                    			},
                    			title: function(tooltipItem, data){
                    				return "Impacts To " + var1;
                    			}
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
				var scatterChart = new Chart(ctx, {
					type: graphType6,
                    // The data for our dataset
                    data: {
                    	labels: obj2,
                    	datasets: [{
                    		// label: 'POLAR AREA GRAPH FOR ' + var1.toUpperCase(), 
                    		labels: obj2,
                    		backgroundColor: coloR,
                    		borderColor: coloR,
                    		data: obj1
                    	}]
                    },
                    options: {
                    	title: {
                    		display: true,
                    		text: 'POLAR AREA GRAPH FOR ' + var1.toUpperCase()
                    	},
                    	tooltips: {
                    		callbacks: {
                    			label: function (tooltipItems, data) {
                    				var i, label = [], l = data.datasets.length;
                    				for (i = 0; i < l; i++) {
                    					IndivData =  data.datasets[i].labels[tooltipItems.index];
                    					IndivDataNum = data.datasets[i].data[tooltipItems.index];
                    					DataPercent = (IndivDataNum * 100) / 1075;
                    					DataPercent = DataPercent.toFixed(2);
                    					label[i] = IndivData + ": " + IndivDataNum + " Respondent(s)." + "\n" +"Total Percentage: " + DataPercent + "%";


                    				}
                    				return label;
                    			},
                    			title: function(tooltipItem, data){
                    				return "Impacts To " + var1;
                    			}
                    		}
                    	}
                    }
                });
			} 

			if (graphType7 == 'bubble'){
				const ctx = document.getElementById('myChart').getContext('2d');
				var coloR = [];
				var dynamicColors = function() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);
					return "rgb(" + r + "," + g + "," + b + "," + 0.1 + ")";
				};

				for (var i in rData) {
					coloR.push(dynamicColors());
				}

				xCategoryVal = obj2;
				yCategoryVal = obj4;

				const data = xData.map((x, i) => {
					return {
						x: x,
						y: yData[i],
						r: rData[i],
						label: XYData[i]
					};
				});

				var myChart = new Chart(ctx, {
					type: graphType7,
					data: {
						datasets: [{
							label: 'Relationship Between ' + var1 + ' and ' + var2,
							data: data,
							backgroundColor: coloR,
						}]
					}, 
					options:{
						title: {
							display: true,
							text: 'BUBBLE GRAPH FOR ' + var1.toUpperCase() + ' AND ' + var2.toUpperCase()
						},
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
					},
					title: function(tooltipItem, data){
						return "Impacts To " + var1 +" and " + var2;
					}
				},
			}
		}
	});
			}
			if (graphType8 == 'scatter'){
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

				const data = xData.map((x, i) => {
					return {
						x: x,
						y: yData[i],
						r: rData[i],
						label: XYData[i]
					};
				});

				var myChart = new Chart(ctx, {
					type: graphType8,
					data: {
						datasets: [{
							label: 'Relationship Between ' + var1 + ' and ' + var2,
							data: data,
							backgroundColor: coloR,
						}]
					}, 
					options:{
						title: {
							display: true,
							text: 'SCATTER GRAPH FOR ' + var1.toUpperCase() + ' AND ' + var2.toUpperCase()
						},
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
					},
					title: function(tooltipItem, data){
						return "Impacts To " + var1 + " and " + var2;
					}
				},
			}
		}
	});
			}
		</script>
		@endsection