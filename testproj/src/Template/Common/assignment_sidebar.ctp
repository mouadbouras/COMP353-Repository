<?php $this->extend('/Common/sidebar'); ?>

<?php   

    $student = $this->Students->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id')]
            ])->first();
  
    $section = $this->Sections->find('all', [
                'conditions' => ['id' => $student->section_id],
                'contain' => ['Courses']
            ])->first();

    $this->set('sidebar_title', h($section->course->name).' \ '.h($section->id).'<br>'.h($section->semester->name)); 

    $linkgroups[] = [
        'title' => 'Actions',
        'links' => [
            ['text' => 'Assignments/Projects', 
             'url' => ['controller' => 'Assignments', 
                       'action' => 'index',
                        $section->id]],
        ]];
    
    // $linkgroups[] = [
    //     'title' => 'Related',
    //     'links' => [
    //         ['text' => 'List Courses', 
    //          'url' => ['controller' => 'Courses', 
    //                    'action' => 'index']],
    //         ['text' => 'Create a Course', 
    //          'url' => ['controller' => 'Courses', 
    //                    'action' => 'add']]
    //     ]];

    $this->set('linkgroups', $linkgroups);
?>

<?= $this->fetch('content'); ?>