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

                $p_title = mysqli_real_escape_string($db, strip_tags( $_POST['p_title']));
                $p_sort = mysqli_real_escape_string($db, strip_tags( $_POST['p_sort']));
                $art_p_title1 = mysqli_real_escape_string($db, strip_tags( $_POST['art_p_title1']));
                $an1_sort =  mysqli_real_escape_string($db, strip_tags( $_POST['an1_sort']));
                $art_text1 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text1']));
                $art_file1 = mysqli_real_escape_string($db, strip_tags( $_POST['art_file1']));
                $art_p_title2 = mysqli_real_escape_string($db, strip_tags( $_POST['art_p_title2']));
                $an2_sort = mysqli_real_escape_string($db, strip_tags( $_POST['an2_sort']));
                $art_text2 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text2']));
                $art_file2 = mysqli_real_escape_string($db, strip_tags( $_POST['art_file2']));
                $art_p_title3 = mysqli_real_escape_string($db, strip_tags( $_POST['art_p_title3']));
                $os_art_p_title3 = mysqli_real_escape_string($db, strip_tags( $_POST['os_art_p_title3']));
                $an3_sort = mysqli_real_escape_string($db, strip_tags( $_POST['an3_sort']));
                $art_text3 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text3']));
                $art_file3 =  mysqli_real_escape_string($db, strip_tags( $_POST['art_file3']));
                $art_p_title4 = mysqli_real_escape_string($db, strip_tags( $_POST['art_p_title4']));
                $an4_sort = mysqli_real_escape_string($db, strip_tags( $_POST['an4_sort']));
                $art_text4 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text4']));
                $art_file4 = mysqli_real_escape_string($db, strip_tags( $_POST['art_file4']));
                $art_p_title5 = mysqli_real_escape_string($db, strip_tags( $_POST['art_p_title5']));
                $an5_sort = mysqli_real_escape_string($db, strip_tags( $_POST['an5_sort']));
				$art_text5 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text5']));
				$art_file5 = mysqli_real_escape_string($db, strip_tags( $_POST['art_file5']));

//Null variables
				$ttl_error=" ";
				$ps_error=" ";
				$an1_error=" ";
				$at1_error=" ";
				$ans1_error=" ";
		
//Check if entered cata is not empty
	if (empty($p_title)){
                $ttl_error="Page title cannot be empty.";
				$c++;
	}elseif(empty($p_sort)){
				$ps_error="Sort order cannot be empty.";
				$c++;
	}elseif(empty($art_p_title1)){
                $an1_error="There must be at least one article on each page.";
				$c++;
    }elseif(empty($art_text1)){
                $at1_error="There must be text for this article.";
				$c++;
    }elseif(empty($an1_sort)){
                $ans1_error="Sort order cannot be empty.";
				$c++;
	}elseif(!empty($art_name2) && empty($an2_sort)){
                $ans2_error="Sort order cannot be empty.";
				$c++;
	}elseif(!empty($art_name3) && empty($an3_sort)){
                $ans3_error="Sort order cannot be empty.";
				$c++;
	}elseif(!empty($art_name4) && empty($an4_sort)){
                $ans4_error="Sort order cannot be empty.";
				$c++;
	}elseif(!empty($art_name5) && empty($an5_sort)){
                $ans5_error="Sort order cannot be empty.";
				$c++;			
	}elseif(!empty($art_name2) && empty($art_text2)){
                $ans2_error="There must be text for this article.";
				$c++;
	}elseif(!empty($art_name3) && empty($art_text3)){
                $ans3_error="There must be text for this article.";
				$c++;
	}elseif(!empty($art_name4) && empty($art_text4)){
                $ans4_error="There must be text for this article.";
				$c++;
	}elseif(!empty($art_name5) && empty($art_text5)){
                $ans5_error="There must be text for this article.";
				$c++;		
	}				
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
                                <td>Page Title:</td><td><input type="text" name="p_title" value="<?php echo $p_title ?>" size="85"><span class="red"><?php echo $ttl_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="p_sort" value="<?php echo $p_sort ?>" size="2"><span class="red"><?php echo $ps_error ?></span></td>
                                </tr>

                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name1" value="<?php echo $art_name1 ?>" size="85"><span class="red"><?php echo $an1_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="an1_sort" value="<?php echo $an1_sort ?>" size="2"><span class="red"><?php echo $ans1_error ?></span></td>
                                </tr>
                                <tr>
								<td>Article Content:</td><td><textarea name="art_text1" cols="70" rows="15" Value="<?php echo $art_text1 ?>"><?php echo $art_text1 ?></textarea><span class="red"><?php echo $at1_error ?></span></td>
								</tr>
								<tr>
								<form enctype="multipart/form-data" method="post" action="file_upload_script.php">
								<td>Article Image:</td><td><input name="art_file1" type="file" Value="<?php echo $art_file1 ?>" /></td>
								<td><input type="submit" value="Upload It" /></td>
								</form>
								</tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name2" value="<?php echo $art_name2 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an2_sort" value="<?php echo $an2_sort ?>" size="2"><span class="red"><?php echo $ans2_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text2" cols="70" rows="15" Value="<?php echo $art_text2 ?>"><?php echo $art_text2 ?></textarea></td>
                                </tr>
                                <tr>
                                <form enctype="multipart/form-data" method="post" action="file_upload_script.php">
                                <td>Article Image:</td><td><input name="art_file2" type="file" Value="<?php echo $art_file2 ?>" /></td>
                                <td><input type="submit" value="Upload It" /></td>
                                </form>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name3" value="<?php echo $art_name3 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an3_sort" value="<?php echo $an3_sort ?>" size="2"><span class="red"><?php echo $ans3_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text3" cols="70" rows="15" Value="<?php echo $art_text3 ?>"><?php echo $art_text3 ?></textarea></td>
                                </tr>
                                <tr>
                                <form enctype="multipart/form-data" method="post" action="file_upload_script.php">
                                <td>Article Image:</td><td><input name="art_file3" type="file" Value="<?php echo $art_file3 ?>" /></td>
                                <td><input type="submit" value="Upload It" /></td>
                                </form>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name4" value="<?php echo $art_name4 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an4_sort" value="<?php echo $an4_sort ?>" size="2"><span class="red"><?php echo $ans4_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text4" cols="70" rows="15" Value="<?php echo $art_text4 ?>"><?php echo $art_text4 ?></textarea></td>
                                </tr>
                                <tr>
                                <form enctype="multipart/form-data" method="post" action="file_upload_script.php">
                                <td>Article Image:</td><td><input name="art_file4" type="file" Value="<?php echo $art_file4 ?>" /></td>
                                <td><input type="submit" value="Upload It" /></td>
                                </form>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name5" value="<?php echo $art_name5 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an5_sort" value="<?php echo $an5_sort ?>" size="2"><span class="red"><?php echo $ans5_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text5" cols="70" rows="15" Value="<?php echo $art_text5 ?>"><?php echo $art_text5 ?></textarea></td>
                                </tr>
                                <tr>
                                <form enctype="multipart/form-data" method="post" action="file_upload_script.php">
                                <td>Article Image:</td><td><input name="art_file5" type="file" Value="<?php echo $art_file5 ?>" /></td>
                                <td><input type="submit" value="Upload It" /></td>
                                </form>
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
