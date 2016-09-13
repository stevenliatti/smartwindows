<?php 
    //importation des fichiers de fonctions
    require 'database_connection.php';

    // define("DATABASE_IP", "192.168.32.79");
    // define("USER", "admin");
    // define("PASWORD", "admin");


    define("DATABASE_IP", "localhost");
    define("USER", "root");
    define("PASWORD", "");
    define("DATABASE_NAME", "smartwindows");

    $selected_chart = "day";
    $selected_date = date("Y-m-d");
    $selected_time = "00:00";
    if (isset($_GET['selected_chart']) AND isset($_GET['selected_date']) AND isset($_GET['selected_time'])){

    }

    $db = database_open(DATABASE_IP, USER, PASWORD, DATABASE_NAME);
    $data_array = day_data_select($db, $selected_date);

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
    	<h1><?php echo "Affichage par jour : Le " . date("d-m-Y"); ?></h1>
	   	<form action="" method="get">
	   		Affichage par : 
			<select name="selected_chart" onchange="add_content(this.value);">
				<option value="day">jour</option>
				<option value="day_time">tranche horaire</option>
				<option value="month">mois</option>
				<option value="year">année</option>
			</select><br>
			<span id="selected_min_date">
				Choisissez la date de début : 
				<input name="selected_min_date" type="date"></input>
			</span>
			<span id="selected_min_time">
				à : 
				<input name="selected_min_time" type="time" style="display:none;"></input><br>
			</span>
			<span id="selected_max_date">
				Choisissez la date de début : 
				<input name="selected_max_date" type="date"></input>
			</span>
			<span id="selected_max_time">
				à : 
				<input name="selected_max_time" type="time" style="display:none;"></input><br>
			</span>
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