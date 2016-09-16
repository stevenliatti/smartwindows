<div class="table-container">
<table> <!-- bootstrap classes added by the uitheme widget -->
	<thead>
		<tr>
			<th>Temp interne<br>(en degré)</th>
			<th>Temp externe<br>(en degré)</th>
			<th>Luminosité<br>(en Lux)</th>
			<th>Vitesse du vent<br>(en m/s)</th>
			<th>Date</th>
			<th>Heure</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Temp interne<br>(en degré)</th>
			<th>Temp externe<br>(en degré)</th>
			<th>Luminosité<br>(en Lux)</th>
			<th>Vitesse du vent<br>(en m/s)</th>
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

		//ancien :
		//$data_array_tab = day_data_select($db, "2016-09-01", $selected_min_time, "2016-09-15", $selected_max_time);
		//nouveau :
		//récupérer les données affichées dans les graphiques
		//(pas besoin de récupérer toutes les données) se trouvant dans la variable $data_array
		//c'est à dire, le contenu du tableau change en fonction du contenu des graphoques
		$data_array_tab = $data_array;

	
			for ($i = 0; $i < count($data_array_tab); $i++) {
				echo "<tr><td>" . $data_array_tab[$i]["temp_int"] . "</td><td>" . $data_array_tab[$i]["temp_ext"] . 
				"</td><td>" . $data_array_tab[$i]["luminosity"] . " </td><td>" . $data_array_tab[$i]["wind_speed"] . 
				"</td><td>" . $data_array_tab[$i]["date"] . "</td><td>" . $data_array_tab[$i]["time"] . "</td></tr>";
			}
		?>

	</tbody>
</table>
</div>