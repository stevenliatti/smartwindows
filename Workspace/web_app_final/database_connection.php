<?php
	//Ouverture de la connexion à la base de données
	function database_open($adress, $user_name, $user_password, $database_name){
		$conn = new mysqli($adress, $user_name, $user_password, $database_name);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		return $conn;
	}
	
	//Fermeture de la connexion à la base de données
	function database_close($conn){
		mysqli_close($conn);
	}

	//selection des données par jour
	function day_data_select($conn, $day_begin, $time_begin = "00:00:00", $day_end = "", $time_end = "23:59:59")
	{
		if ($day_end == "")
			$day_end = $day_begin;
		echo "<h3>dans la fonction SELECT : <br> $day_begin<br> $time_begin<br> $day_end<br> $time_end";

		$sql = "SELECT * FROM data WHERE date >= '".$day_begin."' AND date <= '".$day_end."' AND time >= '".$time_begin."' AND time <= '".$time_end."' ORDER BY date DESC, time DESC";
		$result = $conn->query($sql);
		
		$array = [];
		if ($result->num_rows > 0) {
			// output data of each row
			$i = 0;
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			   $array[$i] = $row;
			   $i++;
			}
			return $array;
		} else {
			echo "<br>0 results";
			return null;
		}
	}

	//selection des données par mois : affichage de la moyenne, le min et le max de chaque jour
	function month_data_select($conn, $month, $year)
	{
		$sql = "SELECT date, AVG(temp_int) AS 'avg_temp_int', MAX(temp_int) AS 'max_temp_int',
				MIN(temp_int) AS 'min_temp_int', AVG(luminosity) AS 'avg_lum', MAX(luminosity) AS 'max_lum',
				MIN(luminosity) AS 'min_lum', AVG(temp_ext) AS 'avg_temp_ext', MAX(temp_ext) AS 'max_temp_ext',
				MIN(temp_ext) AS 'min_temp_ext', AVG(wind_speed) AS 'avg_wind_speed',
				MAX(wind_speed) AS 'max_wind_speed', MIN(wind_speed) AS 'min_wind_speed'
				FROM data
				WHERE MONTH(date) = '".$month."' AND YEAR(date) = '".$year."'
				GROUP BY date";
		$result = $conn->query($sql);

		$array = [];
		if ($result->num_rows > 0) {
			$i = 0;
			while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			   $array[$i] = $row;
			   $i++;
			}
			return $array;
		} else {
			echo "<br>0 results";
			return null;
		}
	}

	//Sélection de la configuration utilisateur
	function get_config($conn) {
		$sql = "SELECT * FROM state ORDER BY id DESC LIMIT 0, 1";
		$row = $conn->query($sql)->fetch_array(MYSQLI_ASSOC);
		
		$auto_checked = "";
		$manual_checked = "";
		$open_checked = "";
		$close_checked = "";

		//Condition pour le mode auto/manuel
		if ($row['config_mode'] == "0")
			$auto_checked = "checked";
		else
			$manual_checked = "checked";

		//Condition pour l'ouverture/fermeture de la fenêtre
		if ($row['window'] == "0")
			$close_checked = "checked";
		else
			$open_checked = "checked";

		$blind_value = $row['blind'];

		$state = "État au : " . $row['date'] . " à " . $row['time'];

		include("form.php");
	}

	// Enregistrement en base de données de l'état de la config
	function save_config($conn) {
		$mode = $_POST['mode'];
		$auto_checked = $mode == "0" ? "checked" : "";
		$manual_checked = $mode == "1" ? "checked" : "";

		$window = $_POST['window'];
		$open_checked = $window == "1" ? "checked" : "";
		$close_checked = $window == "0" ? "checked" : "";

		$blind_value = $_POST['slide'];

		date_default_timezone_set('Europe/Zurich');
		$date = date("Y-m-d");
		$time = date("H:i:s");

		$sql = "INSERT INTO state (config_mode, window, blind, date, time, users_id) 
				VALUES ('$mode', '$window', '$blind_value', '$date', '$time', '3')";
		$conn->query($sql);

		$state = "État au : " . $date . " à " . $time;

		include("form.php");
	}

	$db = database_open("127.0.0.1", "admin", "admin", "smartwindows");

?>
