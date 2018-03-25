<div class="api_method">
    <a name="getGyms"></a>
    <h2>getGyms</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getGyms"><?php echo $apidocs_base_url; ?>/api2/getGyms</a>
    </h4>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getGyms
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <gym_set>
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
        <gym>
            <gymName>Suite "G"</gymName>
            <gymID>2</gymID>
            <fullBillingAddress>FFG Test Center</fullBillingAddress>
            <city>Mission Viejo</city>
            <state>CA</state>
            <country>USA</country>
            <authKey>123</authKey>
            <posLongitude>328</posLongitude>
            <posLatitude>471</posLatitude>
            <mapPosition>19x20</mapPosition>
        </gym>
        <gym>
            <gymName>CSUF Earth Day</gymName>
            <gymID>3</gymID>
            <fullBillingAddress>Fullerton</fullBillingAddress>
            <city>Fullerton</city>
            <state>CA</state>
            <country>US</country>
            <authKey>123</authKey>
            <posLongitude>330</posLongitude>
            <posLatitude>469</posLatitude>
            <mapPosition>16x11</mapPosition>
        </gym>
    </gym_set>
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