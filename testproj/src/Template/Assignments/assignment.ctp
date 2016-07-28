<div class="assignments form large-9 medium-8 columns content">
        <h3><?= h('View Assignment') ?></h3>
            <table class="vertical-table">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($assignment->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Due Date') ?></th>
                    <td><?= h($assignment->due_date) ?></td>
                </tr>          
            </table>
</div>

<div class="assignments index large-12 medium-8 columns content">
    <h3><?= __('Submissions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= h('Assignment') ?></th>
                <th><?= h('Team') ?></th>
                <th><?= h('File') ?></th>
                <th><?= h('Version') ?></th>
                <th><?= h('Submission Date') ?></th>
                <th><?= h('File') ?></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($submissions as $submission): ?>
            <tr>
                <td><?= h($submission->assignment_id) ?></td>
                <td><?= h($submission->team_id) ?></td>
                <td><?= h($submission->file->name) ?></td>
                <td><?= h($submission->file->version_number) ?></td>
                <td><?= h($submission->file->upload_date) ?></td>
                <td><?= $this->Html->link($submission->file->name, ['action' => 'download' , $submission->file->file_name, $submission->file->name ] ); ?></td>

            </tr>

            <?php endforeach;  ?>
        </tbody>
    </table>
</div>

<div class="assignments form large-12 medium-8 columns content">
    <?= $this->Form->create($file,['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <legend><?= __('New Submission') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('version_number');
            echo $this->Form->input('submission_file',['type' => 'file']);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>


<div class="assignments index large-12 medium-8 columns content" ></div>