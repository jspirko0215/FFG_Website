<div class="api_method">
    <a name="getMemberVisits"></a>
    <h2>getMemberVisits</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getMemberVisits"><?php echo $apidocs_base_url; ?>
            /api2/getMemberVisits</a></h4>
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
<?php echo $apidocs_base_url; ?>/api2/getMemberVisits?memberId=1&fromDate=2012-01-05&endDate=2012-01-10
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <visit_set>
        <visit>
            <date>2012-01-05 00:55:20</date>
            <watt>6.60</watt>
        </visit>
        <visit>
            <date>2012-01-05 21:33:58</date>
            <watt>3.33</watt>
        </visit>
        <visit>
            <date>2012-01-06 10:29:52</date>
            <watt>1.32</watt>
        </visit>
        <visit>
            <date>2012-01-06 18:16:14</date>
            <watt>2.16</watt>
        </visit>
        <visit>
            <date>2012-01-06 19:15:06</date>
            <watt>1.98</watt>
        </visit>
        <visit>
            <date>2012-01-07 11:52:26</date>
            <watt>1.48</watt>
        </visit>
        <visit>
            <date>2012-01-07 18:00:18</date>
            <watt>91.68</watt>
        </visit>
    </visit_set>
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