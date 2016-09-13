<form method="post" action="">
	<p>Mode : <br>
		<input type="radio" name="mode" value="0" id="auto" <?php echo $auto_checked; ?> ><label for="auto"> Automatique</label><br>
		<input type="radio" name="mode" value="1" id="manual" <?php echo $manual_checked; ?> ><label for="manual"> Manuel</label>
	</p>

	<p id="state_window">La fenêtre est : <br>
		<input type="radio" name="window" value="1" id="open" <?php echo $open_checked; ?> ><label for="open"> Ouverte</label><br>
		<input type="radio" name="window" value="0" id="close" <?php echo $close_checked; ?> ><label for="close"> Fermée</label>
	</p>

	<p> Le store est à ce niveau : <br>
		<input id="slide" name="slide" type="range" min="0" max="10" value="<?php echo $blind_value; ?>" step="1" onchange="sliderValue(this.value)" />
		<span id="range"><?php echo $blind_value; ?></span>
	</p>

	<input type="submit" id="send_data" value="Valider">

</form>