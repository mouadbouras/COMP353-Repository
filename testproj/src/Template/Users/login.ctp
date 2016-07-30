<?php
?>

<div id='login'>
	<div class='center'>
		<span id='title'>
			<span style="color: red">C</span><span style="color: #efdf00">r</span><span style="color: #00ff00">s</span><span style="color: #663300">M</span><span style="color: blue">g</span><span style="color: #ff3399">r</span>
		</span>

		<div id='welcome'>
			Welcome to 
			<span style="color: red">C</span><span style="color: yellow">r</span><span style="color: #00ff00">s</span><span style="color: #663300">M</span><span style="color: blue">g</span><span style="color: #ff3399">r</span>
			 -- The Course Manager System!
		</div>

		<?= $this->Form->create() ?>
		<?= $this->Flash->render('auth') ?>
		    <fieldset>
		        <legend><?= __('Login') ?></legend>
		        <?= $this->Form->input('username', ['required' => 'required', 'autofocus' => 'autofocus']) ?>
		        <?= $this->Form->input('password', ['required' => 'required']) ?>
		    </fieldset>
		<?= $this->Form->button(__('Login')); ?>
		<?= $this->Form->end() ?>
	</div>
<div>