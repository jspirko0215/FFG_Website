<table class="datatable">
    <thead>

     <tr>
      <th>Date</th>
      <th>Gym</th>
      <th>Duration</th>
      <th>W/h</th>
      <th>Calories</th>
     </tr>
    </thead>
    <tbody>
        <?php foreach($visits as $visit):?>
        <tr>
            <td><?php echo date('m/d/Y H:i',  strtotime($visit['visitDate']));?></td>
            <td><?php echo $visit['gymName'];?></td>
            <td><?php echo (int)($visit['workoutDurationSeconds']/60);?> m</td>
            <td><?php echo $visit['wattHours'];?></td>
            <td><?php echo $visit['calories'];?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
   </table>