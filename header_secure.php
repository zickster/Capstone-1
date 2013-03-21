<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../includes/main.css" rel="stylesheet" type="text/css">

<title>Florida Colleges</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<link href="includes/main.css" rel="stylesheet" type="text/css" />
<?php
//Create session variables
session_start();
//Grab session variables
$_SESSION['URI'] = $_SERVER['REQUEST_URI'];
//Import DB credentials
include('includes/db.php');
//Require authentication for this page
require('auth.php');
?>


</head>
<body class="mainbody">
<div class="headercontainer">

<a href="register.php">Sign Up</a>
<a href="index.php">Home</a>&nbsp;
<a href="admin/index.php">Admin</a>&nbsp;
<a href="edit_account.php">Account</a>&nbsp;
<?php
//Check if user is logged in, if logged in presnt a logout button, otherwise present a login button
if(!empty($_SESSION['app_username'])){
?>
<a href="logout.php">Logout</a>&nbsp;
<p> User <?php echo $_SESSION['app_username'] ?> logged in.</p>
<?php
}else{
?>
<a href="login.php">Login</a>&nbsp;
<?php
}
?>

<div id="wrapper" align="center">
  <div>
  <div id="divdiv">
  <table>
  <tr><td>
    <ul>
      <li><a href="index.php">Colleges</a>
        <ul>

<?php
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
?>
        </ul> 
      </li> 
      </ul>
    </td>
    <td>
    <ul>
      <li><a href="index.php">Schedule</a>
        <ul>
          <li><a href="http://calendar.fsu.edu/Pages/default.aspx" target="_blank">FSU Schedule</a></li>
         <li><a href="http://events.ucf.edu/?upcoming=upcoming" target="_blank">UCF Schedule</a></li>
         <li><a href="http://calendar.ufl.edu/" target="_blank">UF Schedule</a></li>
         <li><a href="https://calendar.fiu.edu/events/index/calendar:main/" target="_blank">FIU Schedule</a></li>
          
          
          
          
          
          
        </ul> 
      </li> 
      </ul>
    </td>
    <td>
    <ul>
      <li><a href="index.php" target="_blank">Finacial Aid</a>
        <ul>
          <li><a href="http://www.finaid.org/" target="_blank">FinAid</a></li>
          <li><a href="http://www.fafsa.ed.gov/" target="_blank">FAFSA</a></li>
          <li><a href="http://studentaid.ed.gov/" target="_blank">Federal Student Aid</a></li>
         
          
          
          
          
          
        </ul> 
      </li> 
      </ul>
    </td>
    <td>
    <ul>
      <li><a href="index.php">Links</a>
        <ul>
          <li><a href="http://www.myfloridaprepaid.com/?gclid=CPDmjI6ItrMCFQMFnQodoXoADw" target="_blank">Prepaid</a></li>
          <li><a href="http://www.stateofflorida.com/Portal/DesktopDefault.aspx" target="_blank">Florda Information Portal</a></li>
          <li><a href="http://www.fldoe.org/" target="_blank">Florida Education</a></li>
          <li><a href="http://www.floridacollege.edu/wp-content/uploads/2011/01/codes.of_.conduct.pdf" target="_blank">Florida Conduct</a></li>
           <li><a href="http://www.floridastudentfinancialaid.org/SSFAD/bf/" target="_blank">Bright Futures</a></li>
          <li><a href="http://www.fastweb.com/" target="_blank">Fast Web</a></li>
          
          
          
        </ul> 
      </li> 
      </ul>
    </td>
    <td>
    <ul>
      <li><a href="index.php" target="_blank">Contact Us</a>
        <ul>
          <li><a href="e-mails.php" >E-mail</a></li>
          <li><a href="bpainformation.php" >BPA Information</a></li>
          
          
          
          
          
          
        </ul> 
      </li> 
      </ul>
      </td></tr></table>
    </div>
    </div>
    </div>
</div>    
</body>
</html>
