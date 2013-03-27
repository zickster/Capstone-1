<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../includes/main.css" rel="stylesheet" type="text/css">

<title>Living Web ToolKit</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<link href="includes/main.css" rel="stylesheet" type="text/css" />
<!-- <?php
//Create session variables
// session_start();
//mport DB credentials
// include('includes/db.php');
// ?>
-->

</head>
<body class = "mainbody">
<div id="main_header_wrapper">

<!--<div id="main_header">

  <!--        <div id="site_title">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div> <!-- end of site_title 
        
</div>  -->


<div class="headercontainer">

<!--<a href="register.php">Sign Up</a>-->
<!--<a href="index.php">Home</a>&nbsp;-->
<!--<a href="admin/index.php">Admin</a>&nbsp;-->
<a href="admin/index.php"><img src="images/admin-button.png" width="92" height="40" alt="admin" /></a>
<!--<a href="edit_account.php">Account</a>&nbsp;-->
<?php
//Check if user is logged in, if logge din presnt a logout button, otherwise present a login button
	if(!empty($_SESSION['app_username']) && !empty($_SESSION['app_password'])){
?>
<a href="logout.php">Logout</a>&nbsp;
<p float="left"><?php echo $_SESSION['app_username']; ?> logged in.</p>
<?php
}else{
?>
<!--<a href="login.php">Login</a>&nbsp;-->
<?php
}	
?>

<div id="templatemo_header_wrapper">
   <img src="images/header.png" width="1016" height="120" alt="headerpic" />
   
  <div id="wrapper" align="center">
  
  <div id='cssmenu'>
<ul>
   <li class='active'><a href='index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='index.php'><span>Living Toolkit</span></a>
      <ul>
         <li><a href='index.php'><span>1. Intro</span></a></li>
         <li><a href='index.php'><span>2. Housing</span></a></li>
         <li><a href='index.php'><span>3. Food</span></a></li>
         <li><a href='index.php'><span>4. Health Wellness</span></a></li>
         <li><a href='index.php'><span>5. Children</span></a></li>
         <li><a href='index.php'><span>6. Employment and Education</span></a></li>
         <li><a href='index.php'><span>7. Transportation</span></a></li>
         <li class='last'><a href='index.php'><span>6. Employment and Education</span></a></li>
      </ul>
   </li>
   <li><a href='index.php'><span>Links</span></a></li>
   <li><a href='index.php'><span>Contact Us</span></a></li>
   <li class='last'><a href='index.php'><span>About Us</span></a></li>
</ul>
</div>



  <div id="divdiv">
<?php /*?><?php
//Count how many colleges are in the DB
$cresults = mysqli_query($db, "SELECT count(id) FROM institutions WHERE status=1");
				$crow = mysqli_fetch_array($cresults);
				$count=$crow['count(id)'];			

//Retrieve required data from the DB and publish it on the page
$tresults = mysqli_query($db, "SELECT * FROM institutions WHERE status=1 ORDER BY name LIMIT 0, 5");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <li><a href="colleges.php?id=<?php echo $trow['id'] ?>"><?php echo $trow['name'] ?></a></li>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
					if($count>5){
?>
                                                <li><a href="more_colleges.php">More Colleges...</a></li>
<?php
}
?><?php */?>

    </div>
    </div>
  </div>
</div>
</div>
<div class="main_body">

<div id="body_background">

	<img src="images/header_content.jpg" width="92" height="40" alt="body_content" /></a>
	
</div>

</div>


</body>
</html>
