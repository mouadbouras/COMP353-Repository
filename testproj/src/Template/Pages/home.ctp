<?php
    use Cake\ORM\TableRegistry;

    $sectionsTable = TableRegistry::get('Sections');
    $studentsTable = TableRegistry::get('Students');

    //student in
    $studentInfos = $studentsTable->find()
        ->where(['user_id' => $user->id])
        ->contain([
            'Sections.Semesters' => function(\Cake\ORM\Query $query){
                $semestersTable = TableRegistry::get('Semesters');
                return $semestersTable->selectCurrentSemesters($query);
            }, 
            'Sections.Courses']);

    //ta in
    $taInfos = $sectionsTable->find()
        ->where(['ta_user_id' => $user->id])
        ->contain(['Courses', 
                   'Semesters' => function(\Cake\ORM\Query $query){
                        $semestersTable = TableRegistry::get('Semesters');
                        return $semestersTable->selectCurrentSemesters($query);
                    }]);
?>

<div id='courses'>
    <div class='center'>
        <span id='title'>
            <span style="color: red">C</span><span style="color: #efdf00">r</span><span style="color: #00ff00">s</span><span style="color: #663300">M</span><span style="color: blue">g</span><span style="color: #ff3399">r</span>
        </span>

        <div id='subtitle'>
            Your Courses and Roles in CrsMgr -- The Course Manager System
        </div>

        <?php if($studentInfos->count()): ?>
        <div class='role-group'>
            You are currently a STUDENT in the following sections:
            <?php foreach ($studentInfos as $studentInfo) { ?>
                <div class='d-block'>
                <?= $this->Html->link($studentInfo->section->course->name.' \ '.$studentInfo->section->id, ['controller' => 'Sections', 'action' => 'view', $studentInfo->section->id], ['class' => 'd-inline']); ?>
                </div>
            <?php } ?>
        </div>
        <?php endif; ?>

        <?php if($taInfos->count()): ?>
        <div class='role-group'>
            You are currently a TA for the following sections:
            <?php foreach ($taInfos as $taInfo) { ?>
                <div class='d-block'>
                <?= $this->Html->link($taInfo->course->name.' \ '.$taInfo->id, ['controller' => 'Sections', 'action' => 'view', $taInfo->id], ['class' => 'd-inline']); ?>
                </div>
            <?php } ?>
        </div>
        <?php endif; ?>

        <?php if($user->isAdmin()){ ?>
        <div class='role-group'>
            Admin Tools
            <div class='d-block'>
                <?= $this->Html->link('Manage Courses', ['controller' => 'Courses', 'action' => 'index']) ?>
            </div>
            <div class='d-block'>
                <?= $this->Html->link('Manage Sections', ['controller' => 'Sections', 'action' => 'index']) ?>
            </div>
        </div>
        <?php } ?>

        <?= $this->Html->link('Log out', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'underline']) ?>
    </div>
<div>