<div class="api_method">
    <a name="auth"></a>
    <h2>auth</h2>
    <p>Authorization methods. Used to check if user exists and if it is - return information about it</p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/auth"><?php echo $apidocs_base_url; ?>/api2/auth</a></h4>
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
            <td>username</td>
            <td>YES</td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>password</td>
            <td>YES</td>
            <td>string</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/auth?username=john&amp;password=123456
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <user>
        <memberID>1</memberID>
        <username>jspirko</username>
        <gymID>1</gymID>
        <firstName>John</firstName>
        <lastName>Spirko</lastName>
        <dob>2012-02-24</dob>
        <email>jspirko@fitapi.appteka.net</email>
        <active>1</active>
        <phone>(949) 768 - 6731</phone>
        <state>CA</state>
        <city>Mission Viejo</city>
        <facebook_id>1549327151</facebook_id>
        <facebook_token>AAACsZACr7RBUBAAsZBmRLoqSyK6GupZC2leF6cnAiLS3jFepQR3ZBMJTVpeE0ZAKHCgOcHrzGNciOkYpuxBpAq8ib8wPlAy3dYY3vmFxY7gZDZD</facebook_token>
        <facebook_login>john.spirko@quest.com</facebook_login>
        <avatar>ce786e232c1fab8b3a94770b806c7a17.jpg</avatar>
    </user>
</response>
'); ?>
                            </pre>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
    <error_set>
        <error>User not found</error>
    </error_set>
</error_response>
'); ?>
                            </pre>
    <br/>
    <hr/>
    <br/>
</div>