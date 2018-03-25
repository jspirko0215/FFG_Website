<div class="api_method">
    <a name="getGymInfo"></a>
    <h2>getGymInfo</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getGymInfo"><?php echo $apidocs_base_url; ?>
            /api2/getGymInfo</a></h4>
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
            <td>gymId</td>
            <td>YES</td>
            <td>integer</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getGymInfo?gymId=1
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <gym>
        <gymName>UCI ARC</gymName>
        <gymID>1</gymID>
        <fullBillingAddress>680 California Ave</fullBillingAddress>
        <city>Irvine</city>
        <state>CA</state>
        <country>USA</country>
        <authKey>123</authKey>
        <posLongitude>329</posLongitude>
        <posLatitude>471</posLatitude>
        <mapPosition>15x10</mapPosition>
    </gym>
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