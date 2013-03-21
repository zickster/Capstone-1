<!DOCTYPE html>
<?php

        // this auto-magically inserts header.html here
        require('header.php');
        //Include db details and credentials
        include('../includes/db.php');


//added php-mysql security
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));

$iresults = mysqli_query($db, "SELECT * FROM institutions WHERE id='$id'");
                                        $irow = mysqli_fetch_array($iresults);
$name=$irow['name'];



        if(isset($_POST['submit'])){
//Added sql security to prevent sql injections  
        $add1 = mysqli_real_escape_string($db, strip_tags($_POST['add1']));
        $add2 = mysqli_real_escape_string($db, strip_tags($_POST['add2']));
        $city = mysqli_real_escape_string($db, strip_tags($_POST['city']));
        $state = mysqli_real_escape_string($db, strip_tags($_POST['state']));
        $zip = mysqli_real_escape_string($db, strip_tags($_POST['zip']));
        $phone = mysqli_real_escape_string($db, strip_tags($_POST['phone']));
        $pop = mysqli_real_escape_string($db, strip_tags($_POST['pop']));
        $hour = mysqli_real_escape_string($db, strip_tags($_POST['hour']));
        $nr_hour = mysqli_real_escape_string($db, strip_tags($_POST['nr_hour']));
        $books = mysqli_real_escape_string($db, strip_tags($_POST['books']));
        $rb = mysqli_real_escape_string($db, strip_tags($_POST['rb']));
        $gpa_summer_mid = mysqli_real_escape_string($db, strip_tags( $_POST['gpa_summer_mid']));
        $gpa_fall_mid = mysqli_real_escape_string($db, strip_tags( $_POST['gpa_fall_mid']));
        $sat_summer_mid =  mysqli_real_escape_string($db, strip_tags( $_POST['sat_summer_mid']));
        $sat_fall_mid = mysqli_real_escape_string($db, strip_tags( $_POST['sat_fall_mid']));
        $act_summer_mid = mysqli_real_escape_string($db, strip_tags( $_POST['act_summer_mid']));
        $act_fall_mid = mysqli_real_escape_string($db, strip_tags( $_POST['act_fall_mid']));
        $mascot = mysqli_real_escape_string($db, strip_tags( $_POST['mascot']));
        $ap_credits = mysqli_real_escape_string($db, strip_tags( $_POST['ap_credits']));
        $application = mysqli_real_escape_string($db, strip_tags( $_POST['application']));
        $app_deadline = mysqli_real_escape_string($db, strip_tags( $_POST['app_deadline']));
	$link = mysqli_real_escape_string($db, strip_tags( $_POST['link']));

//Write values to DB
	mysqli_query($db, "UPDATE institutions SET s_address='$add1', s_address2='$add2', city='$city', state='$state', zip='$zip', phone='$phone', population='$pop', gpa_summer_mid='$gpa_summer_mid', gpa_fall_mid='$gpa_fall_mid', sat_summer_mid='$sat_summer_mid', sat_fall_mid='$sat_fall_mid', act_summer_mid='$act_summer_mid', act_fall_mid='$act_fall_mid', mascot='$mascot', ap_credits='$ap_credits', app_deadline='$app_deadline', link='$link' WHERE name='$name'");
	mysqli_query($db, "UPDATE cost SET hour='$hour', books='$books', housing='$rb', nr_hour='$nr_hour', application='$application' WHERE institution='$name'");
        mysqli_close($db);

        header('Location: index.php');
        exit();

        }
//Return to previous page
        if(isset($_POST['back'])){

                header('Location: edit_institutions.php');
                exit();

                }
//Return to home page
        if(isset($_POST['exit'])){

                header('Location: index.php');
                exit();

                }


?>
<html>
<head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../includes/main.css" type="text/css">


</head>
<body>
<div class="container">

        <table border="1">
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM institutions WHERE name='$name'");
                                        $trow = mysqli_fetch_array($tresults);
			$sresults = mysqli_query($db, "SELECT * FROM cost WHERE institution='$name'");
                                        $srow = mysqli_fetch_array($sresults);
