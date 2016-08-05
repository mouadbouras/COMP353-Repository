<?php $this->extend('/Common/section_view_sidebar'); ?>

    <h3><?= __('Teams') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>Name</th>
                <?php if($editable): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($teams as $team): ?>
            <tr>
                <td><?= $this->Html->link('Team '.$team->id, ['action' => 'view', $team->id]) ?></td>
                <?php if($editable): ?>
                    <td>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $team->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>