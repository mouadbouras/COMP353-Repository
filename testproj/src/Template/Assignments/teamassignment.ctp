<?php $this->extend('/Common/section_view_sidebar'); ?>

<?= $this->Flash->render() ?>


<div class="row">
<div class=" col-xs-12 ">
    <?php if ($sectionid!=null && $assignmentid != null && $teamid == null){ ?>
        <h3><?= h('Select Team') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <th><?= h('Team name') ?></th>
            </thead>
            <tbody>
                <?php foreach ($teams as $team): ?>
                    <tr>
                        <td>  <?= $this->Html->link(__('Team ' . $team->id), ['action' => 'teamassignment', $section->id, $assignmentid , $team->id]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
    <?php } else if ($sectionid!=null && $assignmentid != null && $teamid != null){?>
        <h3><?= h('Viewing Assignment') ?></h3>
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
        <br />
    <h3><?= __('Team ' . $teamid . ' Active Submission') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= h('File') ?></th>
                <th><?= h('Checksum') ?></th>
                <th><?= h('IP Address') ?></th>
                <th><?= h('Size') ?></th>


                <th><?= h('Version') ?></th>
                <th><?= h('Submission Date') ?></th>
                <th><?= h('File') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($active_submission!= null) {?>
                <tr <?=  ($active_submission->is_deleted == 0) ? ""  :  "class='deleted'" ; ?> >
                <td><?= h($active_submission->file->name) ?></td>

                <td><?= h($active_submission->file->checksum) ?></td>
                <td><?= h($active_submission->file->ip_address) ?></td>
                <td><?= h($active_submission->file->size_bytes / 1000) . "KB" ?></td>

                <td><?= h($active_submission->file->version_number) ?></td>
                <td><?= h($active_submission->file->upload_date) ?></td>
                <td><?= $this->Html->link($active_submission->file->name, ['action' => 'download' , $active_submission->file->file_name ] ); ?></td>
                </tr>
                <?php }  ?>
            </tbody>
        </table>


        <br />

        <h3><?= __('Team ' . $teamid . ' Submission History') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th><?= h('File') ?></th>

                    <th><?= h('Checksum') ?></th>
                    <th><?= h('IP Address') ?></th>
                    <th><?= h('Size') ?></th>


                    <th><?= h('Version') ?></th>
                    <th><?= h('Submission Date') ?></th>
                    <th><?= h('File') ?></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($submissions as $submission): ?>
                <tr <?=  ($submission->is_deleted == 0) ? ""  :  "class='deleted'" ; ?> >
                    <td><?= h($submission->file->name) ?></td>

                    <td><?= h($submission->file->checksum) ?></td>
                    <td><?= h($submission->file->ip_address) ?></td>
                    <td><?= h($submission->file->size_bytes / 1000) . "KB" ?></td>

                    <td><?= h($submission->file->version_number) ?></td>
                    <td><?= h($submission->file->upload_date) ?></td>
                    <td><?= $this->Html->link(h($submission->file->name), ['action' => 'download' , $submission->file->file_name ] ); ?></td>
                </tr>

                <?php endforeach;  ?>
            </tbody>
        </table>
        <br />



    <?php } else {?>
        <h3><?= h('Nothing to show') ?></h3>
    <?php }?>

</div>
</div>



