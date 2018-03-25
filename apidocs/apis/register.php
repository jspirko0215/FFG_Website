<div class="api_method">
    <a name="register"></a>
    <h2>register</h2>
    <p>Register a new users. If success - return newly created user record (with user id).</p>
    <h4>URL: <a href="<?php echo $apidocs_base_url; ?>/api2/register"><?php echo $apidocs_base_url; ?>/api2/register</a>
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
        <tr>
            <td>email</td>
            <td>YES</td>
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
            <td>height</td>
            <td></td>
            <td>float</td>
            <td></td>
        </tr>
        <tr>
            <td>weight</td>
            <td></td>
            <td>float</td>
            <td></td>
        </tr>
        <tr>
            <td>sex</td>
            <td></td>
            <td>string (male/female)</td>
            <td></td>
        </tr>
        <tr>
            <td>zip</td>
            <td></td>
            <td>integer(5)</td>
            <td></td>
        </tr>
        <tr>
            <td>facebook_id</td>
            <td></td>
            <td>integer</td>
            <td></td>
        </tr>
        <tr>
            <td>facebook_login</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        <tr>
            <td>facebook_token</td>
            <td></td>
            <td>string</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <h4>REQUEST</h4>
    <pre>
<?php echo $apidocs_base_url; ?>/api2/register?username=test&password=123123&email=test1@test1.com&zip=90210
                            </pre>
    <h4>RESPONSE</h4>
    <pre><?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <user>
        <username>test</username>
        <email>test1@test1.com</email>
        <gymID>0</gymID>
        <memberID>340</memberID>
    </user>
</response>
'); ?>
                            </pre>
    <pre>
                                <?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
    <error_set>
        <error field="username">Such Username already exists</error>
        <error field="email">Such E-mail already exists</error>
    </error_set>
</error_response>
'); ?>
                            </pre>

    <br/><br/>

</div>