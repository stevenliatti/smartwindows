<div class="col-xs-offset-1 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
<form method="post" action="" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="mode">Mode : </label>
		<div class="controls">
			<label class="radio" for="auto"> 
				<input type="radio" name="mode" value="0" id="auto" onclick="hide()" <?php echo $auto_checked; ?> >
				Automatique
			</label>
			<label class="radio" for="manual">
				<input type="radio" name="mode" value="1" id="manual" onclick="show()" <?php echo $manual_checked; ?> >
				Manuel
			</label>
		</div>
	</div>

	<?php
		$hide = "";
		if ($auto_checked)
			$hide = "hidden";
	?>

	<br>

	<div id="hide" <?php echo $hide; ?> >
		<div class="control-group">
		<label id="state_window" for="window">La fenêtre est : </label>
			<div class="controls">
				<label class="radio" for="open">
					<input type="radio" name="window" value="1" id="open" <?php echo $open_checked; ?> >
					Ouverte
				</label>
				<label class="radio" for="close">
					<input type="radio" name="window" value="0" id="close" <?php echo $close_checked; ?> >
					Fermée
				</label>
			</div>
		</div>

		<br>

		<div class="control-group">
		<label id="state_window" for="slide"> Le store est à ce niveau : </label> <br>
			<div class="controls"><br><br>
				<input id="slide" name="slide" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="<?php echo $blind_value; ?>"/>
			</div>
		</div>
	</div>

	<br>

	<input class="btn btn-primary" type="submit" id="send_data" value="Valider">

	<br>
	<br>
	<p><?php echo $state; ?></p>
</form>
</div>