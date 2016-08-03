<?php $this->extend('/Common/sidebar'); ?>
<!-- <?= $section ?> -->

<!-- <?php $this->start('sidebar_title'); ?><?php $this->end(); ?> -->
<?php 
	$this->set('sidebar_title', $section->course->name.' \ '.$section->id.'<br>'.$section->semester->name); 

	$linkgroups = [];
	if($user->isStudent($section->id)){
		$linkgroups[] = [
			'title' => 'Student',
			'links' => [
				['text' => '123123123', 
				 'url' => ['controller' => 'Sections', 
				 		   'action' => 'index']],
				['text' => 'aaa', 
				 'url' => ['controller' => 'Sections', 
				 		   'action' => 'index']],
				['text' => 'bbb', 
				 'url' => ['controller' => 'Sections', 
				 		   'action' => 'index']],
				['text' => 'ccc', 
				 'url' => ['controller' => 'Sections', 
				 		   'action' => 'index']]
			]];
	}

	if($user->isTA($section->id)){
		$linkgroups[] = [
			'title' => 'TA Options',
			'links' => [
				['text' => 'Manage assignments', 
				 'url' => ['controller' => 'Assignments', 
				 		   'action' => 'index',
				 		   	$section->id]],
				['text' => 'Manage teams', 
				 'url' => ['controller' => 'Sections', 
				 		   'action' => 'index']]
			]];
	}

	if($user->isAdmin()){
		$linkgroups[] = [
			'title' => 'Admin tools',
			'links' => [
				['text' => 'olololol', 
				 'url' => ['controller' => 'Assignments', 
				 		   'action' => 'index',
				 		   	$section->id]],
				['text' => 'asasasasasas', 
				 'url' => ['controller' => 'Sections', 
				 		   'action' => 'index']]
			]];
	}

	$this->set('linkgroups', $linkgroups);
?>

<?= $this->fetch('content'); ?>