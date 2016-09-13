<?php 
    //importation des fichiers de fonctions
    require 'database_connection.php';

    define("DATABASE_IP", "192.168.32.79");
    define("USER", "admin");
    define("PASWORD", "admin");


    // define("DATABASE_IP", "localhost");
    // define("USER", "root");
    // define("PASWORD", "");
    define("DATABASE_NAME", "smartwindows");

    $selected_day = date("Y-m-d");

    $db = database_open(DATABASE_IP, USER, PASWORD, DATABASE_NAME);
    $data_array = day_data_select($db, $selected_day);

    $temp_int_array = [];
    $luminosity_array = [];
    $temp_ext_array = [];
    $date_array = [];
    $time_array = [];
    for ($i=0; $i < count($data_array); $i++) { 
        $temp_int_array[$i] = $data_array[$i]["temp_int"];
        $luminosity_array[$i] = $data_array[$i]["luminosity"];
        $temp_ext_array[$i] = $data_array[$i]["temp_ext"];
        $date_array[$i] = $data_array[$i]["date"] ." à " . $data_array[$i]["time"];
    }
    database_close($db);
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test Chart.js Raed</title>
        <script type="text/javascript" src="Chart.bundle.js"></script>
        <script type="text/javascript" src="used_function.js"></script>
    </head>
    <body>
    	<h1><?php echo "Affichage par jour : Le " . date("d-m-Y"); ?></h1>
    	<table>
    		<tr>
    			<td>
		        	<canvas id="myChart" width="500" height="400"></canvas>
		        </td>
		        <td>
		        	<canvas id="myChart2" width="500" height="400"></canvas>
		        </td>
    		</tr>
        </table>
        <script>
        var data = {
            labels: <?php echo '["' . implode('", "', $date_array) . '"]' ?>,
            datasets: [
                {
                    label: "Température interne",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(75,192,0,0.4)",
                    borderColor: "rgba(75,192,0,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderWidth: 2,
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,0,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,0,1)",
                    pointHoverBorderColor: "black",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: <?php echo '["' . implode('", "', $temp_int_array) . '"]' ?>,
                    spanGaps: false,
                },
                {
                	label: "Température externe",
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(255,0,192,0.4)",
                    borderColor: "rgba(255,0,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderWidth: 2,
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(255,0,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(255,0,192,1)",
                    pointHoverBorderColor: "black",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: <?php echo '["' . implode('", "', $temp_ext_array) . '"]' ?>,
                    spanGaps: false,
                }
            ]
        };
        // var data2 = {
        //     labels: <?php echo '["' . implode('", "', $date_array) . '"]' ?>,
        //     datasets: [
        //         {
        //         	label: "Luminosité",
        //             fill: false,
        //             lineTension: 0,
        //             backgroundColor: "rgba(75,192,192,0.4)",
        //             borderColor: "rgba(75,192,192,1)",
        //             borderCapStyle: 'butt',
        //             borderDash: [],
        //             borderWidth: 2,
        //             borderDashOffset: 0.0,
        //             borderJoinStyle: 'miter',
        //             pointBorderColor: "rgba(75,192,192,1)",
        //             pointBackgroundColor: "#fff",
        //             pointBorderWidth: 5,
        //             pointHoverRadius: 5,
        //             pointHoverBackgroundColor: "rgba(75,192,192,1)",
        //             pointHoverBorderColor: "black",
        //             pointHoverBorderWidth: 2,
        //             pointRadius: 1,
        //             pointHitRadius: 10,
        //             data: <?php echo '["' . implode('", "', $luminosity_array) . '"]' ?>,
        //             spanGaps: false,
        //         }
        //     ]
        // };
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        },
                    }]
                },
                responsive:false
            }
        });
        // var ctx2 = document.getElementById("myChart2");
        // var myChart2 = new Chart(ctx2, {
        //     type: 'line',
        //     data: data2,
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     beginAtZero:true
        //                 }
        //             }]
        //         },
        //         responsive:false
        //     }
        // });
        var labels = <?php echo '["' . implode('", "', $date_array) . '"]' ?>;
        var displayed_data = <?php echo '["' . implode('", "', $luminosity_array) . '"]' ?>;
        array_data_day(labels, displayed_data);
        </script>
    </body>
</html>