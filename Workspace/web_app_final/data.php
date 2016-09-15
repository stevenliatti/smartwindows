<?php 

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include("database_connection.php");
include("head.php");
?>

<script src="sort.js"></script>

<title>Smart Windows - Données</title>
</head>
<body>

<?php include("menu.php") ?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Données</h1>

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
        
    <?php include('graphics.php'); ?>
			<table> <!-- bootstrap classes added by the uitheme widget -->
				<thead>
					<tr>
						<th>Température interne</th>
						<th>Température externe</th>
						<th>Luminosité</th>
						<th>Vitesse du vent</th>
						<th>Date</th>
						<th>Heure</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Température interne</th>
						<th>Température externe</th>
						<th>Luminosité</th>
						<th>Vitesse du vent</th>
						<th>Date</th>
						<th>Heure</th>
					</tr>
				<tr>
					<th colspan="7" class="ts-pager form-horizontal">
					<button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
					<button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
					<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
					<button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
					<button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
					<select class="pagesize input-mini" title="Select page size">
						<option selected="selected" value="10">10</option>
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					<select class="pagenum input-mini" title="Select page number"></select>
					</th>
				</tr>
				</tfoot>
				<tbody>
					<?php

					$data_array_tab = day_data_select($db, "2016-09-13");

					for ($i = 0; $i < count($data_array_tab); $i++) {
						echo "<tr><td>" . $data_array_tab[$i]["temp_int"] . "</td><td>" . $data_array_tab[$i]["temp_ext"] . 
						"</td><td>" . $data_array_tab[$i]["luminosity"] . " </td><td>" . $data_array_tab[$i]["wind_speed"] . 
						"</td><td>" . $data_array_tab[$i]["date"] . "</td><td>" . $data_array_tab[$i]["time"] . "</td></tr>";
					}

					?>

				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
</html>