<div class="api_method">
    <a name="getDetailedStats"></a>
    <h2>getDetailedStats</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getDetailedStats"><?php echo $apidocs_base_url; ?>
            /api2/getDetailedStats</a></h4>
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
            <td>date</td>
            <td>YES</td>
            <td>date (YYYY-MM-DD)</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getDetailedStats?date=2012-01-05
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <stats_set>
        <stats>
            <hour>00:00:00</hour>
            <watt>6.60</watt>
        </stats>
        <stats>
            <hour>01:00:00</hour>
            <watt>0</watt>
        </stats>
        <stats>
            <hour>02:00:00</hour>
            <watt>0</watt>
        </stats>
        <stats>
            <hour>03:00:00</hour>
            <watt>0</watt>
        </stats>
        <stats>
            <hour>04:00:00</hour>
            <watt>0</watt>
        </stats>
        <stats>
            <hour>05:00:00</hour>
            <watt>0</watt>
        </stats>
        <stats>
            <hour>06:00:00</hour>
            <watt>0</watt>
        </stats>
        ...
        <stats>
            <hour>21:00:00</hour>
            <watt>5.73</watt>
        </stats>
        <stats>
            <hour>22:00:00</hour>
            <watt>0</watt>
        </stats>
        <stats>
            <hour>23:00:00</hour>
            <watt>0</watt>
        </stats>
    </stats_set>
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