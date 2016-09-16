<?php 

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['id'])) {
	header('Location: login.php');
	exit();
}

if ($_SESSION['role'] != "admin") {
	header('Location: index.php');
	exit();
}

include("database_connection.php");

include("head.php");

?>

<title>Smart Windows - Contrôle</title>
</head>
<body>

<?php include("menu.php") ?>

<div class="container">

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

	<script src="js/control.js"></script>

</body>
</html>