<?php $this->extend('/Common/course_sidebar'); ?>
<?php 
    $linkgroups[] = [
        'title' => 'Course \''.$course->name.'\'',
        'links' => [
            ['text' => 'Edit Course', 
             'url' => ['controller' => 'Courses', 
                       'action' => 'edit',
                       $course->id]],
            ['text' => 'Delete Course', 
             'url' => ['controller' => 'Courses', 
                       'action' => 'delete',
                       $course->id],
             'other' => ['confirm' => __('Are you sure you want to delete Course #{0}?', $course->id)]],
        ]];

    $this->set('linkgroups', $linkgroups);
?>
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
