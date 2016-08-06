<?php $this->extend('/Common/section_view_sidebar'); ?>

<?= $this->Flash->render() ?>

<div class="assignments index large-9 medium-8 columns content">
    <h3><?= __('Assignments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('section_id') ?></th>
                <th><?= $this->Paginator->sort('due_date') ?></th>
                <?php if ($currentuser->isTA($section->id) == 1 || $currentuser->isInstructor($section->id) == 1 ) { ?>
                   <th class="actions"> <?=  __('Actions') ?> </th>
                <?php } ?>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td><?= $this->Number->format($assignment->id) ?></td>
                <!-- <td><?// h($assignment->name) ?></td> -->

                <?php if($currentuser->isTA($section->id) == 1 or $currentuser->isInstructor($section->id) == 1 ){ ?>
                    <td><?= $this->Html->link(__($assignment->name), ['action' => 'teamassignment', $section->id,$assignment->id])
                ?></td>
                <?php } else{ ?>
                    <td><?= $this->Html->link(__($assignment->name), ['action' => 'assignment', $assignment->id]) ?>
                <?php } ?>

                <td><?= h($assignment->section->id)//$assignment->has('section') ? $this->Html->link($assignment->section->id, ['controller' => 'Sections', 'action' => 'view', $assignment->section->id]) : '' ?></td>
                <td><?= h($assignment->due_date) ?></td>
                
                <?php if($currentuser->isTA($section->id) == 1 or $currentuser->isInstructor($section->id) == 1 ){ ?>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assignment->id, $section->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assignment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]) ?>
                    </td>
                <?php } ?>
            
            </tr>
            <?php endforeach; ?>
            <?php if($currentuser->isTA($section->id) == 1 or $currentuser->isInstructor($section->id) == 1 ){ ?>
            <tr>
                <td>-</td><td>-</td><td>-</td><td>-</td>
                <td><?= $this->Html->link(__('Add'), ['action' => 'Add', $section->id]) ?></td>
            </tr>

            <?php } ?>

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
