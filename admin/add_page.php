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
//Create generic text field data
		$art_text1="Enter article content here...";
		$art_text2="Enter article content here...";
		$art_text3="Enter article content here...";
		$art_text4="Enter article content here...";
		$art_text5="Enter article content here...";

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
                        <th><h2>Add Page</h2></th>
                </tr>
                <tr>
                <td>
                <table>
                                <tr>
                                <td>Page Title:</td><td><input type="text" name="title" value="<?php echo $title ?>" size="85"><span class="red"><?php echo $ttl_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="p_sort" value="<?php echo $p_sort ?>" size="2"><span class="red"><?php echo $ps_error ?></span></td>
                                </tr>

                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name1" value="<?php echo $art_name1 ?>" size="85"><span class="red"><?php echo $an1_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="an1_sort" value="<?php echo $an1_sort ?>" size="2"></td>
                                </tr>
                                <tr>
				<td>Article Content:</td><td><textarea name="art_text1" cols="70" rows="15" Value="<?php echo $art_text1 ?>"><?php echo $art_text1 ?></textarea><span class="red"><?php echo $at1_error ?></span></td>
				</tr>

                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name2" value="<?php echo $art_name2 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an2_sort" value="<?php echo $an2_sort ?>" size="2"></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text2" cols="70" rows="15" Value="<?php echo $art_text2 ?>"><?php echo $art_text2 ?></textarea></td>
                                </tr>

                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name3" value="<?php echo $art_name3 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an3_sort" value="<?php echo $an3_sort ?>" size="2"></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text3" cols="70" rows="15" Value="<?php echo $art_text3 ?>"><?php echo $art_text3 ?></textarea></td>
                                </tr>

                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name4" value="<?php echo $art_name4 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an4_sort" value="<?php echo $an4_sort ?>" size="2"></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text4" cols="70" rows="15" Value="<?php echo $art_text4 ?>"><?php echo $art_text4 ?></textarea></td>
                                </tr>

                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name5" value="<?php echo $art_name5 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an5_sort" value="<?php echo $an5_sort ?>" size="2"></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text5" cols="70" rows="15" Value="<?php echo $art_text5 ?>"><?php echo $art_text5 ?></textarea></td>
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
