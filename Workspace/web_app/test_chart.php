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

    $selected_chart = "day";
    $selected_date = date("Y-m-d");
    $selected_min_time = "00:00";
    $selected_min_date = date("Y-m-d");
    $selected_max_time = "23:59";
    $selected_max_date = date("Y-m-d");

    if (isset($_GET['selected_chart'])){
    	$selected_chart = $_GET['selected_chart'];
    }
    if (isset($_GET['selected_date'])){
    	$selected_date = $_GET['selected_date'];
    }
    if (isset($_GET['selected_min_date'])){
    	$selected_min_date = $_GET['selected_min_date'];
    }
    if (isset($_GET['selected_min_time'])){
    	$selected_min_time = $_GET['selected_min_time'];
    }
    if (isset($_GET['selected_max_date'])){
    	$selected_max_date = $_GET['selected_max_date'];
    }
    if (isset($_GET['selected_max_time'])){
    	$selected_max_time = $_GET['selected_max_time'];
    }

    $db = database_open(DATABASE_IP, USER, PASWORD, DATABASE_NAME);
    //function day_data_select($conn, $day_begin, $time_begin = "00:00:00", $day_end = "", $time_end = "23:59:59")
    echo "<br> $selected_chart <br> $selected_date <br> $selected_min_date <br> $selected_min_time <br> $selected_max_date <br> $selected_max_time<br>";
    switch ($selected_chart) {
    	case "day_time": 
    		$data_array = day_data_select($db, $selected_min_date, $selected_min_time, $selected_max_date, $selected_max_time);
    		break;
    	
    	default:
    		$data_array = day_data_select($db, $selected_date);
    		break;
    }

    $temp_int_array = [];
    $luminosity_array = [];
    $temp_ext_array = [];
    $wind_array = [];
    $date_array = [];
    $time_array = [];
    for ($i=0; $i < count($data_array); $i++) { 
        $temp_int_array[$i] = $data_array[$i]["temp_int"];
        $luminosity_array[$i] = $data_array[$i]["luminosity"];
        $temp_ext_array[$i] = $data_array[$i]["temp_ext"];
        $wind_array[$i] = $data_array[$i]["wind_speed"];
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
    	<a href="test_chart.php">home</a>
    	<h1><?php echo "Affichage par jour : Le " . $selected_date ?></h1>
	   	<form action="" method="get">
	   		Affichage par : 
			<select name="selected_chart" onchange="change_content(this.value);">
				<option value="day" <?php if($selected_chart == 'day'){echo("selected");}?>>jour</option>
				<option value="day_time" <?php if($selected_chart == 'day_time'){echo("selected");}?>>tranche horaire</option>
				<option value="month" <?php if($selected_chart == 'month'){echo("selected");}?>>mois</option>
				<option value="year" <?php if($selected_chart == 'year'){echo("selected");}?>>année</option>
			</select><br>
			<span id="selected_date" style="display: <?php if($selected_chart != 'day'){echo("none");}?>;">
				Choisissez le jour : 
				<input name="selected_date" type="date" value="<?php echo $selected_date; ?>"></input>
			</span>
			<span id="selected_min_max_date" style="display: <?php if($selected_chart != 'day_time'){echo("none");}?>;">
				Choisissez la date de début : 
				<input name="selected_min_date" type="date" value="<?php echo $selected_min_date; ?>"></input>
				à : 
				<input name="selected_min_time" type="time" value="<?php echo $selected_min_time; ?>"></input><br>
				Choisissez la date de fin : 
				<input name="selected_max_date" type="date" value="<?php echo $selected_max_date; ?>"></input>
				à : 
				<input name="selected_max_time" type="time" value="<?php echo $selected_max_time; ?>"></input><br>
			</span>
			<br>
			<input type="submit" value="Choisir">
		</form>
    	<table>
    		<tr>
    			<td>
		        	<canvas id="temperature" width="500" height="400"></canvas>
		        </td>
		        <td>
		        	<canvas id="luminosity" width="500" height="400"></canvas>
		        </td>
    		</tr>
    		<tr>
    			<td calspan="2">
    				<canvas id="wind" width="500" height="400"></canvas>
    			</td>
    		</tr>
        </table>
        <script>
	        var labels = <?php echo '["' . implode('", "', $date_array) . '"]' ?>;

	       	var temperature_ctx = document.getElementById("temperature");
	        var temp_int_data = <?php echo '["' . implode('", "', $temp_int_array) . '"]' ?>;
	        var temp_ext_data = <?php echo '["' . implode('", "', $temp_ext_array) . '"]' ?>;
	        display_day(temperature_ctx, labels, "Température interne en degré", temp_int_data,"255, 102, 0", "Température externe en degré",  temp_ext_data, "75,192,192");

	        var luminosity_ctx = document.getElementById("luminosity");
	        var luminosity_data = <?php echo '["' . implode('", "', $luminosity_array) . '"]' ?>;
	        display_day(luminosity_ctx, labels, "Luminosité en Lux", luminosity_data, "102, 191, 100");

	        var wind_ctx = document.getElementById("wind");
	        var wind_data = <?php echo '["' . implode('", "', $wind_array) . '"]' ?>;
	        display_day(wind_ctx, labels, "Vitesse du vent en m/s", wind_data, "102, 0, 255");
        </script>
    </body>
</html>