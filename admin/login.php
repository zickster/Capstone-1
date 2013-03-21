<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="includes/css.css" type="text/css">
<title>Log In</title>
<?php
//Create session variables 
	session_start();
//Import header file
        require('header1.php');
?>
</head>

<body>
<div class="container">

                        <form method="post" action="index.php">
                        <table border="1">
                                <tr>
                                        <td align="center"><b>User Log In</b></td>
                                </tr>
				<tr>
				</tr>
                                <tr>
                                        <td>
                                                <table>
                                                        <tr>
                                                                <td align="right">Email Address:&nbsp;</td><td align="left"><input type="text" name="username" size="25"></td>
                                                        </tr>
                                                        <tr>
                                                                <td align="right">Password:&nbsp;<td align="left"><input type="password" name="password" size="25"></td>
                                                        </tr>
                                                        <tr>
                                                                <td>&nbsp;</td><td><input type="submit" name="submit" value="Log In" class="button"></td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                        </table>
                        </form>
</div>
</body>
</html>
