<table> <!-- bootstrap classes added by the uitheme widget -->
	<thead>
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Rôle</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Id</th>
			<th>Nom</th>
			<th>Rôle</th>
			<th></th>
			<th></th>
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

		$users = get_users($db);

		for ($i = 0; $i < count($users); $i++) {
			$id = $users[$i]["id"];
			$name = $users[$i]["name"];
			echo "<tr><td>" . $id . "</td><td>" . $name . 
			"</td><td>" . $users[$i]["role"] . '</td><td>' .
			'<a href="action_user.php?update=true&id=' . $id . '&name=' . $name .'">Modifier</a></td><td></td></tr>';
		}
		database_close($db);
		?>

	</tbody>
</table>