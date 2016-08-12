<?php $this->extend('/Common/section_view_sidebar'); ?>

<?php 
    if($canEdit):
        $linkgroups[] = [
            'title' => 'Team \''.$team->id.'\'',
            'links' => [
                ['text' => 'Edit Team', 
                 'url' => ['controller' => 'Teams', 
                           'action' => 'edit',
                           $team->id]],
                ['text' => 'Delete Team', 
                 'url' => ['controller' => 'Teams', 
                           'action' => 'delete',
                           $team->id],
                 'other' => ['confirm' => __('Are you sure you want to delete Team {0}?', $team->id)]],
                ['text' => 'Add a Member', 
                 'url' => ['controller' => 'Students', 
                           'action' => 'memberSelect',
                           $team->id]],
            ]];
        $this->set('linkgroups', $linkgroups);
    endif;
?>

<span class='bold'>Course Group</span><br>
<?php 
    if($isInGroup){
        echo 'You are currently in this group.';
    }
?>
<hr>

<?= $this->Flash->render() ?>

<h3><?= "Team " . h($team->id) ?></h3>
<table>
    Members
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
        <?php if($canEdit): ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>
    <?php foreach($students as $student): ?>
        <tr>
            <td><?= $student->user->id ?></td>
            <td><?= $student->user->first_name ?></td>
            <td><?= $student->user->last_name ?></td>
            <td><?= $student->user->email ?></td>
            <td><?= ($student->user->id == $team->leader_user_id)?'Leader':'-' ?></td>
            <?php if($canEdit): ?>
                <td>
                    <?= $this->Html->link('Remove from Team',
                            ['controller' => 'Students', 
                             'action' => 'clearTeam',
                             $student->user->id,
                             $team->section->id],
                             ['confirm' => __('Are you sure you want to remove \'{0} {1}\' from Team {2}?', $student->user->first_name, $student->user->last_name, $team->id)]) ?>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>

<br />

<h3><?= "Team " . h($team->id) . " Interactions"?></h3>
<table>
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Role</th>
        <th>Submitted Files</th>
        <th>Contribution Rate</th>
        <th>Downloads</th>
        <th>Total Interactions</th>
        <th>Total Size Changes</th>
    </tr>

    <?php foreach($students as $student): ?>
        <tr>
            <td><?= $student->user->id ?></td>
            <td><?= $student->user->first_name ?></td>
            <td><?= $student->user->last_name ?></td>
            <td><?= ($student->user->id == $team->leader_user_id)?'Leader':'-' ?></td>
            <td><?= floatval($contributions[$student->user->id]) ?></td>
            <td><?= ($totalTeamSubmissions==0) ? 0 . "%" : number_format(floatval($contributions[$student->user->id]/$totalTeamSubmissions ) * 100 , 2) . "%" ?></td>
            <td><?= $downloads[$student->user->id] ?></td>
            <td><?= $contributions[$student->user->id] + $downloads[$student->user->id] ?></td>


                <td 
                <?= ($sizechanges[$student->user->id] > 0)?'style="color: lime"':'' ?>
                <?= ($sizechanges[$student->user->id] < 0)?'style="color: red"':'' ?>>
                    <?= (($sizechanges[$student->user->id] > 0)?'+':'').h($sizechanges[$student->user->id] / 1000) . "KB" ?>
                </td>
        </tr>
    <?php endforeach; ?>

</table>

<br />

    
    <?php 
        echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>';
        ?>

        <script type="text/javascript">
           
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

              // Create the data table.
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Name');
              data.addColumn('number', 'Contributions');
              data.addRows([
            <?php foreach($students as $student): 
                echo "['" . $student->user->first_name . "'," . intval($contributions[$student->user->id]) .  "],";
                endforeach;
            ?>
                
              ]);

              // Set chart options
              var options = {'title': 'Team <?= $team->id ?> contributions' ,
                             'width':600,
                             'height':450};

              // Instantiate and draw our chart, passing in some options.
              var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
              chart.draw(data, options);
        }

        </script>


    <div id="chart_div"></div>
