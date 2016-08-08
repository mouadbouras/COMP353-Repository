<?= $this->Flash->render() ?>

<div class="submissions form large-9 medium-8 columns content">
    <?= $this->Form->create($submission) ?>
    <fieldset>
        <legend><?= __('Edit Submission') ?></legend>
        <?php
            echo $this->Form->input('assignment_id', ['options' => $assignments]);
            echo $this->Form->input('team_id', ['options' => $teams]);
            echo $this->Form->input('file_id', ['options' => $files]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
