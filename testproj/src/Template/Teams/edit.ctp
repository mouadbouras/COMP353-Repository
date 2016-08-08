<?php $this->extend('/Common/section_view_sidebar'); ?>

<?php 
    $linkgroups[] = [
        'title' => 'Team \''.h($team->id).'\'',
        'links' => [
            ['text' => 'View Team', 
             'url' => ['controller' => 'Teams', 
                       'action' => 'view',
                       $team->id]],
            ['text' => 'Delete Team', 
             'url' => ['controller' => 'Teams', 
                       'action' => 'delete',
                       $team->id],
             'other' => ['confirm' => __('Are you sure you want to delete Team {0}?', $team->id)]],
        ]];
    $this->set('linkgroups', $linkgroups);
?>
<?= $this->Flash->render() ?>


    <div class="teams form large-9 medium-8 columns content custom-form">

        <?= $this->Form->create($team) ?>
        <fieldset>
            <legend><?= __('Edit Team '.$team->id) ?></legend>
            <?php
                echo $this->Form->input('leader_user_id', ['options' => $users, 'empty' => true]);
                echo $this->Form->input('size_limit', ['empty' => true]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>

