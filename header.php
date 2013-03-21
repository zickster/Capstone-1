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
//Import DB credentials
include('includes/db.php');
?>


</head>
<body class = "mainbody">
<div class="headercontainer">

<a href="register.php">Sign Up</a>
<a href="index.php">Home</a>&nbsp;
<a href="admin/index.php">Admin</a>&nbsp;
<a href="edit_account.php">Account</a>&nbsp;
<?php
//Check if user is logged in, if logge din presnt a logout button, otherwise present a login button
	if(!empty($_SESSION['app_username']) && !empty($_SESSION['app_password'])){
?>
<a href="logout.php">Logout</a>&nbsp;
	<p float="left"><?php echo $_SESSION['app_username']; ?> logged in.</p>
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
      <li><a href="index.php">Departments</a>
        <ul>

<?php
//Retrieve required data from the DB and publish it on the page
$tresults = mysqli_query($db, "SELECT * FROM tbl_dept WHERE status=1 ORDER BY sort_order");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <li><a href="dept.php?id=<?php echo $trow['id'] ?>"><?php echo $trow['name'] ?></a></li>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
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
      <li><a href="index.php">Finacial Aid</a>
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
          <li><a href="bpainformation.php">BPA Information</a></li>
          
          
          
          
          
          
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
