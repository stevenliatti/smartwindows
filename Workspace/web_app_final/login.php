<?php
	include("database_connection.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	$login = "";

	if ($_POST) {
		$name = $_POST['inputName'];
		$pass_hache = sha1($_POST['inputPassword']);

		// Vérification des identifiants
		$sql = "SELECT * FROM users WHERE name = '$name' AND password = '$pass_hache'";
		$req = $db->query($sql)->fetch_array(MYSQLI_ASSOC);

		if (!$req) {
			$login = 'Mauvais identifiant ou mot de passe ! <br>';
		}
		else {
			$_SESSION['id'] = $req['id'];
			$_SESSION['name'] = $name;
			$login = 'Vous êtes connecté !';
			header('Location: index.php');
			exit();
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="bootstrap-3.3.7/favicon.ico">

	<title>Smart Windows - Login</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="css/bootstrap-3.3.7/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/signin.css" rel="stylesheet">

	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="css/bootstrap-3.3.7/assets/js/ie-emulation-modes-warning.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>

  <body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.php">Smart Windows</a>
		</div>
	  </div>
	</nav>

	<div class="container">

	  <form method="post" action="" class="form-signin">
		<h2 class="form-signin-heading">Please sign in</h2>
		<label for="inputName" class="sr-only">Name</label>
		<input type="text" id="inputName" name="inputName" class="form-control" placeholder="Name" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
		<div class="checkbox">
		  <label>
			<input type="checkbox" value="remember-me"> Remember me
		  </label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	  </form>
	  <p class="center"><?php echo $login; ?></p>

	  	<?php
	  	if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
			echo 'Bonjour ' . $_SESSION['name'];
		}
		?>

	</div> <!-- /container -->


	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="css/bootstrap-3.3.7/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
