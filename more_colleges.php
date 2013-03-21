<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="includes/main.css" rel="stylesheet" type="text/css">

<title>Florida Colleges</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<link href="main.css" rel="stylesheet" type="text/css" />
<?php
//Import the header file
require('header.php');
?>
</head>

<body>
<div class="container">
<div id="wrapper" align="center">
  <h1 style="color:#000000;font-style:italic;font-family:Georgia, 'Times New Roman', Times, serif;font-size:50px">Florida Colleges</h1>
  <hr width="1032"/>
  
        <ul>

<?php
//Retrive required data from DB and present it on the page
$tresults = mysqli_query($db, "SELECT * FROM institutions WHERE status=1 ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <li><a href="colleges.php?id=<?php echo $trow['id'] ?>"><?php echo $trow['name'] ?></a></li>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
        </ul>


  </div>
</div>
</body>
</html>
