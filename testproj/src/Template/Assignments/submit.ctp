<?php $this->extend('/Common/section_view_sidebar'); ?>

<?= $this->Flash->render() ?>

<div class="row"> 
    <div class="col-xs-12 custom-form">
        <?= $this->Form->create($file,['enctype' => 'multipart/form-data']) ?>
        <fieldset>
            <legend><?= __('New Submission') ?></legend>
            <?php
                echo $this->Form->input('name');
                //echo $this->Form->input('version_number');
                echo $this->Form->input('submission_file',['type' => 'file']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
</div>

