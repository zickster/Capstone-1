<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');


//Results of Sign up button
        if(isset($_POST['register'])){
//Create counter
		$c=0;
//Prevent sql injections, grab entered variable
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
                $add1 = mysqli_real_escape_string($db, strip_tags( $_POST['add1']));
                $add2 = mysqli_real_escape_string($db, strip_tags( $_POST['add2']));
                $phone =  mysqli_real_escape_string($db, strip_tags( $_POST['phone']));
                $zip = mysqli_real_escape_string($db, strip_tags( $_POST['zip']));
                $city = mysqli_real_escape_string($db, strip_tags( $_POST['city']));
                $state = mysqli_real_escape_string($db, strip_tags( $_POST['state']));
                $pop = mysqli_real_escape_string($db, strip_tags( $_POST['pop']));
                $books = mysqli_real_escape_string($db, strip_tags( $_POST['books']));
                $rb = mysqli_real_escape_string($db, strip_tags( $_POST['rb']));
                $cost = mysqli_real_escape_string($db, strip_tags( $_POST['cost']));
                $os_cost = mysqli_real_escape_string($db, strip_tags( $_POST['os_cost']));
                $gpa_summer_mid = mysqli_real_escape_string($db, strip_tags( $_POST['gpa_summer_mid']));
                $gpa_fall_mid = mysqli_real_escape_string($db, strip_tags( $_POST['gpa_fall_mid']));
                $sat_summer_mid =  mysqli_real_escape_string($db, strip_tags( $_POST['sat_summer_mid']));
                $sat_fall_mid = mysqli_real_escape_string($db, strip_tags( $_POST['sat_fall_mid']));
                $act_summer_mid = mysqli_real_escape_string($db, strip_tags( $_POST['act_summer_mid']));
                $act_fall_mid = mysqli_real_escape_string($db, strip_tags( $_POST['act_fall_mid']));
                $mascot = mysqli_real_escape_string($db, strip_tags( $_POST['mascot']));
                $ap_credits = mysqli_real_escape_string($db, strip_tags( $_POST['ap_credits']));
                $app_deadline = mysqli_real_escape_string($db, strip_tags( $_POST['app_deadline']));
		$link = mysqli_real_escape_string($db, strip_tags( $_POST['link']));

//Null variables
		$nm_error=" ";
		$a1_error=" ";
		$ph_error=" ";
		$city_error=" ";
		$state_error=" ";
		$pop_error=" ";
		$zip_error=" ";
		$rb_error=" ";
		$cost_error=" ";
		$os_cost_error=" ";
		$books_error=" ";
                $gpa_summer_mid_error=" ";
                $gpa_fall_mid_error=" ";
                $sat_summer_mid_error=" ";
                $sat_fall_mid_error=" ";
                $act_summer_mid_error=" ";
                $act_fall_mid_error=" ";
                $mascot_error=" ";
                $ap_credits_error=" ";
                $app_deadline_error=" ";
                $link_error=" ";
//Check if entered cata is not empty
	if (empty($name)){
                $nm_error="Name cannot be empty.";
		$c++;
	}elseif(empty($add1)){
		$add1_error="Address 1 cannot be empty.";
		$c++;
	}elseif(empty($phone)){
                $ph_error="Phone number cannot be empty.";
		$c++;
        }elseif(empty($city)){
                $city_error="City cannot be empty.";
		$c++;
        }elseif(empty($state)){
                $state_error="State cannot be empty.";
		$c++;
        }elseif(empty($zip)){
                $zip_error="Zip code cannot be empty.";
		$c++;
        }elseif(empty($pop)){
                $pop_error="Estimated Student Popluation is required.";
		$c++;
        }elseif(empty($cost)){
                $cost_error="In-State cost is required.";
		$c++;
        }elseif(empty($os_cost)){
                $os_cost_error="Out-of-State cost is required.";
		$c++;
        }elseif(empty($rb)){
                $rb_error="Estimated Room-Board cost is required.";
		$c++;
        }elseif(empty($books)){
                $books_error="Estimated text book cost is required.";
		$c++;
	}elseif(empty($gpa_summer_mid)){
                $gpa_summer_mid_error="Field cannot be empty.";
                $c++;
        }elseif(empty($gpa_fall_mid)){
                $gpa_fall_mid_error="Field cannot be empty.";
                $c++;
        }elseif(empty($sat_summer_mid)){
                $sat_summer_mid_error="Field cannot be empty.";
                $c++;
        }elseif(empty($sat_fall_mid)){
                $sat_fall_mid_error="Field cannot be empty.";
                $c++;
        }elseif(empty($act_summer_mid)){
                $act_summer_mid_error="Field cannot be empty.";
                $c++;
        }elseif(empty($act_fall_mid)){
                $act_fall_mid="Estimated Student Popluation is required.";
                $c++;
        }elseif(empty($mascot)){
                $mascot_error="Field cannot be empty.";
                $c++;
        }elseif(empty($ap_credits)){
                $ap_credits_error="Field cannot be empty.";
                $c++;
        }elseif(empty($app_deadline)){
                $app_deadline_error="Field cannot be empty.";
                $c++;
        }elseif(empty($link)){
                $link_error="Field cannot be empty.";
                $c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB
		mysqli_query($db, "INSERT INTO institutions (name, s_address, s_address2, city, state, zip, phone, population, gpa_summer_mid, gpa_fall_mid, sat_summer_mid, sat_fall_mid, act_summer_mid, act_fall_mid, mascot, ap_credits, app_deadline, link) 
					      VALUES ('$name', '$add1', '$add2', '$city', '$state', '$zip', '$phone', '$pop', '$gpa_summer_mid', '$gpa_fall_mid', '$sat_summer_mid', '$sat_fall_mid', '$act_summer_mid', '$act_fall_mid', '$mascot', '$ap_credits', '$app_deadline', '$link')");
		mysqli_query($db, "INSERT INTO cost (institution, hour, books, housing, nr_hour) 
					      VALUES ('$name', '$cost', '$books', '$rb', '$os_cost')");
               	mysqli_close($db);
                        header('Location: index.php');
	}
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
        <link rel="stylesheet" href="../includes/main.css" type="text/css">


        <title>Add User</title>
</head>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Add Institution</h2></th>
                </tr>
                <tr>
                <td>
                <table>
                                <tr>
                                <td>Institution Name:</td><td><input type="text" name="name" value="<?php echo $name ?>" size="30"><span class="red"><?php echo $nm_error ?></span></td>
                                <td>Address 1:</td><td><input type="text" name="add1" value="<?php echo $add1 ?>" size="30"><span class="red"><?php echo $a1_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Phone Number:</td><td><input type="text" name="phone" value="<?php echo $phone ?>" size="30"><span class="red"><?php echo $ph_error ?></span></td>
                                <td>Address 2:</td><td><input type="text" name="add2" value="<?php echo $add2 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>Student Polulation:</td><td><input type="text" name="pop" value="<?php echo $pop ?>" size="30"><span class="red"><?php echo $pop_error ?></span></td>
                                <td>City:</td><td><input type="text" name="city" value="<?php echo $city ?>" size="30"><span class="red"><?php echo $city_error ?></span></td>
                                </tr>
                                <tr>
                                <td>In-State cost for 30 hours:</td><td><input type="text" name="cost" value="<?php echo $cost ?>" size="30"><span class="red"><?php echo $cost_error ?></span></td>
                                <td>State:</td><td><input type="text" name="state" value="<?php echo $state ?>" size="30"><span class="red"><?php echo $state_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Out-of-State cost for 30 hours:</td><td><input type="text" name="os_cost" value="<?php echo $os_cost ?>" size="30"><span class="red"><?php echo $os_cost_error ?></span></td>
                                <td>Zip Code:</td><td><input type="text" name="zip" value="<?php echo $zip ?>" size="30"><span class="red"><?php echo $zip_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Est. Room/Board:</td><td><input type="text" name="rb" value="<?php echo $rb ?>" size="30"><span class="red"><?php echo $rb_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Est. books fees:</td><td><input type="text" name="books" value="<?php echo $books ?>" size="30"><span class="red"><?php echo $books_error ?></span></td>
                                </tr>
                                <tr>
                                <td>GPA Summer Mid:</td><td><input type="text" name="gpa_summer_mid" value="<?php echo $gpa_summer_mid ?>" size="30"><span class="red"><?php echo $gpa_summer_mid_error ?></span></td>
                                </tr>
                                <tr>
                                <td>GPA Fall Mid:</td><td><input type="text" name="gpa_fall_mid" value="<?php echo $gpa_fall_mid ?>" size="30"><span class="red"><?php echo $gpa_fall_mid_error ?></span></td>
                                </tr>
                                <tr>
                                <td>SAT Summer Mid:</td><td><input type="text" name="sat_summer_mid" value="<?php echo $sat_summer_mid ?>" size="30"><span class="red"><?php echo $sat_summer_mid_error ?></span></td>
                                </tr>
                                <tr>
                                <td>SAT Fall Mid:</td><td><input type="text" name="sat_fall_mid" value="<?php echo $sat_fall_mid ?>" size="30"><span class="red"><?php echo $sat_fall_mid_error ?></span></td>
                                </tr>
                                <tr>
                                <td>ACT Summer Mid:</td><td><input type="text" name="act_summer_mid" value="<?php echo $act_summer_mid ?>" size="30"><span class="red"><?php echo $act_summer_mid_error ?></span></td>
                                </tr>
                                <tr>
                                <td>ACT Fall Mid:</td><td><input type="text" name="act_fall_mid" value="<?php echo $act_fall_mid ?>" size="30"><span class="red"><?php echo $act_fall_mid_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Mascot:</td><td><input type="text" name="mascot" value="<?php echo $mascot ?>" size="30"><span class="red"><?php echo $mascot_error ?></span></td>
                                </tr>
                                <tr>
                                <td>AP Credits Accepted:</td><td><input type="text" name="ap_credits" value="<?php echo $ap_credits ?>" size="30"><span class="red"><?php echo $ap_credits_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Application Deadline:</td><td><input type="text" name="app_deadline" value="<?php echo $app_deadline ?>" size="30"><span class="red"><?php echo $app_deadline_error ?></span></td>
                                </tr>
                                <tr>
                                <td>URL for Schools site:</td><td><input type="text" name="link" value="<?php echo $link ?>" size="30"><span class="red"><?php echo $link_error ?></span></td>
                                </tr>
                                <tr>
                                <td colspan="2">
                                <input type="submit" name="register" value="Add" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
				<input type="reset" value="Clear" /></td>
                                <tr>
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
