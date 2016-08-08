<?php $this->extend('/Common/course_sidebar'); ?>

<?= $this->Flash->render() ?>

<div class="courses form large-9 medium-8 columns content custom-form">
    <?= $this->Form->create($course) ?>
    <fieldset>
        <legend><?= __('Edit Course') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
