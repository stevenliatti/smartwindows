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
    $selected_month = substr($selected_date, 0,7);
    $selected_year = substr($selected_date, 0, 4);

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
    if (isset($_GET['selected_month'])){
    	$selected_month = substr($_GET['selected_month'], 0,7);
    }
    if (isset($_GET['selected_year'])){
    	$selected_year = $_GET['selected_year'];
    }

    $db = database_open(DATABASE_IP, USER, PASWORD, DATABASE_NAME);
    //function day_data_select($conn, $day_begin, $time_begin = "00:00:00", $day_end = "", $time_end = "23:59:59")
    echo "<br> $selected_chart <br> $selected_date <br> $selected_min_date <br> $selected_min_time <br> $selected_max_date <br> $selected_max_time<br>";
    
    $temp_int_array = [];
    $luminosity_array = [];
    $temp_ext_array = [];
    $wind_array = [];
    $date_array = [];

    $temp_int_moy = [];
    $temp_int_min = [];
    $temp_int_max = [];
    $lum_moy = [];
    $lum_min = [];
    $lum_max = [];
    $temp_ext_moy = [];
    $temp_ext_min = [];
    $temp_ext_max = [];
    $wind_moy = [];
    $wind_min = [];
    $wind_max = [];
    switch ($selected_chart) {
    	case "day_time": 
    		$data_array = day_data_select($db, $selected_min_date, $selected_min_time, $selected_max_date, $selected_max_time);

		    for ($i=0; $i < count($data_array); $i++) { 
		        $temp_int_array[$i] = $data_array[$i]["temp_int"];
		        $luminosity_array[$i] = $data_array[$i]["luminosity"];
		        $temp_ext_array[$i] = $data_array[$i]["temp_ext"];
		        $wind_array[$i] = $data_array[$i]["wind_speed"];
		        $date_array[$i] = $data_array[$i]["date"] . " à " . $data_array[$i]["time"];
    }
    		break;
    	case "month":
    		$data_array = month_data_select($db, substr($selected_month, 5, 2), $selected_year);
    		for ($i=0; $i < count($data_array); $i++) { 
		        $temp_int_moy[$i] = $data_array[$i]["avg_temp_int"];
		        $temp_int_min[$i] = $data_array[$i]["min_temp_int"];
		        $temp_int_max[$i] = $data_array[$i]["max_temp_int"];
		        $lum_moy[$i] = $data_array[$i]["avg_lum"];
		        $lum_min[$i] = $data_array[$i]["min_lum"];
		        $lum_max[$i] = $data_array[$i]["max_lum"];
		        $temp_ext_moy[$i] = $data_array[$i]["avg_temp_ext"];
		        $temp_ext_min[$i] = $data_array[$i]["min_temp_ext"];
		        $temp_ext_max[$i] = $data_array[$i]["max_temp_ext"];
		        $wind_moy[$i] = $data_array[$i]["avg_wind_speed"];
		        $wind_min[$i] = $data_array[$i]["min_wind_speed"];
		        $wind_max[$i] = $data_array[$i]["max_wind_speed"];
		        $date_array[$i] = "Le " . substr($data_array[$i]["date"], 8,2);
		    }
    		break;
    	case "year":
    		# code...
    		break;
    	default:
    		$data_array = day_data_select($db, $selected_date);

		    for ($i=0; $i < count($data_array); $i++) { 
		        $temp_int_array[$i] = $data_array[$i]["temp_int"];
		        $luminosity_array[$i] = $data_array[$i]["luminosity"];
		        $temp_ext_array[$i] = $data_array[$i]["temp_ext"];
		        $wind_array[$i] = $data_array[$i]["wind_speed"];
		        $date_array[$i] = substr($data_array[$i]["time"], 0, 5);
    		}
    		break;
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
			</select><br>
			<span id="selected_date" style="display: <?php if($selected_chart != 'day'){echo("none");}?>;">
				Choisissez le jour : 
				<input name="selected_date" type="date" value="<?php echo $selected_date; ?>"></input><br>
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
			<span id="selected_month" style="display: <?php if($selected_chart != 'month'){echo("none");}?>;">
				Choisissez le mois : 
				<input name="selected_month" type="month" value="<?php echo $selected_month; ?>"></input><br>
			</span>
			<br>
			<input type="submit" value="Choisir">
		</form>
		<?php
		if ($selected_chart == "day" or $selected_chart == "day_time")
		{
		?>
	    	<table>
	    		<tr>
	    			<td>
			        	<canvas id="temperature_day" width="500" height="400"></canvas>
			        </td>
			        <td>
			        	<canvas id="luminosity_day" width="500" height="400"></canvas>
			        </td>
	    		</tr>
	    		<tr>
	    			<td calspan="2">
	    				<canvas id="wind_day" width="500" height="400"></canvas>
	    			</td>
	    		</tr>
	        </table>
	        <script>
		        var labels = <?php echo '["' . implode('", "', $date_array) . '"]' ?>;

		       	var temperature_ctx = document.getElementById("temperature_day");
		        var temp_int_data = <?php echo '["' . implode('", "', $temp_int_array) . '"]' ?>;
		        var temp_ext_data = <?php echo '["' . implode('", "', $temp_ext_array) . '"]' ?>;
		        display_day(temperature_ctx, "Température", labels, "Température interne en degré", temp_int_data,"255, 102, 0", "Température externe en degré",  temp_ext_data, "75,192,192");

		        var luminosity_ctx = document.getElementById("luminosity_day");
		        var luminosity_data = <?php echo '["' . implode('", "', $luminosity_array) . '"]' ?>;
		        display_day(luminosity_ctx, "Luminosité", labels, "Luminosité en Lux", luminosity_data, "102, 191, 100");

		        var wind_ctx = document.getElementById("wind_day");
		        var wind_data = <?php echo '["' . implode('", "', $wind_array) . '"]' ?>;
		        display_day(wind_ctx, "Vitesse du vent", labels, "Vitesse du vent en m/s", wind_data, "102, 0, 255");
	        </script>
	    <?php
		}
	    else
	    {
	    ?>
	    	<table>
	    		<tr>
	    			<td>
			        	<canvas id="temperature_in_month" width="500" height="400"></canvas>
			        </td>
	    			<td>
			        	<canvas id="temperature_out_month" width="500" height="400"></canvas>
			        </td>
	    		</tr>
	    		<tr>
			        <td>
			        	<canvas id="luminosity_month" width="500" height="400"></canvas>
			        </td>
	    			<td calspan="2">
	    				<canvas id="wind_month" width="500" height="400"></canvas>
	    			</td>
	    		</tr>
	        </table>
	        <script>
		        var labels = <?php echo '["' . implode('", "', $date_array) . '"]' ?>;

		       	var temperature_in_ctx = document.getElementById("temperature_in_month");

		        var temp_int_moy = <?php echo '["' . implode('", "', $temp_int_moy) . '"]' ?>;
		        var temp_int_min = <?php echo '["' . implode('", "', $temp_int_min) . '"]' ?>;
		        var temp_int_max = <?php echo '["' . implode('", "', $temp_int_max) . '"]' ?>;

		        display_month(temperature_in_ctx, "Température interne en degré", labels,
		        	temp_int_moy,
		        	temp_int_min,
		        	temp_int_max);

		       	var temperature_out_ctx = document.getElementById("temperature_out_month");

		        var temp_ext_moy = <?php echo '["' . implode('", "', $temp_ext_moy) . '"]' ?>;
		        var temp_ext_min = <?php echo '["' . implode('", "', $temp_ext_min) . '"]' ?>;
		        var temp_ext_max = <?php echo '["' . implode('", "', $temp_ext_max) . '"]' ?>;

		        display_month(temperature_out_ctx, "Température externe en degré", labels,
		        	temp_ext_moy,
		        	temp_ext_min,
		        	temp_ext_max);

		        var luminosity_ctx = document.getElementById("luminosity_month");

		        var lum_moy = <?php echo '["' . implode('", "', $lum_moy) . '"]' ?>;
		        var lum_min = <?php echo '["' . implode('", "', $lum_min) . '"]' ?>;
		        var lum_max = <?php echo '["' . implode('", "', $lum_max) . '"]' ?>;

		        display_month(luminosity_ctx, "Luminosité en Lux", labels,
		        	lum_moy,
		        	lum_min,
		        	lum_max);

				var wind_ctx = document.getElementById("wind_month");

		        var wind_moy = <?php echo '["' . implode('", "', $wind_moy) . '"]' ?>;
		        var wind_min = <?php echo '["' . implode('", "', $wind_min) . '"]' ?>;
		        var wind_max = <?php echo '["' . implode('", "', $wind_max) . '"]' ?>;

		        display_month(wind_ctx, "Vitesse du vent en m/s", labels,
		        	wind_moy,
		        	wind_min,
		        	wind_max,
		        	0, 30);
		        // display_day(temperature_ctx, labels, "Température interne en degré", temp_int_data,"255, 102, 0", "Température externe en degré",  temp_ext_data, "75,192,192");

		        // var luminosity_ctx = document.getElementById("luminosity_month");
		        // var luminosity_data = <?php echo '["' . implode('", "', $luminosity_array) . '"]' ?>;
		        // display_day(luminosity_ctx, labels, "Luminosité en Lux", luminosity_data, "102, 191, 100");

		        // var wind_ctx = document.getElementById("wind_month");
		        // var wind_data = <?php echo '["' . implode('", "', $wind_array) . '"]' ?>;
		        // display_day(wind_ctx, labels, "Vitesse du vent en m/s", wind_data, "102, 0, 255");
	        </script>
	    <?php
	    }
	    ?>
    </body>
</html>