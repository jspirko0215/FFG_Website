<div class="api_method">
    <a name="updateProfile"></a>
    <h2>updateProfile</h2>
    <p>Update user profile. If success - return user's updated fields (with user id).</p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/updateProfile"><?php echo $apidocs_base_url; ?>
            /api2/updateProfile</a></h4>
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
            <td>firstname</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>lastname</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>email</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>password</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>state</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>city</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>dob</td>
            <td></td>
            <td>date (YYYY-MM-DD)</td>
            <td></td>
        </tr>
        <tr>
            <td>phone</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>height</td>
            <td></td>
            <td>integer(2)</td>
            <td></td>
        </tr>
        <tr>
            <td>weight</td>
            <td></td>
            <td>integer(4)</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>
        /api2/updateProfile?memberId=6&firstname=Test&lastname=Test&password=123123&email=test@test.com&&state=CA&city=Irvine&phone=0123456789&dob=1965-10-19&height=66$weight=150
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <user>
        <firstName>Test</firstName>
        <lastName>Test</lastName>
        <email>test@test.com</email>
        <state>CA</state>
        <city>Irvine</city>
        <phone>0123456789</phone>
        <dob>1965-10-19</dob>
        <memberID>6</memberID>
        <height>66</height>
        <weight>150</weight>
    </user>
</response>
'); ?>
                            </pre>
    <pre>
                                <?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
    <error_set>
        <error field="user_id">User with such id is not exists</error>
        <error field="email">Such E-mail already taken</error>
    </error_set>
</error_response>
'); ?>
                            </pre>

    <br/><br/>

</div>