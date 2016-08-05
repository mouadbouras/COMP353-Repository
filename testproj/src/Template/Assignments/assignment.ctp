<?php $this->extend('/Common/section_view_sidebar'); ?>

<?= $this->Flash->render() ?>

<div class="row">
<div class=" col-xs-12 ">
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

                <tr>
                    <th><?= __('New Submission') ?></th>
                    <td><?= $this->Html->link(__('Submit'), ['action' => 'submit' , $assignment->id ] );  ?></td>
                </tr>    
                <tr>
                    <th><?= __('Deleted') ?></th>
                    <td><?= $this->Html->link(__(($showdeleted == 0) ? "Show" : "Hide" ), ['action' => 'assignment' , $assignment->id ,
                     ($showdeleted == 0) ? 1 : 0 ] );  ?></td>
                </tr>  

            </table>
    <br />
    <h3><?= __('Submissions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
<!--                 <th><?// h('Assignment') ?></th>
 -->                
                <!-- <th><?// h('Team') ?></th> -->
                <th><?= h('File') ?></th>

                <th><?= h('Checksum') ?></th>
                <th><?= h('IP Address') ?></th>
                <th><?= h('Size') ?></th>


                <th><?= h('Version') ?></th>
                <th><?= h('Submission Date') ?></th>
                <th><?= h('File') ?></th>
                <th><?= h('Delete/Recover')?></th>

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
                <td><?= $this->Html->link($submission->file->name, ['action' => 'download' , $submission->file->file_name ] ); ?></td>
                <?=  ($submission->is_deleted == 0) ? 
                     "<td>" .
$this->Form->postLink(__('Delete'), ['action' => 'delete', $submission->file->id, $submission->assignment_id], ['confirm' => __('Are you sure you want to delete {0}?', $submission->file->name)]) .
                     "</td>"  
                     :  
                     "<td> " . $this->Form->postLink(__('Recover'), 
                               ['action' => 'recover' , $submission->file->id, $submission->assignment_id], ['confirm' => __('Are you sure you want to recover {0}?', $submission->file->name)]) . "</td>" ; ?>

            </tr>

            <?php endforeach;  ?>
        </tbody>
    </table>
    <br />

</div>
</div>


</div>

