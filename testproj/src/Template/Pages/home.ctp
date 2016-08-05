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

    //instructor in
    $instructorInfos = $sectionsTable->find()
        ->where(['instructor_user_id' => $user->id])
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

        <?php if($instructorInfos->count()): ?>
        <div class='role-group'>
            You are currently an INSTRUCTOR for the following sections:
            <?php foreach ($instructorInfos as $instructorInfo) { ?>
                <div class='d-block'>
                <?= $this->Html->link($instructorInfo->course->name.' \ '.$instructorInfo->id, ['controller' => 'Sections', 'action' => 'view', $instructorInfo->id], ['class' => 'd-inline']); ?>
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



<br><br>
<table>
    <tr>
        <th>Action</th>
        <th>Student</th>
        <th>TA</th>
        <th>Instructor</th>
        <th>Admin</th>
    </tr>
    <tr>
        <td>List files of team</td>
        <td>Yes (partof team)</td>
        <td>Yes</td>
        <td>Yes</td>
        <td></td>
    </tr>
    <tr>
        <td>Download files of team</td>
        <td>Yes (partof team)</td>
        <td>Yes</td>
        <td>Yes</td>
        <td></td>
    </tr>
    <tr>
        <td>Upload a file to team</td>
        <td>Yes (partof team)</td>
        <td>No</td>
        <td>No</td>
        <td></td>
    </tr>
    <tr>
        <td>Update a file of team</td>
        <td>Yes (partof team)</td>
        <td>No</td>
        <td>No</td>
        <td></td>
    </tr>
    </tr>
    <tr>
        <td>Delete a file of team</td>
        <td>Yes (partof team)</td>
        <td>No</td>
        <td>No</td>
        <td></td>
    </tr>
    <tr>
        <td>Recover a deleted file</td>
        <td>Yes (partof team)</td>
        <td>No</td>
        <td>No</td>
        <td></td>
    </tr>
    <tr>
        <td>Rollback Changes</td>
        <td>leader only</td>
        <td>No</td>
        <td>No</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>See Team statistics</td>
        <td>No</td>
        <td>Yes</td>
        <td>Yes</td>
        <td></td>
    </tr>
    <tr>
        <td>Create Group</td>
        <td>No</td>
        <td>No</td>
        <td></td>
        <td>Yes</td>
    </tr>
    <tr>
        <td>Delete Group</td>
        <td>No</td>
        <td>No</td>
        <td></td>
        <td>Yes</td>
    </tr>
    <tr>
        <td>Add Group Members</td>
        <td>No</td>
        <td>No</td>
        <td>Yes</td>
        <td>Yes</td>
    </tr>
    <tr>
        <td>Remove Group Members</td>
        <td>No</td>
        <td>No</td>
        <td>Yes</td>
        <td>Yes</td>
    </tr>
    <tr>
        <td>Create assignment/project</td>
        <td>No</td>
        <td>No</td>
        <td>Yes</td>
        <td>Yes ('add group tasks'?)</td>
    </tr>
    <tr>
        <td>Archive Group Contents</td>
        <td>No</td>
        <td>No</td>
        <td>No</td>
        <td>Yes</td>
    </tr>
    <tr>
        <td>Set filesize limit</td>
        <td>No</td>
        <td>No</td>
        <td>Yes</td>
        <td>Yes</td>
    </tr>
</table>
Notes:<br>
- The files would not be accessible to the group after the end of the course.<br>
- Adding any member into a group requires the knowledge of the person’s CrsMgr ID, section ID
and groupID.<br>
