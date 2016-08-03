<div class='container-fluid'>
	<div class='row'>
		<span id='title' class='center'>
			<span style="color: red">C</span><span style="color: #efdf00">r</span><span style="color: #00ff00">s</span><span style="color: #663300">M</span><span style="color: blue">g</span><span style="color: #ff3399">r</span>
		</span>
	</div>
	<div class='row'>
		<div class='sidebar col-sm-3 col-xs-5'>
			<?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display', 'home'], ['class'=>'underline']) ?><br><br>
			<span class='italic'>
				<?= $sidebar_title ?>
			</span>
			<hr>
			<?php foreach($linkgroups as $linkgroup): ?>
				<span class='underline'><?= h($linkgroup['title']) ?></span>
				<ul>
					<?php foreach($linkgroup['links'] as $link): ?>
						<li>
							<?= $this->Html->link(h($link['text']), $link['url'], isset($link['other'])?$link['other']:[]) ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endforeach; ?>

        <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?>
		</div>
		<div class='col-sm-9 col-xs-7'>
			<?= $this->fetch('content'); ?>
		</div>
	</div>
</div>