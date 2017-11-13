<table class="chart" data-fill="true" data-tooltip-pattern="%1 %2 on %3" data-xaxis-label="0px" data-xaxis-color="#fff" data-colors="[#0a86c1, #49b302]" data-line-width="1" data-points="false">
    <thead>
        <tr>
            <th></th>
            <?php foreach($visits as $visit):?>
                 <th><?php echo date('m/d/Y H:i',  strtotime($visit['visitDate']));?></th>
            <?php endforeach;?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Calories</th>
            <?php foreach($visits as $visit):?>
                 <td><?php echo $visit['calories'];?></td>
            <?php endforeach;?>
        </tr>
        <tr>
            <th>Watt/Hours</th>
            <?php foreach($visits as $visit):?>
                 <td><?php echo $visit['wattHours'];?></td>
            <?php endforeach;?>
        </tr>
        
    </tbody>
</table>