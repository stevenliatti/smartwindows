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
					<?php
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
			</div>
		</div>

	</div>
</nav>