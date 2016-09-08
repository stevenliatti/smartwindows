<div class="large-3 medium-4 columns">
	<h1>Login</h1>
	<?= $this->Form->create() ?>
	<?= $this->Form->input('login') ?>
	<?= $this->Form->input('password') ?>
	<?= $this->Form->button('Login') ?>
	<?= $this->Form->end() ?>
</div>