?>
                 <tr>
                        <th><h2><?php echo $name ?></h2></th>
                </tr>
                <tr>
                        <table border="1">
 <form method="post" action="<?php echo $PHP_SELF;?>">

                                                <tr><td>Street Address 1:</td><td><input type="text" name="add1" value="<?php echo $trow['s_address']?>"></td></tr>
                                                <tr><td>Street Address 2:</td><td><input type="text" name="add2" value="<?php echo $trow['s_address2']?>"></td></tr>
                                                <tr><td>City:</td><td><input type="text" name="city" value="<?php echo $trow['city']?>"></td></tr>
                                                <tr><td>State:</td><td><input type="text" name="state" value="<?php echo $trow['state']?>"></td></tr>
                                                <tr><td>Zip Code:</td><td><input type="text" name="zip" value="<?php echo $trow['zip']?>"></td></tr>
                                                <tr><td>Phone Number:</td><td><input type="text" name="phone" value="<?php echo $trow['phone']?>"></td></tr>
                                                <tr><td>Student Population:</td><td><input type="text" name="pop" value="<?php echo $trow['population']?>"></td></tr>
                                                <tr><td>In-State cost for 30 hours:</td><td><input type="text" name="hour" value="<?php echo $srow['hour']?>"></td></tr>
                                                <tr><td>Out-of-State cost for 30 hours:</td><td><input type="text" name="nr_hour" value="<?php echo $srow['nr_hour']?>"></td></tr>
                                                <tr><td>Estimate room and board cost:</td><td><input type="text" name="rb" value="<?php echo $srow['housing']?>"></td></tr>
                                                <tr><td>Estimate text book cost:</td><td><input type="text" name="books" value="<?php echo $srow['books']?>"></td></tr>
                                                <tr><td>GPA Summer Mid:</td><td><input type="text" name="gpa_summer_mid" value="<?php echo $trow['gpa_summer_mid']?>"></td></tr>
                                                <tr><td>GPA Fall Mid:</td><td><input type="text" name="gpa_fall_mid" value="<?php echo $trow['gpa_fall_mid']?>"></td></tr>
                                                <tr><td>SAT Summer Mid:</td><td><input type="text" name="sat_summer_mid" value="<?php echo $trow['sat_summer_mid']?>"></td></tr>
                                                <tr><td>SAT Fall Mid:</td><td><input type="text" name="sat_fall_mid" value="<?php echo $trow['sat_fall_mid']?>"></td></tr>
                                                <tr><td>ACT Summer Mid:</td><td><input type="text" name="act_summer_mid" value="<?php echo $trow['act_summer_mid']?>"></td></tr>
                                                <tr><td>ACT Fall Mid:</td><td><input type="text" name="act_fall_mid" value="<?php echo $trow['act_fall_mid']?>"></td></tr>
                                                <tr><td>Mascot:</td><td><input type="text" name="mascot" value="<?php echo $trow['mascot']?>"></td></tr>
                                                <tr><td>AP Credits Accepted:</td><td><input type="text" name="ap_credits" value="<?php echo $trow['ap_credits']?>"></td></tr>
                                                <tr><td>Application Fee:</td><td><input type="text" name="application" value="<?php echo $srow['application']?>"></td></tr>
                                                <tr><td>Application Deadline:</td><td><input type="text" name="app_deadline" value="<?php echo $trow['app_deadline']?>"></td></tr>
                                                <tr><td>Link:</td><td><input type="text" name="link" value="<?php echo $trow['link']?>"></td></tr>
                                                <tr><td colspan="100%">
                                        <input type="submit" name="submit" value="Update" class="button">
                                        <input type="submit" name="back" value="Back" class="button">
                                        <input type="submit" name="exit" value="Exit" class="button">
                                                </td></tr>
                  </form>
        </table>


<?php
        mysqli_close($db);
?>
</div>
</body>
</html>

