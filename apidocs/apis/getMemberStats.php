<div class="api_method">
    <a name="getMemberStats"></a>
    <h2>getMemberStats</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getMemberStats"><?php echo $apidocs_base_url; ?>
            /api2/getMemberStats</a></h4>
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
            <td>memberId</td>
            <td>YES</td>
            <td>integer</td>
            <td></td>
        </tr>
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
<?php echo $apidocs_base_url; ?>/api2/getMemberStats?memberId=1&fromDate=2012-01-05&endDate=2012-01-10
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <stats_set>
        <stats>
            <date>2012-01-05</date>
            <watt>9.93</watt>
        </stats>
        <stats>
            <date>2012-01-06</date>
            <watt>5.46</watt>
        </stats>
        <stats>
            <date>2012-01-07</date>
            <watt>93.16</watt>
        </stats>
        <stats>
            <date>2012-01-10</date>
            <watt>0.43</watt>
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