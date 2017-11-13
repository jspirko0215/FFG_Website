<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body bgcolor="#F9F9F9">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            
            <tr>
                <td width="150">From:</td>
                <td><?php echo $first_name . ' ' . $last_name; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Address Street1: </td>
                <td><?php echo $street1; ?></td>
            </tr>
            <tr>
                <td>Address Street2: </td>
                <td><?php echo $street2; ?></td>
            </tr>
            <tr>
                <td>City: </td>
                <td><?php echo $city; ?></td>
            </tr>
            <tr>
                <td>Zipcode: </td>
                <td><?php echo $zipcode; ?></td>
            </tr>
            <tr>
                <td>State: </td>
                <td><?php echo $state; ?></td>
            </tr>
            <tr>
                <td>Phone1: </td>
                <td><?php echo $phone1; ?></td>
            </tr>
            <tr>
                <td>Phone2: </td>
                <td><?php echo $phone2; ?></td>
            </tr>
            <tr>
                <td>Comments: </td>
                <td><?php echo $comments; ?></td>
            </tr>
            <tr>
                <td align="left" height="60" colsapn="2">
                    Date: <?php echo( date('Y-m-d, H:i') ) ?>
                </td>
            </tr>
            <tr>
                <td height="60" colspan="2">
                    Administration:  <a href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a>
                </td>
            </tr>
            
        </table>

    </body>
</html>