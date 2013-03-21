<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('includes/db.php');
//Import header file
require('header.php');


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
                $phone = mysqli_real_escape_string($db, strip_tags( $_POST['phoe']));
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
        }elseif(empty($pass)){
                $pw_error="A password is required.";
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
		$password=md5($pass);
		mysqli_query($db, "INSERT INTO users (fname, lname, email, password, choice1, choice2, choice3, room_board, years, add1, add2, city, state, zip, phone, time_stamp) 
					      VALUES ('$fname', '$lname', '$email', '$password', '$choice1', '$choice2', '$choice3', '$rb', '$years', '$add1', '$add2', '$city', '$state', '$zip', '$phone', NOW())");
               	mysqli_close($db);
                        header('Location: index.php');
                        break;
//If passwords don't match, reject
	}else{
			$pw_error="Passwords must match";
//    			header('Location: register.php');
//			exit();
	}

                }
    
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<html>
<head>
        <meta charset='utf-8'>
        <link href="../includes/main.css" rel="stylesheet" type="text/css">

        <title>Add User</title>
</head>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Registration</h2></th>
                </tr>
                <tr>
                <td>
                <table>
                                <tr>
                                <td>First Name</td><td><input type="text" name="fname" value="<?php echo $fname ?>" size="30"><span class="red"><?php echo $fn_error ?></span></td>
<td>School Choice 1</td><td>
                                                        <select name="choice1" id="choice1">
                                                        <option value="Select Institution">Select Institution</option>
<?php
//Retrieve and post required information from DB
                                $tresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <option value="<?php echo $trow['name'] ?>"><?php echo $trow['name'] ?></option>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?><span class="red"><?php echo $c1_error ?></span></td>



                                </tr>
                                <tr>
                                <td>Last Name</td><td><input type="text" name="lname" value="<?php echo $lname ?>" size="30"><span class="red"><?php echo $ln_error ?></span></td>
<td>School Choice 2</td><td>
                                                        <select name="choice2" id="choice2">
                                                        <option value="Select Institution">Select Institution</option>
<?php
//Retrieve and post required information from DB
                                $tresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <option value="<?php echo $trow['name'] ?>"><?php echo $trow['name'] ?></option>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?><span class="red"><?php echo $c2_error ?></span></td>


                                </tr>
                                <tr>
                                <td>E-mail</td><td><input type="text" name="email" value="<?php echo $email ?>" size="30"><span class="red"><?php echo $e_error ?></span></td>

<td>School Choice 3</td><td>
                                                        <select name="choice3" id="choice3">
                                                        <option value="Select Institution">Select Institution</option>
<?php
//Retrieve and post required information from DB
                                $tresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <option value="<?php echo $trow['name'] ?>"><?php echo $trow['name'] ?></option>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?><span class="red"><?php echo $c3_error ?></span></td>

                                </tr>
                                <tr>
                                <td>Password</td><td><input type="password" name="pass" size="30"><span class="red"><?php echo $pw_error ?></span></td>
<td>Do you need room and board?</td><td>
                                                        <select name="rb" id="rb">
                                                        <option value="rb">Yes</option>
	                                                <option value="rb">No</option>
<span class="red"><?php echo $c2_error ?></span></td>

                                </tr>
                                <tr>
                                <td>Confirm Password</td><td><input type="password" name="pass1" size="30"><span class="red"><?php echo $pw_error ?></span></td>
                                <td>How many years do you expect to attend?</td><td><input type="text" name="years" value="<?php echo $years ?>" size="30"><span class="red"><?php echo $yr_error ?></span></td>
                                </tr>
                                <!--td colspan="2">
                                <input type="submit" name="register" value="Sign Up" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
				<input type="reset" value="Clear" /></td-->
                </table>
<br /><br />
               <table>	
				<tr>
			        <td>Address</td><td><input type="text" name="add1" value="<?php echo $add1 ?>" size="30"><span class="red"><?php echo $a1_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Address</td><td><input type="text" name="add2" value="<?php echo $add2 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>City</td><td><input type="text" name="city" value="<?php echo $city ?>" size="30"><span class="red"><?php echo $city_error ?></span></td>
                                </tr>
                                <tr>
                                <!--td>State</td><td><input type="text" name="state" value="<?php echo $state ?>" size="30"><span class="red"><?php echo $state_error ?></span></td-->
				<td><label for="state" > State </label></td><td>
                                                        <select name="state" id="state">
                                                        <option value=""> </option>
<?php
//Retrieve and post required information from DB
                                $tresults = mysqli_query($db, "SELECT * FROM states ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <option value="<?php echo $trow['abbreviation'] ?>"><?php echo $trow['name'] ?></option>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
                                                        </select></td>

                                </tr>
                                <tr>
                                <td>Zip Code</td><td><input type="text" name="zip" value="<?php echo $zip ?>" size="30"><span class="red"><?php echo $zip_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Phone Number</td><td><input type="text" name="phone" value="<?php echo $phone ?>" size="30"></td>
                                </tr>
                                <td colspan="2">
                                <input type="submit" name="register" value="Sign Up" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
                                <input type="reset" value="Clear" /></td>
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
