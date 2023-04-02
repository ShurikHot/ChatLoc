<?php

    require_once '../app/config/db.php';
    $query = mysqli_query($connect, "SELECT DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as hour, COUNT(`id`) as count FROM members GROUP BY hour");
    $data = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $datetime = "new Date(" . date('Y, n-1, j, G, i, s', strtotime($row['hour'])) . ")";
        $data[] = array(
            $datetime,
            intval($row['count'])
        );
    }
    $data_json = json_encode($data);
    $data_json = str_replace('"','',$data_json);
?>

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
        data.addRows(<?= $data_json; ?>);
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


