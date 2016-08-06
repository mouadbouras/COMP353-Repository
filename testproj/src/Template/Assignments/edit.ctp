<?php $this->extend('/Common/section_view_sidebar'); ?>


<div class="row"> 
    <div class="col-xs-12 submit-file-form">
    <?= $this->Form->create($assignment) ?>
    <fieldset>
        <legend><?= __('Edit Assignment') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('section_id', ['options' => $sections]);
            echo $this->Form->input('due_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
