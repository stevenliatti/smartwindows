<?php
	require 'database_connection.php';
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
			get_config($db);
		}
		else {
			save_config($db);
		}
	?>

	<script>
		function sliderValue(value) {
			document.getElementById("range").innerHTML = value;
		}

		function show() {
			document.getElementById("hide").removeAttribute("hidden");
		}

		function hide() {
			document.getElementById("hide").setAttribute("hidden", true);
		}
	</script>
</body>
</html>