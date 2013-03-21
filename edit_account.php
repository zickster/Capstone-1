<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('includes/db.php');
require('header_secure.php');

//Get session details
        $userid = $_SESSION['app_username'];
        $userpw = $_SESSION['app_password'];
	$userpw=md5($userpw);
        $tresults = mysqli_query($db, "SELECT * FROM users WHERE email='$userid' AND password='$userpw'");
	$trow = mysqli_fetch_array($tresults);

//Results of Sign up button
        if(isset($_POST['register'])){
//Create counter
		$c=0;
//Prevent sql injections, grab entered variable
                $fname = mysqli_real_escape_string($db, strip_tags( $_POST['fname']));
                $lname = mysqli_real_escape_string($db, strip_tags( $_POST['lname']));
                $email = mysqli_real_escape_string($db, strip_tags( $_POST['email']));
                $pass =  mysqli_real_escape_string($db, strip_tags( $_POST['pass']));
                $pass1 = mysqli_real_escape_string($db, strip_tags( $_POST['pass1']));
                $choice1 = mysqli_real_escape_string($db, strip_tags( $_POST['choice1']));
                $choice2 = mysqli_real_escape_string($db, strip_tags( $_POST['choice2']));
                $choice3 = mysqli_real_escape_string($db, strip_tags( $_POST['choice3']));
                $rb = mysqli_real_escape_string($db, strip_tags( $_POST['rb']));
                $years = mysqli_real_escape_string($db, strip_tags( $_POST['years']));
                $add1 = mysqli_real_escape_string($db, strip_tags( $_POST['add1']));
                $add2 = mysqli_real_escape_string($db, strip_tags( $_POST['add2']));
                $city = mysqli_real_escape_string($db, strip_tags( $_POST['city']));
                $state = mysqli_real_escape_string($db, strip_tags( $_POST['state']));
                $zip = mysqli_real_escape_string($db, strip_tags( $_POST['zip']));
                $phone = mysqli_real_escape_string($db, strip_tags( $_POST['phone']));
                $level = mysqli_real_escape_string($db, strip_tags( $_POST['level']));
//Null variables
		$fn_error=" ";
		$ln_error=" ";
		$e_error=" ";
		$pw_error=" ";
		$c1_error=" ";
		$c2_error=" ";
		$c3_error=" ";
		$rb_error=" ";
		$yr_error=" ";
		$a1_error=" ";
		$city_error=" ";
		$state_error=" ";
		$zip_error=" ";
//Check if entered cata is not empty
	if (empty($fname)){
                $fn_error="First name cannot be empty.";
		$c++;
	}elseif(empty($lname)){
		$ln_error="Last name cannot be empty.";
		$c++;
	}elseif(empty($email)){
                $e_error="Email address cannot be empty.";
		$c++;
        }elseif(empty($choice1)){
                $c1_error="You must choose at least one school.";
		$c++;
        }elseif(empty($rb)){
                $rb_error="Required for cost calculation.";
		$c++;
        }elseif(empty($years)){
                $yr_error="Required for cost calculation.";
		$c++;
        }elseif(empty($add1)){
                $a1_error="Your address is required.";
		$c++;
        }elseif(empty($city)){
                $city_error="Your city is required.";
		$c++;
        }elseif(empty($state)){
                $state_error="Your state is required.";
		$c++;        
	}elseif(empty($zip)){
                $zip_error="Your zip code is required.";
		$c++;
//Check if passwords match
        }elseif ($pass==$pass1 && $c==0){
//Enter valid data into DB
		mysqli_query($db, "UPDATE users SET fname='$fname', lname='$lname', email='$email', choice1='$choice1', choice2='$choice2', choice3='$choice3', room_board='$rb', years='$years', add1='$add1', add2='$add2', city='$city', state='$state', zip='$zip', phone='$phone' WHERE id='$id'");
               	mysqli_close($db);
                        header('Location: index.php');
                        break;
//If passwords don't match, reject
	}else{
			$pw_error="Passwords must match";
//    			header('Location: register.php');
//			exit();
	}

if (!empty($pass) && $pass==$pass1){
		$password=md5($pass);
		 mysqli_query($db, "UPDATE users SET password='$password'  WHERE id='$id' ");
		}

                }
//Return to index if no changes requested    
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
//Deactivate school in DB if selected
        if($_POST['deactivate']){
	mysqli_query($db, "UPDATE users SET status=0  WHERE id='$id' ");
                        header('Location: index.php');
                        exit();
                }

?>
<html>
<head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="includes/main.css" type="text/css">


        <title>Edit User</title>
</head>
<body>
<div class="container">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table">
                <tr>

                        <th><h2>Edit account for <?php echo $trow['fname']." ".$trow['lname']; ?></h2></th>
                </tr>
                <tr>
                <td>
                <table>
                                <tr>
                                <td>First Name</td><td><input type="text" name="fname" value="<?php echo $trow['fname'] ?>" size="30"><span class="red"><?php echo $fn_error ?></span></td>
				<td>School Choice 1</td><td>
                                <select name="choice1" id="choice1">
                                                        <option value="<?php echo $trow['choice1'] ?>"><?php echo $trow['choice1'] ?></option>
