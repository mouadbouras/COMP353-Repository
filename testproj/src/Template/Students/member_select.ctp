<?php $this->extend('/Common/section_view_sidebar'); ?>

<span class='bold'>Add a Member to Team <?= $team->id ?></span><br>
<hr>

<table>
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
<?php foreach($students as $student): ?>
    <tr>
<<<<<<< HEAD
        <td><?= $student->user->id ?></td>
        <td><?= $student->user->first_name ?></td>
        <td><?= $student->user->last_name ?></td>
        <td><?= $student->user->email ?></td>
        <td><?= $this->Html->link('Add to Team ' .$team->id, 
=======
        <td><?= h($student->user->id) ?></td>
        <td><?= h($student->user->first_name) ?></td>
        <td><?= h($student->user->last_name) ?></td>
        <td><?= h($student->user->email) ?></td>
        <td><?= $this->Html->link('Add to Team '.h($team->id), 
>>>>>>> 8b03accbe2d17ca39c53ffaf7fd499b36e2d2641
                    ['action' => 'setTeam', $team->id, $student->user->id]) ?></td>
    </tr>
<?php endforeach ?>

</table>