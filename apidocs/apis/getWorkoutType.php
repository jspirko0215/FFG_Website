<div class="api_method">
    <a name="getWorkoutType"></a>
    <h2>getWorkoutType</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getWorkoutType"><?php echo $apidocs_base_url; ?>
            /api2/getWorkoutType</a></h4>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getWorkoutType?private=true
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <WorkoutType_set>
        <WorkoutType>
            <id>1</id>
            <name>type1</name>
            <description/>
        </WorkoutType>
        <WorkoutType>
            <id>2</id>
            <name>type2</name>
            <description/>
        </WorkoutType>
        <WorkoutType>
            <id>3</id>
            <name>type3</name>
            <description/>
        </WorkoutType>
    </WorkoutType_set>
</response>
'); ?>
                            </pre>
    <pre>
                                <?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
   <error_set>
        <error>Data not found</error>
    </error_set>
</error_response>
'); ?>
                            </pre>

    <br/><br/>

</div>