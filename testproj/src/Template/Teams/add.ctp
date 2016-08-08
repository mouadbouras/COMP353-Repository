<?php $this->extend('/Common/section_view_sidebar'); ?>
<?= $this->Flash->render() ?>

<div class="teams form large-9 medium-8 columns content custom-form">

    <?= $this->Form->create($team) ?>
    <fieldset>
        <legend><?= __('Are you sure you want to add a team to section ' . $section->id . '?') ?></legend>
        <?php
           // echo $this->Form->select('leader_user_id', ['options' => $students->user_id, 'empty' => true]);
            //echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Create')) ?>
    <?= $this->Form->end() ?>
</div>
