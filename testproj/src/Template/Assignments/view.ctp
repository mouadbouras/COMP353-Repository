
<div class="assignments index large-9 medium-8 columns content">
    <h3><?= __('Assignments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!-- <th><?// $this->Paginator->sort('id') ?></th> -->
                <th><?= $this->Paginator->sort('name') ?></th>
                <!-- <th><?// $this->Paginator->sort('section_id') ?></th> -->
                <th><?= $this->Paginator->sort('due_date') ?></th>
                <!-- <th class="actions"><? //__('Actions') ?></th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
            <tr>
                <!-- <td><?// h($assignment->id) ?></td> -->
                <!-- <td><?// $this->Number->format($assignment->id) ?></td> -->
                <td><?= $this->Html->link(__($assignment->name), ['action' => 'assignment', $assignment->id]) ?></td>
                <!-- <td><?// $assignment->has('section') ? $this->Html->link($assignment->section->id, ['controller' => 'Sections', 'action' => 'view', $assignment->section->id]) : '' ?></td> -->
                <td><?= h($assignment->due_date) ?></td>
   <!--              <td class="actions">
                    <? $//this->Html->link(__('View'), ['action' => 'view', $assignment->id]) ?>
                    <? //$this->Html->link(__('Edit'), ['action' => 'edit', $assignment->id]) ?>
                    <? //$this->Form->postLink(__('Delete'), ['action' => 'delete', $assignment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assignment->id)]) ?>
                </td> -->
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
