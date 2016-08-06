<?php $this->extend('/Common/section_view_sidebar'); ?>

<?= $this->Flash->render() ?>

<div class="row">
<div class=" col-xs-12 ">

<?php if($student!= null && $student->section_id == $section->id) { ?>
    <h3><?= h('General Info') ?></h3>
        <table class="vertical-table">
           	<tr>
                <th><?= __('Course') ?></th>
                <td><?= h($section->course->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Section Info') ?></th>
                <td><?= h( $section->id) ?></td>
            </tr>       
            <tr>
                <th><?= __('Team Info') ?></th>
                <td><?= ($student->team_id != null) ? h( 'Team ' .  $student->team_id) : "No Team"  ;?></td>
            </tr>    
        </table>
	<br/>

		<?php if($members != null) { ?>
		<h3><?= "Team " . h($student->team_id) ?></h3>
		<table>
		    Members :
		    <tr>
		        <th>Student ID</th>
		        <th>First Name</th>
		        <th>Last Name</th>
		        <th>Email</th>
		        <th>Role</th>
		    </tr>
		    <?php foreach($members as $member): ?>
		        <tr>
		            <td><?= $member->user->id ?></td>
		            <td><?= $member->user->first_name ?></td>
		            <td><?= $member->user->last_name ?></td>
		            <td><?= $member->user->email ?></td>
		            <td><?= ($member->user->id == $student->team->leader_user_id)?'Leader':'-' ?></td>
		        </tr>
		    <?php endforeach; ?>
			</table>
		<?php } ?>
<?php } ?>
</div>
</div>
