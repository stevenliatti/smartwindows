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


<title>Smart Windows - Admin</title>
</head>
<body>

<?php include("menu.php") ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Admin</h1>

			<p>
				<?php
				if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
					echo 'Bonjour ' . $_SESSION['name'];
				}
				?>
			</p>

			<p><a href="action_user.php">Ajouter un utilisateur</a></p>
		</div>
	</div>


	<div class="row-fluid">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

			<?php

			include("table_users.php");

			?>

		</div>
	</div>
</div>

</body>
</html>