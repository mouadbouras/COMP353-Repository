<?php $this->extend('/Common/section_view_sidebar'); ?>

<?php 
    $linkgroups[] = [
        'title' => 'Team \''.$team->id.'\'',
        'links' => [
            ['text' => 'Edit Team', 
             'url' => ['controller' => 'Teams', 
                       'action' => 'edit',
                       $team->id]],
            ['text' => 'Delete Team', 
             'url' => ['controller' => 'Teams', 
                       'action' => 'delete',
                       $team->id],
             'other' => ['confirm' => __('Are you sure you want to delete Team {0}?', $team->id)]],
        ]];
    $this->set('linkgroups', $linkgroups);
?>

<span class='bold'>Course Group</span><br>
<?php 
    if($isInGroup){
        echo 'You are currently in this group.';
    }
?>
<hr>

<h3><?= "Team " . h($team->id) ?></h3>
<table>
    Members
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    <?php foreach($students as $student): ?>
        <tr>
            <td><?= $student->user->id ?></td>
            <td><?= $student->user->first_name ?></td>
            <td><?= $student->user->last_name ?></td>
            <td><?= $student->user->email ?></td>
            <td><?= ($student->user->id == $team->leader_user_id)?'Leader':'-' ?></td>
        </tr>
    <?php endforeach; ?>
</table>
