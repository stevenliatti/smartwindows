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

<div class="container">
			<h1 class="page-header">Accueil</h1>

			<p>
				<?php
				if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
					echo 'Bonjour ' . $_SESSION['name'];
				}
				?>
			</p>
	

			<?php 
				include('graphics.php'); 

				//ce test vérifie si l'option d'affichage choisie est bien "jour" ou "tranche horaire" pour que
				//les données du tableau correspondent aux données affichées dans les graphiques.
				//si l'utilisateur choisit d'afficher les graphiques par mois le tableau ne s'affiche pas
				if ($selected_chart != "month" and count($data_array) != 0) {
					include("table_data.php");
				}
			?>
</div>
</body>
</html>
