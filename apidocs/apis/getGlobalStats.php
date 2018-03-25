<div class="api_method">
    <a name="getGlobalStats"></a>
    <h2>getGlobalStats</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getGlobalStats"><?php echo $apidocs_base_url; ?>
            /api2/getGlobalStats</a></h4>

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
            <td>fromDate</td>
            <td></td>
            <td>date (YYYY-MM-DD)</td>
            <td></td>
        </tr>
        <tr>
            <td>endDate</td>
            <td></td>
            <td>date (YYYY-MM-DD)</td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getGlobalStats
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <stats_set>
        <stats>
            <date>2012-01-05</date>
            <watt>12.33</watt>
        </stats>
        <stats>
            <date>2012-01-06</date>
            <watt>94.55</watt>
        </stats>
        <stats>
            <date>2012-01-07</date>
            <watt>793.68</watt>
        </stats>
        <stats>
            <date>2012-01-08</date>
            <watt>856.83</watt>
        </stats>
        <stats>
            <date>2012-01-09</date>
            <watt>3033.32</watt>
        </stats>
        ...
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