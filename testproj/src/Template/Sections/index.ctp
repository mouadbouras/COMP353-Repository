<?php $this->extend('/Common/section_sidebar'); ?>

<div class="sections index large-9 medium-8 columns content">
    <h3><?= __('Sections') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('course_id') ?></th>
                <th><?= $this->Paginator->sort('semester_id') ?></th>
                <th><?= $this->Paginator->sort('ta_user_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sections as $section): ?>
            <tr>
                <td><?= $this->Number->format($section->id) ?></td>
                <td><?= $section->has('course') ? $this->Html->link($section->course->name, ['controller' => 'Courses', 'action' => 'view', $section->course->id]) : '' ?></td>
                <td><?= $section->has('semester') ? $this->Html->link($section->semester->name, ['controller' => 'Semesters', 'action' => 'view', $section->semester->id]) : '' ?></td>
                <td><?= $section->has('user') ? $this->Html->link($section->user->id, ['controller' => 'Users', 'action' => 'view', $section->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $section->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $section->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $section->id], ['confirm' => __('Are you sure you want to delete # {0}?', $section->id)]) ?>
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
