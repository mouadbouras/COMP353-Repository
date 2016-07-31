
<!-- <?= $section ?> -->

<div class='container-fluid'>
<div class='row'>
		<span id='title' class='center'>
			<span style="color: red">C</span><span style="color: #efdf00">r</span><span style="color: #00ff00">s</span><span style="color: #663300">M</span><span style="color: blue">g</span><span style="color: #ff3399">r</span>
		</span>
</div>
<div class='row'>
	<div class='sidebar col-sm-3 col-xs-5'>
		<span class='italic'>
		<?= $section->course->name.' \ '.$section->semester->name.'<br>Section '.$section->id ?>
		</span>
		<hr>
		<?php if($user->isStudent($section->id)): ?>
			<span class='underline'>Student</span>
			<ul>
				<li>
					<?= $this->Html->link('Course Group', ''); ?>
				</li>
				<li>
					<?= $this->Html->link('Assignments', ''); ?>
				</li>
				<li>
					<?= $this->Html->link('c', ''); ?>
				</li>
			</ul>
		<?php endif; ?>
		<?php if($user->isTA($section->id)): ?>
			<span class='underline'>TA Options</span>
			<ul>
				<li>
					<?= $this->Html->link('Manage assignments', ['controller' => 'Assignments', 'action' => 'index', $section->id]); ?>
				</li>
				<li>
					<?= $this->Html->link('View section teams', ''); ?>
				</li>
				<li>c</li>
				<li>d</li>
				<li>e</li>
				<li>f</li>
			</ul>
		<?php endif; ?>
		<?php if($user->isAdmin()): ?>
			<span class='underline'>Admin tools</span>
			<ul>
				<li>a</li>
				<li>b</li>
				<li>c</li>
				<li>d</li>
				<li>e</li>
				<li>f</li>
			</ul>
		<?php endif; ?>
	</div>
	<div class='col-sm-9 col-xs-7'>
		<?= $this->fetch('content'); ?>
	</div>
</div>
</div>