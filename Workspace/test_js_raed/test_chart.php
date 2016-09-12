<?php 
    //importation des fichiers de fonctions
    require 'database_connection.php';

    // define("DATABASE_IP", "192.168.32.79");
    // define("USER", "root");
    // define("PASWORD", "smartwindows");


    define("DATABASE_IP", "localhost");
    define("USER", "root");
    define("PASWORD", "");
    define("DATABASE_NAME", "smartwindows");

    $db = database_open(DATABASE_IP, USER, PASWORD, DATABASE_NAME);
    $data_array = data_select($db);

    $temp_int_array = [];
    $date_array = [];
    $time_array = [];
    for ($i=0; $i < count($data_array); $i++) { 
        $temp_int_array[$i] = $data_array[$i]["temp_int"];
        $date_array[$i] = $data_array[$i]["date"] ." à " . $data_array[$i]["time"];
    }
    echo json_encode($data_array);
    database_close($db);
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test Chart.js Raed</title>
        <script type="text/javascript" src="Chart.bundle.js"></script>
    </head>
    <body>
        <canvas id="myChart" width="1000" height="400"></canvas>
        <script>
        var db_data = <?php echo json_encode($data_array) ?>;
        var data = {
            labels: <?php echo '["' . implode('", "', $date_array) . '"]' ?>,
            datasets: [
                {
                    label: "Température interne",
                    fill: true,
                    lineTension: 0,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderWidth: 2,
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: <?php echo '["' . implode('", "', $temp_int_array) . '"]' ?>,
                    spanGaps: false,
                }
            ]
        };
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                responsive:false
            }
        });
        </script>
    </body>
</html>