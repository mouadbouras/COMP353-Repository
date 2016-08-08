<?php $this->extend('/Common/course_sidebar'); ?>

<?= $this->Flash->render() ?>

<div class="row"> 
    <div class="col-xs-12 custom-form">
    <?= $this->Form->create($course) ?>
    <fieldset>
        <legend><?= __('Add Course') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>