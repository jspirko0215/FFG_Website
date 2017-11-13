<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body bgcolor="#F9F9F9">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            
            <tr>
                <td width="150">From:</td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Message: </td>
                <td><?php echo $message; ?></td>
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