<?= $this->Flash->render() ?>

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
