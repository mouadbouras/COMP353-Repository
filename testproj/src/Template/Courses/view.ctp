<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course'), ['action' => 'edit', $course->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course'), ['action' => 'delete', $course->id], ['confirm' => __('Are you sure you want to delete # {0}?', $course->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Courses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="courses view large-9 medium-8 columns content">
    <h3><?= h($course->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($course->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($course->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sections') ?></h4>
        <?php if (!empty($course->sections)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Course Id') ?></th>
                <th><?= __('Semester Id') ?></th>
                <th><?= __('Ta User Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($course->sections as $sections): ?>
            <tr>
                <td><?= h($sections->id) ?></td>
                <td><?= h($sections->course_id) ?></td>
                <td><?= h($sections->semester_id) ?></td>
                <td><?= h($sections->ta_user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sections', 'action' => 'view', $sections->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sections', 'action' => 'edit', $sections->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sections', 'action' => 'delete', $sections->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sections->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
