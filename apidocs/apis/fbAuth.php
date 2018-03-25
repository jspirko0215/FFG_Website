<div class="api_method">
    <a name="fbAuth"></a>
    <h2>fbAuth</h2>
    <p>Authorization methods. Used to check if user with such facebook account exists and if it is - return information
        about it</p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/fbAuth"><?php echo $apidocs_base_url; ?>/api2/fbAuth</a>
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
            <td>facebook_id</td>
            <td>YES</td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>facebook_login</td>
            <td>YES</td>
            <td>string</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/fbAuth?facebook_id=1589635151&amp;facebook_login=user@mail.com
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
        <email>jspirko@fitforgreen.com</email>
        <active>1</active>
        <phone>(949) 768 - 6731</phone>
        <state>CA</state>
        <city>Mission Viejo</city>
        <facebook_id>1549327151</facebook_id>
        <facebook_token>
        AAAGBZCEqnPMoBABpS1B39sSxl5HcomsKiPRm1rNiO9ZAtX2nboZC8gEqmsZAmfZBkAw3lUoVL7iAdjV4I3ttRWZCRHxXJWpmIZD
        </facebook_token>
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