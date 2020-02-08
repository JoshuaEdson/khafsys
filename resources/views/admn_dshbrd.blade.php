@extends('layouts.main')
@section('content')
<title>Khaf Beaute Legacy: Dashboard</title>

<!-- Header for the dashboard. -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<h1 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">DASHBOARD</h1>

<!-- Project -->
<div class="container-fluid text-center">
	<br>   
	<div class="row">
		<div class="col-sm-6">
			<h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">DAILY SALES</h2>
			<!-- graph  -->
			<canvas id="myChart" style="margin-bottom: 10%;"></canvas>
			<script>

				var ctx = document.getElementById('myChart').getContext('2d');
				var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    	datasets: [{
    		label: 'My First dataset',
    		backgroundColor: 'rgb(255, 99, 132)',
    		borderColor: 'rgb(255, 99, 132)',
    		data: [0, 10, 5, 2, 20, 30, 45]
    	}]
    },

    // Configuration options go here
    options: {}
});
</script>
<!-- end of graph -->
</div>
<div class="col-sm-6">
	<h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">EMPLOYEE DAILY PERFORMANCE</h2>
				<!-- graph  -->
			<canvas id="myChart2"></canvas>
			<script>

				var ctx = document.getElementById('myChart2').getContext('2d');
				var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    	datasets: [{
    		label: 'My First dataset',
    		backgroundColor: 'rgb(255, 99, 132)',
    		borderColor: 'rgb(255, 99, 132)',
    		data: [0, 10, 5, 2, 20, 30, 45]
    	}]
    },

    // Configuration options go here
    options: {}
});
</script>
<!-- end of graph -->
</div>
<div class="col-sm-6">
	<h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">WEEKLY SALES</h2>
				<!-- graph  -->
			<canvas id="myChart3" style="margin-bottom: 10%;"></canvas>
			<script>

				var ctx = document.getElementById('myChart3').getContext('2d');
				var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    	datasets: [{
    		label: 'My First dataset',
    		backgroundColor: 'rgb(255, 99, 132)',
    		borderColor: 'rgb(255, 99, 132)',
    		data: [3, 15, 15, 25, 20, 25, 35]
    	}]
    },

    // Configuration options go here
    options: {}
});
</script>
<!-- end of graph -->
</div>
<div class="col-sm-6">
	<h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">EMPLOYEE WEEKLY PERFORMANCE</h2>
				<!-- graph  -->
			<canvas id="myChart4"></canvas>
			<script>

				var ctx = document.getElementById('myChart4').getContext('2d');
				var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    	datasets: [{
    		label: 'My First dataset',
    		backgroundColor: 'rgb(255, 99, 132)',
    		borderColor: 'rgb(255, 99, 132)',
    		data: [0, 10, 5, 2, 20, 30, 45]
    	}]
    },

    // Configuration options go here
    options: {}
});
</script>
<!-- end of graph -->
</div>
<div class="col-sm-6">
	<h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">MONTHLY SALES</h2>
				<!-- graph  -->
			<canvas id="myChart5"></canvas>
			<script>

				var ctx = document.getElementById('myChart5').getContext('2d');
				var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    	datasets: [{
    		label: 'My First dataset',
    		backgroundColor: 'rgb(255, 99, 132)',
    		borderColor: 'rgb(255, 99, 132)',
    		data: [3, 15, 15, 25, 20, 25, 35]
    	}]
    },

    // Configuration options go here
    options: {}
});
</script>
<!-- end of graph -->
</div>
<div class="col-sm-6">
	<h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">EMPLOYEE MONTHLY PERFORMANCE</h2>
				<!-- graph  -->
			<canvas id="myChart6"></canvas>
			<script>

				var ctx = document.getElementById('myChart6').getContext('2d');
				var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
    	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    	datasets: [{
    		label: 'My First dataset',
    		backgroundColor: 'rgb(255, 99, 132)',
    		borderColor: 'rgb(255, 99, 132)',
    		data: [0, 10, 5, 2, 20, 30, 45]
    	}]
    },

    // Configuration options go here
    options: {}
});
</script>
<!-- end of graph -->
</div>
</div>
</div>


@endsection