<?php $this->extend('/Common/section_sidebar'); ?>
<?= $this->Flash->render() ?>

<div class="sections form large-10 medium-6 columns content custom-form">
    <?= $this->Form->create($section) ?>
    <fieldset>
        <legend><?= __('Add Section') ?></legend>
        <?php
            echo $this->Form->input('course_id', ['options' => $courses]);
            echo $this->Form->input('semester_id', ['options' => $semesters]);
            echo $this->Form->input('ta_user_id', ['options' => $users, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
