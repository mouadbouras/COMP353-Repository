<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Submission'), ['action' => 'edit', $submission->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Submission'), ['action' => 'delete', $submission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $submission->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Submissions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Submission'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assignments'), ['controller' => 'Assignments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Assignment'), ['controller' => 'Assignments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="submissions view large-9 medium-8 columns content">
    <h3><?= h($submission->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Assignment') ?></th>
            <td><?= $submission->has('assignment') ? $this->Html->link($submission->assignment->name, ['controller' => 'Assignments', 'action' => 'view', $submission->assignment->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Team') ?></th>
            <td><?= $submission->has('team') ? $this->Html->link($submission->team->id, ['controller' => 'Teams', 'action' => 'view', $submission->team->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('File') ?></th>
            <td><?= $submission->has('file') ? $this->Html->link($submission->file->name, ['controller' => 'Files', 'action' => 'view', $submission->file->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($submission->id) ?></td>
        </tr>
    </table>
</div>
