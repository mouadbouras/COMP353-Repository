<?= $this->Flash->render() ?>

<div class="students index large-9 medium-8 columns content">
    <h3><?= __('Students') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('section_id') ?></th>
                <th><?= $this->Paginator->sort('team_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student->has('user') ? $this->Html->link($student->user->id, ['controller' => 'Users', 'action' => 'view', $student->user->id]) : '' ?></td>
                <td><?= $student->has('section') ? $this->Html->link($student->section->id, ['controller' => 'Sections', 'action' => 'view', $student->section->id]) : '' ?></td>
                <td><?= $student->has('team') ? $this->Html->link($student->team->id, ['controller' => 'Teams', 'action' => 'view', $student->team->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $student->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->user_id)]) ?>
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
