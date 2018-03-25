<div class="api_method">
    <a name="logGame"></a>
    <h2>logGame</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/logGame"><?php echo $apidocs_base_url; ?>/api2/logGame</a>
    </h4>
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
            <td>lightTimeSeries</td>
            <td>YES</td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>gameDurationSeconds</td>
            <td>YES</td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>gameType</td>
            <td>YES</td>
            <td>string</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>
        /api2/logGame?memberID=1&lightTimeSeries="1,2,3,4,6,9,22,33,44,55,66,77,88,90,100"&gameDurationSeconds=810&gameType="SinglePlayer"
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
  <logGame>
    <memberID>1</memberID>
    <lightTimeSeries>"1,2,3,4,6,9,22,33,44,55,66,77,88,90,100"</lightTimeSeries>
    <gameDurationSeconds>810</gameDurationSeconds>
    <gameType>"SinglePlayer"</gameType>
    <gameDate>2018-03-03 16:25:13</gameDate>
  </logGame>
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