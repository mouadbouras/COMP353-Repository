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
        <td><?= $student->user->id ?></td>
        <td><?= $student->user->first_name ?></td>
        <td><?= $student->user->last_name ?></td>
        <td><?= $student->user->email ?></td>
        <td><?= $this->Html->link('Add to Team 5', 
                    ['action' => 'setTeam', $team->id, $student->user->id]) ?></td>
    </tr>
<?php endforeach ?>

</table>