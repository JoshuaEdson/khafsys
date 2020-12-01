@extends('layouts.main')
@section('content')

<title>IVI IIR 4.0: Dashboard</title>

<!-- Header for the dashboard. -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<h1 style="text-align: center; color: rgb(0,0,150); margin: 2%;">DATA ANALYTICS TOOL</h1>
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
<style>
    canvas{
        /*margin: 0.1%;*/
        margin-bottom: 10%;
    }
</style>
<form action="{{ route('analysis.getAdminDashboardData', $tablename)}}" method="post">
    @csrf
    <div  style=" padding-left: 2%; text-align: center;">
        <label for="tableUsed">Datasets:</label>
        <select class="combobox col-sm-2" name="tableList" id="tableUsed" style="width:250px; height: 35px; ">
            <option value="No Datasets Selected" selected>Select</option>
            @foreach($tables as $table)
            <option value="{{ $table }}" {{ ( $table == $tablename) ? 'selected' : '' }}> 
            {{ $table }} </option>
            @endforeach
        </select>
        <button  name="dataTable" id="submit" type="submit" value="Go">Change</button>
    </div>


    <!-- Project -->
    <div class="col-sm-12 text-center" style="padding-top: 3%;">
        <br>   
        <div class="row">
            <?php 
            foreach ($allColumnsNew as $acn=> $value) { ?>
                <div class="col-sm-6">
                    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">{{$value}}</h2>
                    <canvas id="myChart{{$acn}}"></canvas>                    
                </div>            
            <?php }?>
        </div>
    </div>
</form>
<script>
    var chartType = ['pie', 'line', 'doughnut', 'radar', 'bar', 'pie', 'line', 'doughnut', 'radar', 'bar', 'pie', 'line', 'doughnut', 'radar', 'bar'];
    <?php foreach ($allColumnsNew as $acn=> $value) { ?>
        var ctx = document.getElementById('myChart{{$acn}}').getContext('2d');
        var allData = <?php echo json_encode($allDataBody[$acn], true) ?>;
        var dataColor = [];
        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in allData) {
            dataColor.push(dynamicColors());
        }

        var newCharts{{$acn}} = new Chart(ctx, {
            type: chartType[{{$acn}}],
            data: {
                labels: allData,
                datasets: [{
                    label: 'Current Data: {{$value}}',
                    backgroundColor: dataColor,
                    Color: dataColor,
                    data: <?php echo json_encode($allDataCount[$acn], true) ?>
                }]
            },
            options: {}
        });
    <?php } ?>
</script>
@endsection