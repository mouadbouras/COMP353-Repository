<?= $this->Flash->render() ?>

<div class="submissions index large-9 medium-8 columns content">
    <h3><?= __('Submissions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('assignment_id') ?></th>
                <th><?= $this->Paginator->sort('team_id') ?></th>
                <th><?= $this->Paginator->sort('file_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($submissions as $submission): ?>
            <tr>
                <td><?= $this->Number->format($submission->id) ?></td>
                <td><?= $submission->has('assignment') ? $this->Html->link($submission->assignment->name, ['controller' => 'Assignments', 'action' => 'view', $submission->assignment->id]) : '' ?></td>
                <td><?= $submission->has('team') ? $this->Html->link($submission->team->id, ['controller' => 'Teams', 'action' => 'view', $submission->team->id]) : '' ?></td>
                <td><?= $submission->has('file') ? $this->Html->link($submission->file->name, ['controller' => 'Files', 'action' => 'view', $submission->file->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $submission->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $submission->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $submission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $submission->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
