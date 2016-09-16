<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Smart Windows</a>
		</div>
		<div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<?php
					// sélectionne le menu actif
					if (isset($_SESSION['id']) AND isset($_SESSION['name'])) {
						$index = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']) == 'index.php' ? 'active' : '';
						$control = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']) == 'control.php' ? 'active' : '';
						$admin = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']) == 'admin.php' ? 'active' : '';
					?>
						<li class="<?php echo $index;?>">
							<a href="index.php">Accueil<span class="sr-only">(current)</span></a>
						</li>
						<?php
						if ($_SESSION['role'] == "admin") {
						?>
						<li class="<?php echo $control;?>">
							<a href="control.php">Contrôle<span class="sr-only">(current)</span></a>
						</li>
						<li class="<?php echo $admin;?>">
							<a href="admin.php">Admin<span class="sr-only">(current)</span></a>
						</li>
						<?php
						}
						?>
					<?php
					}
					?>
				</ul>
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
		</div>
	</div>
		

	</div>
</nav>
