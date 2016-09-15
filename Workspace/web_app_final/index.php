<?php 

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['id'])) {
	header('Location: login.php');
	exit();
}

include("database_connection.php");
include("head.php");
?>


<title>Smart Windows - Accueil</title>
</head>
<body>

<?php include("menu.php") ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Accueil</h1>

			<p>
				<?php
				if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
					echo 'Bonjour ' . $_SESSION['name'];
				}
				?>
			</p>
		</div>
	</div>


	<div class="row-fluid">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
	

	<?php 
		include('graphics.php'); 
		include("table.php");
	?>

		</div>
	</div>
</div>

</body>
</html>