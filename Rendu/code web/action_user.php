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


<title>Smart Windows - Action user</title>
</head>
<body>

<?php include("menu.php") ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Action user</h1>

			<p>
				<?php
				if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
					echo 'Bonjour ' . $_SESSION['name'];
				}
				?>
			</p>
		</div>
	</div>


	<div class="container">
		<div class="col-sm-3 col-sm-offset-3 col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-2">
	

	<?php 
		include("form_action_user.php");
	?>

		</div>
	</div>
</div>

</body>
</html>