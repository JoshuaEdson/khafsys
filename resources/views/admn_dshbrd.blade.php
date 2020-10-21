@extends('layouts.main')
@section('content')

<title>IVI IIR 4.0: Dashboard</title>

<!-- Header for the dashboard. -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<h1 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">DASHBOARD</h1>


<!-- Project -->
<div class="container-fluid text-center">
    <br>   
    <div class="row">
        <div class="col-sm-6">
            <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">COUNTRY</h2>
            <!-- graph  -->
            <canvas id="myChart" style="margin-bottom: 10%;"></canvas>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var dataLabels = <?php echo json_encode($CountryName, true) ?>;
                var coloR = [];

                var dynamicColors = function() {
                    var r = Math.floor(Math.random() * 255);
                    var g = Math.floor(Math.random() * 255);
                    var b = Math.floor(Math.random() * 255);
                    return "rgb(" + r + "," + g + "," + b + ")";
                };

                for (var i in dataLabels) {
                    coloR.push(dynamicColors());
                }
                var scatterChart = new Chart(ctx, {
                    type: 'doughnut',
                    // The data for our dataset
                    data: {
                        labels: dataLabels,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR,
                            borderColor: coloR,
                            data: <?php echo json_encode($lol, true) ?>
                        }]
                    },

// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
<!-- end of graph -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">GENDER</h2>
    <!-- graph  -->
    <canvas id="myChart2"></canvas>
    <script>

        var ctx = document.getElementById('myChart2').getContext('2d');
        var dataLabels2 = <?php echo json_encode($GenderType, true) ?>;
        var coloR2 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels2) {
            coloR2.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'pie',
                    // The data for our dataset
                    data: {
                        labels: dataLabels2,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR2,
                            borderColor: coloR2,
                            data: <?php echo json_encode($CountGender, true) ?>
                        }]
                    },

// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%;margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
<!-- end of graph -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">OCCUPATION</h2>
    <!-- graph  -->
    <canvas id="myChart3" style="margin-bottom: 10%;"></canvas>
    <script>

        var ctx = document.getElementById('myChart3').getContext('2d');
        var dataLabels3 = <?php echo json_encode($OccupationType, true) ?>;
        var coloR3 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels3) {
            coloR3.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'bar',
                    // The data for our dataset
                    data: {
                        labels: dataLabels3,
                        datasets: [{
                            label: 'Occupation Data',
                            backgroundColor: coloR3,
                            borderColor: coloR3,
                            data: <?php echo json_encode($CountOccup, true) ?>
                        }]
                    },

// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
<!-- end of graph -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">INCOME GROUP</h2>
    <!-- graph  -->
    <canvas id="myChart4"></canvas>
    <script>

        var ctx = document.getElementById('myChart4').getContext('2d');
        var dataLabels4 = <?php echo json_encode($IncomeType, true) ?>;
        var coloR4 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels4) {
            coloR4.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'line',
                    // The data for our dataset
                    data: {
                        labels: dataLabels4,
                        datasets: [{
                            label: 'Income Group Data',
                            backgroundColor: coloR4,
                            borderColor: coloR4,
                            data: <?php echo json_encode($CountIncome, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%;  margin-top: 10%;margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
<!-- end of graph -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">SOCIAL MEDIA</h2>
    <!-- graph  -->
    <canvas id="myChart5"></canvas>
    <script>

        var ctx = document.getElementById('myChart5').getContext('2d');
        var dataLabels5 = <?php echo json_encode($SocialMediaType, true) ?>;
        var coloR5 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels5) {
            coloR5.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'line',
                    // The data for our dataset
                    data: {
                        labels: dataLabels5,
                        datasets: [{
                            label: 'Social Media Data',
                            backgroundColor: coloR5,
                            borderColor: coloR5,
                            data: <?php echo json_encode($CountSocialMedia, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
<!-- end of graph -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">USAGE PURPOSE</h2>
    <!-- graph  -->
    <canvas id="myChart6"></canvas>
    <script>

        var ctx = document.getElementById('myChart6').getContext('2d');
        var dataLabels6 = <?php echo json_encode($UsageType, true) ?>;
        var coloR6 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels6) {
            coloR6.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'bar',
                    // The data for our dataset
                    data: {
                        labels: dataLabels6,
                        datasets: [{
                            label: 'Usage Purpose',
                            backgroundColor: coloR6,
                            borderColor: coloR6,
                            data: <?php echo json_encode($CountUsage, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%;  margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>

<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">PROBLEM OCCURS</h2>
    <!-- graph  -->
    <canvas id="myChart7"></canvas>
    <script>

        var ctx = document.getElementById('myChart7').getContext('2d');
        var dataLabels7 = <?php echo json_encode($ProblemType, true) ?>;
        var coloR7 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels7) {
            coloR7.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'pie',
                    // The data for our dataset
                    data: {
                        labels: dataLabels7,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR7,
                            borderColor: coloR7,
                            data: <?php echo json_encode($CountProblem, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">COST INCREAMENTS</h2>
    <!-- graph  -->
    <canvas id="myChart8"></canvas>
    <script>

        var ctx = document.getElementById('myChart8').getContext('2d');
        var dataLabels8 = <?php echo json_encode($CostType, true) ?>;
        var coloR8 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels8) {
            coloR8.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'bar',
                    // The data for our dataset
                    data: {
                        labels: dataLabels8,
                        datasets: [{
                            label: 'Cost Increaments',
                            backgroundColor: coloR8,
                            borderColor: coloR8,
                            data: <?php echo json_encode($CountCost, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">PSYCHOLOGICAL PROBLEMS</h2>
    <!-- graph  -->
    <canvas id="myChart9"></canvas>
    <script>

        var ctx = document.getElementById('myChart9').getContext('2d');
        var dataLabels9 = <?php echo json_encode($PsychologicalType, true) ?>;
        var coloR9 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels9) {
            coloR9.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'bar',
                    // The data for our dataset
                    data: {
                        labels: dataLabels9,
                        datasets: [{
                            label: 'Psychological Problems Occur',
                            backgroundColor: coloR9,
                            borderColor: coloR9,
                            data: <?php echo json_encode($CountPsychological, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">ABUSED</h2>
    <!-- graph  -->
    <canvas id="myChart10"></canvas>
    <script>

        var ctx = document.getElementById('myChart10').getContext('2d');
        var dataLabels10 = <?php echo json_encode($AbusedType, true) ?>;
        var coloR10 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels10) {
            coloR10.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'pie',
                    // The data for our dataset
                    data: {
                        labels: dataLabels10,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR10,
                            borderColor: coloR10,
                            data: <?php echo json_encode($CountAbused, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">SPREAD FAKE NEWS</h2>
    <!-- graph  -->
    <canvas id="myChart11"></canvas>
    <script>

        var ctx = document.getElementById('myChart11').getContext('2d');
        var dataLabels11 = <?php echo json_encode($SFNType, true) ?>;
        var coloR11 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels11) {
            coloR11.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'pie',
                    // The data for our dataset
                    data: {
                        labels: dataLabels11,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR11,
                            borderColor: coloR11,
                            data: <?php echo json_encode($CountSFN, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">BELIEVE FAKE NEWS</h2>
    <!-- graph  -->
    <canvas id="myChart12"></canvas>
    <script>

        var ctx = document.getElementById('myChart12').getContext('2d');
        var dataLabels12 = <?php echo json_encode($BFNType, true) ?>;
        var coloR12 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels12) {
            coloR12.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'pie',
                    // The data for our dataset
                    data: {
                        labels: dataLabels12,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR12,
                            borderColor: coloR12,
                            data: <?php echo json_encode($CountBFN, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>
<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
</div>
<div class="col-sm-6">
    <h2 style="font-weight: bold;text-align: center; color: rgb(0,0,150);">RELATIONSHIP RATE</h2>
    <!-- graph  -->
    <canvas id="myChart13"></canvas>
    <script>

        var ctx = document.getElementById('myChart13').getContext('2d');
        var dataLabels13 = <?php echo json_encode($RRType, true) ?>;
        var coloR13 = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        for (var i in dataLabels13) {
            coloR13.push(dynamicColors());
        }
        var scatterChart = new Chart(ctx, {
            type: 'pie',
                    // The data for our dataset
                    data: {
                        labels: dataLabels13,
                        datasets: [{
                            label: 'Testing Luk',
                            backgroundColor: coloR13,
                            borderColor: coloR13,
                            data: <?php echo json_encode($CountRR, true) ?>
                        }]
                    },
// Configuration options go here
options: {}
});
</script>

<!-- <center>
<button name="View"  type="button" id="viewbtn" style="width: 20%; margin-top: 10%; margin-bottom: 3%;">View</button>
<button name="Download"  type="button" id="dwlndbtn" style="width: 20%;">Download</button>
</center> -->
<!-- end of graph -->
</div>
</div>
</div>
@endsection