<?php $this->extend('/Common/section_view_sidebar'); ?>


<?php $this->start('full_editable'); ?>
<div class="teams index large-9 medium-8 columns content">
    <h3><?= __('Teams') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('leader_user_id') ?></th>
                <th><?= $this->Paginator->sort('section_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $team): ?>
            <tr>
                <td><?= $this->Number->format($team->id) ?></td>
                <td><?= $team->has('user') ? $this->Html->link($team->user->id, ['controller' => 'Users', 'action' => 'view', $team->user->id]) : '' ?></td>
                <td><?= $team->has('section') ? $this->Html->link($team->section->id, ['controller' => 'Sections', 'action' => 'view', $team->section->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $team->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $team->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->end(); ?>

<?php $this->start('basic'); ?>
    <h3><?= __('Teams') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php foreach ($teams as $team): ?>
            <tr>
                <td><?= 'Team '.$this->Number->format($team->id) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php $this->end(); ?>


<?php 
    if($user->isStudent($section->id)):
        if($team = $user->getGroup($section->id)):
            echo $team;
        endif;
    endif;
?>
