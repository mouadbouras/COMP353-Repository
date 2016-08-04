<?php $this->extend('/Common/sidebar'); ?>
<?php 
	$this->set('sidebar_title', $section->course->name.' \ '.$section->id.'<br>'.$section->semester->name); 

	$linkgroups = [];
	if($user->isStudent($section->id)){
		$linkgroups[] = [
			'title' => 'Student',
			'links' => [
				['text' => 'Course Group', 
				 'url' => ['controller' => 'Teams', 
				 		   'action' => 'index',
				 		   $section->id]],
				['text' => 'Assignments/Projects', 
				 'url' => ['controller' => 'Assignments', 
				 		   'action' => 'index',
				 		   $section->id]]


			

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
				['text' => 'Manage Groups', 
				 'url' => ['controller' => 'Teams', 
				 		   'action' => 'index',
				 		   	$section->id]]
			]];
	}

	$this->set('linkgroups', $linkgroups);
?>

<?= $this->fetch('content'); ?>