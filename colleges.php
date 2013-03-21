<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="includes/main.css" rel="stylesheet" type="text/css">
<?php
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('includes/db.php');
//Import header file
require('header_secure.php');

//Get session details
        $userid=$_SESSION['app_username'];
        $url=$_SERVER['REQUEST_URI'];
        $ip=$_SERVER['REMOTE_ADDR'];
//Inserting activity into DB
        mysqli_query($db, "INSERT INTO history (user, activity, ip_address, time_stamp) VALUES ('$userid', '$url', '$ip', NOW())");

?>
<title>Florida Colleges</title>
</head>
<body class="mainbody">
<div class="container">
<?php


//Prevent sql injections, grab entered variable
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));
//Map posted ID to college name
$zresults = mysqli_query($db, "SELECT id, name FROM institutions WHERE id='$id'");
                $zrow = mysqli_fetch_array($zresults);
//Set College name
$cname=$zrow['name'];
//Capture user ID
$user=$_SESSION['app_username'];

//Store required DB detail in arrays
$sresults = mysqli_query($db, "SELECT * FROM institutions WHERE name='$cname' AND status=1");
                $srow = mysqli_fetch_array($sresults);
$tresults = mysqli_query($db, "SELECT * FROM majors WHERE name='$cname'");
                $trow = mysqli_fetch_array($tresults);
$nresults = mysqli_query($db, "SELECT * FROM users WHERE email='$user' ");
		$nrow = mysqli_fetch_array($nresults);
$rresults = mysqli_query($db, "SELECT * FROM cost  WHERE institution='$cname'");
                $rrow = mysqli_fetch_array($rresults);
?>
<div id="wrapper" align="center">
  <div>

<h1 style="color:#000000;font-style:italic;font-family:Georgia, 'Times New Roman', Times, serif;font-size:50px"><?php echo $cname ?></h1>
<hr width="1032"/>
<?php
//Calculate attendance costs
$yr=$nrow['years'];
$bk=preg_replace("/[^0-9]/", "", $rrow['books']);
$rb=preg_replace("/[^0-9]/", "", $rrow['housing']);
$app=preg_replace("/[^0-9]/", "", $rrow['application']);
//Check is user is a FL resident and present appropriate costs
if($nrow['state']=="FL"){
$hr=preg_replace("/[^0-9]/", "", $rrow['hour']);
$annual_res=($bk+$rb+$app+$hr)/100;
$full=($yr*$annual_res);
?>
<p>The estimated annual cost for you to attend <?php echo $cname ?> is $<?php echo $annual_res ?>.00</a></p>
<p>The estimated total cost for you to attend <?php echo $cname ?> for all <?php echo $yr ?> years indicated on your profile is $<?php echo $full ?>.00</a></p>
<?php
}else{
$hr=preg_replace("/[^0-9]/", "", $rrow['nr_hour']);
$annual_nonres=($bk+$rb+$app+$hr)/100;
$full=($yr*$annual_nonres);
?>
<p>The estimated annual cost for you to attend <?php echo $cname ?> is $<?php echo $annual_nonres ?>.00</a></p>
<p>The estimated total cost for you to attend <?php echo $cname ?> for all <?php echo $yr ?> years indicated on your profile is $<?php echo $full ?>.00</a></p>
<?php
}

//Provide distance and directions
$s_address=$srow['s_address'];
$s_address2=$srow['s_address2'];
$city=$srow['city'];
$state=$srow['state'];
$zip=$srow['zip'];
$school_address= $s_address." ".$s_address2.", ".$city.", ".$state." ".$zip;

$add1=$nrow['add1'];
$add2=$nrow['add2'];
$user_city=$nrow['city'];
$user_state=$nrow['state'];
$user_zip=$nrow['zip'];

$home_address= $add1." ".$add2." ".$user_city.", ".$user_state." ".$user_zip;
?>

<form action="http://maps.google.com/maps" method="get"  target="_blank">
<p class="form1">Check the distance and get direction from your address to <?php echo $cname ?>.
<input type="hidden" name="saddr" value="<?php echo $home_address  ?>"/>
<input type="hidden" name="daddr" value="<?php echo $school_address  ?>" />
<input type="submit" value="Map it!" />
</form></tr>

<!--Output miscelaneous school information-->

<p><a href="<?php echo $srow['link']?>" target="_blank"><?php echo $cname ?> Link</a></p>


<table class="table1" width="1032" border="0" cellpadding="0">
  <tr>
    <th colspan="100%" align="center">Majors</th>
  </tr>
<?php
//Retrieve list of majors from DB and insert them into table
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <tr>
                                                <td><?php echo $trow['major']?></td>
                                                <td><?php echo $trow['college']?></td>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }else{
?>
                                        <tr>
                                                <td align="center" colspan="100%">Currently no data on file.</td>
                                        </tr>
<?php
                                        }
?>



</table>

<h3>GPA</h3>
<p>Summer Mid Range GPA: <?php echo $srow['gpa_summer_mid']?><br />
Fall Mid Range GPA:  <?php echo $srow['gpa_fall_mid']?> </p>

<h3>Location</h3>
<p> <?php echo $srow['s_address']." ".$srow['city'].", ".$srow['state']." ".$srow['zip'] ?><p>

<h3>Tuition Prices (Per 30 Credit hrs)</h3>
<p>Florida Residence:$<?php echo $rrow['hour'] ?> <br />
Non-Florida Resident:$<?php echo $rrow['nr_hour'] ?>

</p>


<h3>SAT and ACT Scores</h3>
<p>Summer Mid Range SAT:<?php echo $srow['sat_summer_mid'] ?>  <br />
Fall Mid Range SAT: <?php echo $srow['sat_fall_mid'] ?>  <br />
<br />
Summer Mid Range ACT: <?php echo $srow['act_summer_mid'] ?>  <br />
Fall Mid Range ACT: <?php echo $srow['act_fall_mid'] ?> 

<h3>Student Population</h3>
<p><?php echo $srow['population'] ?></p>

<h3>Average Room and Board Price</h3>
<p>$<?php echo $rrow['housing'] ?></p>

<h3>Average Price for Books</h3>
<p>$<?php echo $rrow['books'] ?></p>

<h3>Mascot</h3>
<p><?php echo $srow['mascot'] ?></p>

<h3>Dress Code</h3>

<?php
$qresults = mysqli_query($db, "SELECT * FROM dress_code WHERE name='$cname' AND status=1 ");
                                        if( $qrow = mysqli_fetch_array($qresults)){
                                                do{
?>
                                               <p><?php echo $qrow['policy']?></p>
<?php
                                                }while($qrow = mysqli_fetch_array($qresults));
                                        }
?>


<br />

<h3>Accept AP Credits?</h3>
<p><?php echo $srow['ap_credits'] ?></p>

<h3>Application Deadline and Fee</h3>
<p>$<?php echo $rrow['application'] ?><br />
<?php echo $srow['app_deadline'] ?>
<br />

<h3>Athletics</h3>

<?php   
$presults = mysqli_query($db, "SELECT * FROM athletics WHERE name='$cname' AND status=1 ORDER BY sport ");
                                        if( $prow = mysqli_fetch_array($presults)){
                                                do{
?>
                                               <p><?php echo $prow['sport']?></p>
<?php
                                                }while($prow = mysqli_fetch_array($presults));
                                        }

if(!empty($srow['image'])){
$image="images/".$srow['image'];
?>
<img src='<?php echo $image ?>' height="1032" width="673" />
<?php
}
?>

</div>
</div>
</body>
</html>
