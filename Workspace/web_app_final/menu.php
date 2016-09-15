<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-navbar-collapse" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Smart Windows</a>
		</div>

	<div class="navbar-collapse collapse sidebar-navbar-collapse">

		<div class="container-fluid">
			<ul class="nav navbar-nav navbar-right">

				<?php
				if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
					echo '<li><a href="logout.php">Déconnexion</a></li>';
				}
				else {
					echo '<li><a href="login.php">Connexion</a></li>';
				}
				?>

			</ul>
		</div>

		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li class="active"><a href="index.php">Accueil <span class="sr-only">(current)</span></a></li>

					<?php
					if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
					?>
						<li class="dropdown">
							<a href="" class="dropdown-toggle" data-toggle="dropdown"> Données <b class="caret"></b></a>
							<ul class="nav dropdown-menu">
								<li><a href="data.php">Température</a></li>
								<li><a href="data.php">Luminosité</a></li>
								<li><a href="data.php">Vent</a></li>
							</ul>
						</li>
						<li><a href="control.php">Contrôle</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>

	</div>
</nav>