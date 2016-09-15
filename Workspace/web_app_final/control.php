<?php 

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

include("database_connection.php");

include("head.php");

?>

<title>Smart Windows - Contrôle</title>
</head>
<body>

<?php include("menu.php") ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">Contrôle</h1>

  <p>
  	<?php
	  	if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
			echo 'Bonjour ' . $_SESSION['name'];
		}
		?>
	</p>

	<?php
		if (empty($_POST)) {
			get_config($db);
		}
		else {
			save_config($db);
		}
	?>
</div>

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

		var slider = new Slider("#slide", {
			tooltip: 'always'
		});
	</script>

</body>
</html>