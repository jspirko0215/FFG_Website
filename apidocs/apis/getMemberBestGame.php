<div class="api_method">
    <a name="getMemberBestGame"></a>
    <h2>getMemberBestGame</h2>
    <p></p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/getMemberBestGame"><?php echo $apidocs_base_url; ?>
            /api2/getMemberBestGame</a></h4>
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
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/getMemberBestGame?memberId=1
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <stats_set>
        <stats>
            <lightTimeSeries>1,5,10,12,15,16,21,27,31,..... 100</lightTimeSeries>
            <gameCompleted>1</gameCompleted>
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