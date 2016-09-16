<?php

	if (!empty($_POST)) {
		create_user($db, $_POST['name'], $_POST['pass'], $_POST['role']);
		header('Location: admin.php');
		exit();
	}

?>

<form method="post" action="" class="form-signin">
	<h2 class="form-signin-heading">Ajout d'un utilisateur</h2>
	<label for="name" class="sr-only">Nom</label>
		<input type="text" id="name" name="name" class="form-control" value="<?php echo $name;?>" required autofocus>
	<label for="pass" class="sr-only">Mot de passe</label>
		<input type="password" id="pass" name="pass" class="form-control" value="<?php echo $pass;?>" required>
	<select name="role" class="form-control">
		<option value="admin">admin</option>
		<option value="user">user</option>
	</select>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Ajouter utilisateur</button>
</form>

<?php

database_close($db);

?>