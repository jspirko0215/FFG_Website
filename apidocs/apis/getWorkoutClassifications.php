<div class="api_method">
    <a name="getWorkoutClassifications"></a>
    <h2>getWorkoutClassifications</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getWorkoutClassifications"><?php echo $apidocs_base_url; ?>
            /api2/getWorkoutClassifications</a></h4>


    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getWorkoutClassifications
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
   <WorkoutClassification_set>
        <WorkoutClassification>
            <id>1</id>
            <name>RR Reclaimed</name>
            <description>
            This is the power output from ReRev Fit for Green in-gym collection
            </description>
        </WorkoutClassification>
        <WorkoutClassification>
            <id>2</id>
            <name>TGR Reclaimed</name>
            <description>
            This is the power output from The Green Revolution Fit for Green in-gym collection
            </description>
        </WorkoutClassification>
        <WorkoutClassification>
            <id>3</id>
            <name>SA Reclaimed</name>
            <description>
            This is the power output from SportsArt Fit for Green in-gym collection
            </description>
        </WorkoutClassification>
        <WorkoutClassification>
            <id>4</id>
            <name>PO Reclaimed</name>
            <description>
            This is the power output from Plug Out Fitness Fit for Green in-gym collection
            </description>
        </WorkoutClassification>
        <WorkoutClassification>
            <id>5</id>
            <name>Manual Entry</name>
            <description>
            A manual workout entry entered from mobile on website
            </description>
        </WorkoutClassification>
        <WorkoutClassification>
            <id>6</id>
            <name>FB Monitor</name>
            <description>FitBit Monitor input</description>
        </WorkoutClassification>
        <WorkoutClassification>
            <id>7</id>
            <name>PH Monitor</name>
            <description>Ploar heart monitor input</description>
        </WorkoutClassification>
    </WorkoutClassification_set>
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