<?php

	require 'database_connection.php';

	define("DATABASE_IP", "localhost");
	define("USER", "root");
	define("PASWORD", "");
	define("DATABASE_NAME", "smartwindows");

	$selected_day = date("Y-m-d");

	$db = database_open(DATABASE_IP, USER, PASWORD, DATABASE_NAME);
	

?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Test form standard</title>
</head>
<body>
	<h2>Test form standard</h2>

	<?php
	
	if (empty($_POST)) {
		config_retrieve($db);
	}
	else {
		config_save($db);
	}
	?>

	<script>
		function sliderValue(value) {
			document.getElementById("range").innerHTML = value;
		}
	</script>
</body>
</html>