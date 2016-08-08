<?= $this->Flash->render() ?>

<div class="students view large-9 medium-8 columns content">
    <h3><?= h($student->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $student->has('user') ? $this->Html->link($student->user->id, ['controller' => 'Users', 'action' => 'view', $student->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Section') ?></th>
            <td><?= $student->has('section') ? $this->Html->link($student->section->id, ['controller' => 'Sections', 'action' => 'view', $student->section->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Team') ?></th>
            <td><?= $student->has('team') ? $this->Html->link($student->team->id, ['controller' => 'Teams', 'action' => 'view', $student->team->id]) : '' ?></td>
        </tr>
    </table>
</div>
