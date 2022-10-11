<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                @include('admin.body')
                <!-- partial:partials/_footer.html -->
                @include('admin.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
    <script type="text/javascript">
        var analytics = <?php echo $chart1 ?>;
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                title: 'Best Seller (Quantity)',
                titleTextStyle: {
                    color: 'white',
                    fontSize: 20,
                },
                backgroundColor: '#191c24',
                legend: {textStyle: {color: 'white'}}
            };
            var chart = new google.visualization.PieChart(document.getElementById('board1'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        var analytics2 = <?php echo $chart2 ?>;
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics2);
            var options = {
                title: 'Product Quantity',
                titleTextStyle: {
                    color: 'white',
                    fontSize: 20,
                },
                backgroundColor: '#191c24',
                legend: {textStyle: {color: 'white'}}
            };
            var chart = new google.visualization.PieChart(document.getElementById('board2'));
            chart.draw(data, options);
        }
    </script>
</body>

</html>
