<?php $this->extend('/Common/course_sidebar'); ?>

    <?= $this->Form->create($course) ?>
    <fieldset>
        <legend><?= __('Add Course') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
