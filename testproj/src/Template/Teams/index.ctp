<?php $this->extend('/Common/section_view_sidebar'); ?>

    <h3><?= __('Teams') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>Name</th>
                <?php if($editable): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($teams as $team): ?>
            <tr>
                <td><?= $this->Html->link('Team '.h($team->id), ['action' => 'view', $team->id]) ?></td>
                <?php if($editable): ?>
                    <td>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $team->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $team->id], ['confirm' => __('Are you sure you want to delete # {0}?', $team->id)]) ?>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br><br>
<?php if($canArchive){ ?>
    This course has now ended.<br>
    Would you like to archive the group files?<br>
    <?= $this->Html->link('Archive Files', 
        ['controller' => 'Sections', 'action' => 'archiveFiles', $section->id],
        ['class' => 'btn btn-warning',
         'confirm' => __('Are you sure you want to archive all files for Section {0}? This will move all the files for all teams in the section to the archive.', $section->id)]); ?>
<?php } ?>