<?php
//Retrive required data from DB and loop it onto page
                                $aresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $arow = mysqli_fetch_array($aresults)){
                                                do{
?>
                                                <option value="<?php echo $arow['name'] ?>"><?php echo $arow['name'] ?></option>
<?php
                                                }while($arow = mysqli_fetch_array($aresults));
                                        }
?><span class="red"><?php echo $c1_error ?></span></td>



                                </tr>
                                <tr>
                                <td>Last Name</td><td><input type="text" name="lname" value="<?php echo $trow['lname'] ?>" size="30"><span class="red"><?php echo $ln_error ?></span></td>
				<td>School Choice 2</td><td>
                                                        <select name="choice2" id="choice2">
							<option value="<?php echo $trow['choice2'] ?>"><?php echo $trow['choice2'] ?></option>
<?php
//Retrive required data from DB and loop it onto page
                                $aresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $arow = mysqli_fetch_array($aresults)){
                                                do{
?>
                                                <option value="<?php echo $arow['name'] ?>"><?php echo $arow['name'] ?></option>
<?php
                                                }while($arow = mysqli_fetch_array($aresults));
                                        }
?><span class="red"><?php echo $c2_error ?></span></td>


                                </tr>
                                <tr>
                                <td>E-mail</td><td><input type="text" name="email" value="<?php echo $trow['email'] ?>" size="30"><span class="red"><?php echo $e_error ?></span></td>

<td>School Choice 3</td><td>
                                                        <select name="choice3" id="choice3">
							<option value="<?php echo $trow['choice3'] ?>"><?php echo $trow['choice3'] ?></option>
<?php
//Retrive required data from DB and loop it onto page
                                $aresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $arow = mysqli_fetch_array($aresults)){
                                                do{
?>
                                                <option value="<?php echo $arow['name'] ?>"><?php echo $arow['name'] ?></option>
<?php
                                                }while($arow = mysqli_fetch_array($aresults));
                                        }
?><span class="red"><?php echo $c3_error ?></span></td>

                                </tr>
                                <tr>
                                <td>Password</td><td><input type="password" name="pass" size="30"><span class="red"><?php echo $pw_error ?></span></td>
				<td>Do you need room and board?</td>
				<td>
                                                        <select name="rb" id="rb">
                                                        <option value="<?php echo $trow['room_board'] ?>"><?php echo $trow['room_board'] ?></option>
                                                        <option value="Yes">Yes</option>
	                                                <option value="No">No</option>
				<span class="red"><?php echo $c2_error ?></span></td>

                                </tr>
                                <tr>
                                <td>Confirm Password</td><td><input type="password" name="pass1" size="30"><span class="red"><?php echo $pw_error ?></span></td>
                                <td>How many years do you expect to attend?</td><td><input type="text" name="years" value="<?php echo $trow['years'] ?>" size="30"><span class="red"><?php echo $yr_error ?></span></td>
                                </tr>
                                <!--td colspan="2">
                                <input type="submit" name="register" value="Sign Up" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
				<input type="reset" value="Clear" /></td-->
                </table>
<br /><br />
               <table>	
				<tr>
			        <td>Address</td><td><input type="text" name="add1" value="<?php echo $trow['add1'] ?>" size="30"><span class="red"><?php echo $a1_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Address</td><td><input type="text" name="add2" value="<?php echo $trow['add2'] ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>City</td><td><input type="text" name="city" value="<?php echo $trow['city'] ?>" size="30"><span class="red"><?php echo $city_error ?></span></td>
                                </tr>
                                <tr>
				<td><label for="state" > State </label></td><td>
                                                        <select name="state" id="state">
                                                        <option value="<?php echo $trow['state'] ?>"><?php echo $trow['state'] ?></option>
<?php
//Retrive required data from DB and loop it onto page
                                $bresults = mysqli_query($db, "SELECT * FROM states ORDER BY name");
                                        if( $brow = mysqli_fetch_array($bresults)){
                                                do{
?>
                                                <option value="<?php echo $brow['abbreviation'] ?>"><?php echo $brow['name'] ?></option>
<?php
                                                }while($brow = mysqli_fetch_array($bresults));
                                        }
?>
                                                        </select></td>

                                </tr>
                                <tr>
                                <td>Zip Code</td><td><input type="text" name="zip" value="<?php echo $trow['zip'] ?>" size="30"><span class="red"><?php echo $zip_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Phone Number</td><td><input type="text" name="phone" value="<?php echo $trow['phone'] ?>" size="30"></td>
                                </tr>
                                <td colspan="2">
                                <input type="submit" name="register" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
                                <input type="submit" name="deactivate" value="Deactivate" class="button" />&nbsp;
                                <tr>
                                </tr>


                </td>
                </tr>
        </table>
        </form>

        </div>
  </div>

</body>
</html>
