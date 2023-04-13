<style>
    #content {
        height: 600px;
        width: 100vh;
    }
</style>

<script>
    google.charts.load('current', {'packages':['annotationchart']});
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('datetime', 'Date');
        data.addColumn('number', 'Count');
        data.addRows(<?= $data; ?>);
        var options = {
            title: 'Count of new Members',
            displayAnnotations: false,
            min: 0
        };
        var chart = new google.visualization.AnnotationChart(document.getElementById('content'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart);
</script>


