<div class="api_method">
    <a name="logWorkout"></a>
    <h2>logWorkout</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/logWorkout"><?php echo $apidocs_base_url; ?>
            /api2/logWorkout</a></h4>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th style="width: 190px;">Parameter</th>
            <th style="width: 70px;">Required</th>
            <th style="width: 150px;">Type</th>
            <th>Definition</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>memberID</td>
            <td>YES</td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>gymID</td>
            <td></td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>wattHours</td>
            <td></td>
            <td>decimal</td>
            <td></td>
        </tr>
        <tr>
            <td>calories</td>
            <td></td>
            <td>decimal</td>
            <td></td>
        </tr>
        <tr>
            <td>workoutDurationSeconds</td>
            <td></td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>machinePosition</td>
            <td></td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>workoutTypeID</td>
            <td></td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>workoutClassificationID</td>
            <td></td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>workoutTypeOther</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>powerTimeSeries</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>revolutionTimeSeries</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/logWorkout?memberID=1&gymID=1&wattHours=23&calories=2&workoutDurationSeconds=34
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <logWorkout>
        <memberID>1</memberID>
        <gymID>1</gymID>
        <wattHours>23</wattHours>
        <calories>2</calories>
        <workoutDurationSeconds>34</workoutDurationSeconds>
    </logWorkout>
</response>
'); ?>
                            </pre>
    <pre>
                                <?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
   <error_set>
        <error>Error</error>
    </error_set>
</error_response>
'); ?>
                            </pre>

    <br/><br/>

</div>