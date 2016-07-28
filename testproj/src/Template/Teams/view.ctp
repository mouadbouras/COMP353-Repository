<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Team'), ['action' => 'edit', $team->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Team'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
<!--         <li><?// $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?// $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?// $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
        <li><?// $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?// $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?// $this->Html->link(__('List Submissions'), ['controller' => 'Submissions', 'action' => 'index']) ?> </li>
        <li><?// $this->Html->link(__('New Submission'), ['controller' => 'Submissions', 'action' => 'add']) ?> </li> -->
    </ul>
</nav>
<div class="teams view large-9 medium-8 columns content">
    <h3><?= "Team " . h($team->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $team->has('user') ? $this->Html->link($team->user->id, ['controller' => 'Users', 'action' => 'view', $team->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= $team->has('section') ? $this->Html->link($team->section->id, ['controller' => 'Sections', 'action' => 'view', $team->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($team->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Id') ?></th>
                <th><?= __('Section Id') ?></th>
                <th><?= __('Team Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php //echo "-> " ; print_r($students); ?>
            <?php foreach ($students as $student):  ?>
            <tr>
                <td><?= h($student->user->first_name) ?></td>
                <td><?= h($student->section_id) ?></td>
                <td><?= h($student->team_id) ?></td>
                <td class="actions">
                   
                    <?= $this->Form->postLink(__('Remove From team'), ['controller' => 'Students', 'action' => '', $student->user_id], ['confirm' => __('Are you sure you want to remove {0}?', $student->user->first_name)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
<!--     <div class="related">
        <h4><= __('Related Submissions') ?></h4>
        <php if (!empty($team->submissions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><= __('Id') ?></th>
                <th><= __('Assignment Id') ?></th>
                <th><= __('Team Id') ?></th>
                <th><= __('File Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <php foreach ($team->submissions as $submissions): ?>
            <tr>
                <td><= h($submissions->id) ?></td>
                <td><= h($submissions->assignment_id) ?></td>
                <td><= h($submissions->team_id) ?></td>
                <td><= h($submissions->file_id) ?></td>
                <td class="actions">
                    <= $this->Html->link(__('View'), ['controller' => 'Submissions', 'action' => 'view', $submissions->id]) ?>
                    <= $this->Html->link(__('Edit'), ['controller' => 'Submissions', 'action' => 'edit', $submissions->id]) ?>
                    <= $this->Form->postLink(__('Delete'), ['controller' => 'Submissions', 'action' => 'delete', $submissions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $submissions->id)]) ?>
                </td>
            </tr>
            <php endforeach; ?>
        </table>
        <php endif; ?>
    </div> -->
</div>
