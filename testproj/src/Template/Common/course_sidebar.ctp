<?php $this->extend('/Common/sidebar'); ?>

<?php $this->set('sidebar_title', 'Courses'); 
    $linkgroups[] = [
        'title' => 'Actions',
        'links' => [
            ['text' => 'List Courses', 
             'url' => ['controller' => 'Courses', 
                       'action' => 'index']],
            ['text' => 'Add a Course', 
             'url' => ['controller' => 'Courses', 
                       'action' => 'add']],
        ]];
    $linkgroups[] = [
        'title' => 'Related',
        'links' => [
            ['text' => 'List Sections', 
             'url' => ['controller' => 'Sections', 
                       'action' => 'index']],
            ['text' => 'Create a Section', 
             'url' => ['controller' => 'Sections', 
                       'action' => 'index']]
        ]];

    $this->set('linkgroups', $linkgroups);
?>

<?= $this->fetch('content'); ?>