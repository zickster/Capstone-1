<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');


//Results of Search by user button
        if(isset($_POST['user'])){

//Prevent sql injections, grab entered variable
                $user = mysqli_real_escape_string($db, strip_tags( $_POST['user']));

                header('Location: search_user.php?user='.$user);
	}

//Results of Search by date button
        if(isset($_POST['date'])){

//Prevent sql injections, grab entered variable
                $month = mysqli_real_escape_string($db, strip_tags( $_POST['month']));
                $day = mysqli_real_escape_string($db, strip_tags( $_POST['day']));
                $year = mysqli_real_escape_string($db, strip_tags( $_POST['year']));
                $end_month = mysqli_real_escape_string($db, strip_tags( $_POST['end_month']));
                $end_day = mysqli_real_escape_string($db, strip_tags( $_POST['end_day']));
                $end_year = mysqli_real_escape_string($db, strip_tags( $_POST['end_year']));
		$range=$year."-".$month."-".$day."_".$end_year."-".$end_month."-".$end_day;

                header('Location: search_date.php?range='.$range);
	}

//Refer to home page   
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }

?>
<html>
<head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../includes/main.css" type="text/css">


        <title>Search</title>
</head>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Search</h2></th>
                </tr>
                <tr>
                <td>
                <table>
                        <tr>
				<td>Search by user:</td><td>
                                                       <select name="user" id="user">
                                                       <option value="Select user">Select user</option>
<?php
//Retrieve data from the DB and display
                                $tresults = mysqli_query($db, "SELECT email FROM users WHERE status=1 ORDER BY email");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <option value="<?php echo $trow['email'] ?>"><?php echo $trow['email'] ?></option>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
						<input type="submit" name="id" value="Search" class="button"/></td>
                                </tr>
				<tr>
				<td>Search by date:</td>
				<td colspan="3">Begin Date:
                                                      <select name="month" id="month">
                                                      <option value="01">Jan</option>
                                                      <option value="02">Feb</option>
                                                      <option value="03">Mar</option>
                                                      <option value="04">Apr</option>
                                                      <option value="05">May</option>
                                                      <option value="06">Jun</option>
                                                      <option value="07">Jul</option>
                                                      <option value="08">Aug</option>
                                                      <option value="09">Sep</option>
                                                      <option value="10">Oct</option>
                                                      <option value="11">Nov</option>
                                                      <option value="12">Dec</option>
						      </select>	
                                                      <select name="day" id="day">
<?php
//Enumerate days of themonth
						for ($i=1; $i<=31; $i++){
							$c=$i;
							if($i<10){$c="0".$i;}
?>
							<option value="<?php echo $c ?>"><?php echo $c ?></option>
<?php
						}
?>	
							</select>
                                                      <select name="year" id="year">
<?php
//Enumerate last 5 years
						$yr=date("Y");
                                                for ($i=1; $i<=5; $i++){
?>
                                                      <option value="<?php echo $yr ?>"><?php echo $yr ?></option>
<?php
     						$yr--;
	                                        }
?>
						</select

				</td>

				<td colspan="3">End Date:
                                                      <select name="end_month" id="end_month">
                                                      <option value="01">Jan</option>
                                                      <option value="02">Feb</option>
                                                      <option value="03">Mar</option>
                                                      <option value="04">Apr</option>
                                                      <option value="05">May</option>
                                                      <option value="06">Jun</option>
                                                      <option value="07">Jul</option>
                                                      <option value="08">Aug</option>
                                                      <option value="09">Sep</option>
                                                      <option value="10">Oct</option>
                                                      <option value="11">Nov</option>
                                                      <option value="12">Dec</option>
						      </select>	
                                                      <select name="end_day" id="end_day">
<?php
//Enumerate dats of the month
						for ($i=1; $i<=31; $i++){
							$c=$i;
							if($i<10){$c="0".$i;}
?>
							<option value="<?php echo $c ?>"><?php echo $c ?></option>
<?php
						}
?>	
							</select>
                                                      <select name="end_year" id="end_year">
<?php
//Enumerate las 5 years
						$yr=date("Y");
                                                for ($i=1; $i<=5; $i++){
?>
                                                      <option value="<?php echo $yr ?>"><?php echo $yr ?></option>
<?php
     						$yr--;
	                                        }
?>
						</select
				</td>
				<td><input type="submit" name="date" value="Search" class="button"/></td>
				</tr>
				<tr>
                                <td colspan="2">
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
                                </td>
				</tr>
                </table>
                </td>
                </tr>
        </table>
        </form>

        </div>
  </div>

</body>
</html>
