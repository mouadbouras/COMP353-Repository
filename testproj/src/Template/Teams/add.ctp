<?php $this->extend('/Common/section_view_sidebar'); ?>
<div class="teams form large-9 medium-8 columns content">
    <?= $this->Form->create($team) ?>
    <fieldset>
        <legend><?= __('Add Team') ?></legend>
        <?php
            echo $this->Form->input('leader_user_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->input('section_id', ['options' => $sections, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
