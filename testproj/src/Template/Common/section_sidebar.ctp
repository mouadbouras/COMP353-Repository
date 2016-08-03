<?php $this->extend('/Common/sidebar'); ?>

<?php $this->set('sidebar_title', 'Manage Sections'); 
    $linkgroups[] = [
        'title' => 'Actions',
        'links' => [
            ['text' => 'List Sections', 
             'url' => ['controller' => 'Sections', 
                       'action' => 'index']],
            ['text' => 'Add a Section', 
             'url' => ['controller' => 'Sections', 
                       'action' => 'add']],
        ]];
    $linkgroups[] = [
        'title' => 'Related',
        'links' => [
            ['text' => 'List Courses', 
             'url' => ['controller' => 'Courses', 
                       'action' => 'index']],
            ['text' => 'Create a Course', 
             'url' => ['controller' => 'Courses', 
                       'action' => 'add']]
        ]];

    $this->set('linkgroups', $linkgroups);
?>

<?= $this->fetch('content'); ?>