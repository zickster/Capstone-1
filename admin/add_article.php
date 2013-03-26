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
		$art_text="Enter article content here...";

		$a_activate="0";
//Prevent sql injections, grab entered variable

                $dept_id = mysqli_real_escape_string($db, strip_tags( $_POST['dept_id']));
                $page_id = mysqli_real_escape_string($db, strip_tags( $_POST['p_title']));
                $p_sort = mysqli_real_escape_string($db, strip_tags( $_POST['p_sort']));

                $art_name1 = mysqli_real_escape_string($db, strip_tags( $_POST['art_name1']));
                $a_activate1 = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate1']));
                $an_sort1 =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort1']));
                $art_text1 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text1']));

                $art_name2 = mysqli_real_escape_string($db, strip_tags( $_POST['art_name2']));
                $a_activate2 = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate2']));
                $an_sort2 =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort2']));
                $art_text2 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text2']));

                $art_name3 = mysqli_real_escape_string($db, strip_tags( $_POST['art_name3']));
                $a_activate3 = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate3']));
                $an_sort3 =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort3']));
                $art_text3 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text3']));

                $art_name4 = mysqli_real_escape_string($db, strip_tags( $_POST['art_name4']));
                $a_activate4 = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate4']));
                $an_sort4 =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort4']));
                $art_text4 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text4']));

                $art_name5 = mysqli_real_escape_string($db, strip_tags( $_POST['art_name5']));
                $a_activate5 = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate5']));
                $an_sort5 =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort5']));
                $art_text5 = mysqli_real_escape_string($db, strip_tags( $_POST['art_text5']));


//Check that no page esists with this title
$tresults = mysqli_query($db, "SELECT p_title FROM tbl_pages WHERE p_title='$p_title'");
	$trow = mysqli_fetch_array($tresults);
	$title_test=$trow['p_title'];
	if(!empty($title_test)){
                $ttl_error="A page with this title already exists.";
               	$c++;
	}

//Null variables
		$ttl_error=" ";
		$ps_error=" ";
		$an1_error=" ";
		$at1_error=" ";
		$ans1_error=" ";
		$dept_id_error=" ";
		$ans2_error=" ";
		$ans3_error=" ";
		$ans4_error=" ";
		$ans5_error=" ";	
		$at2_error=" ";
		$at3_error=" ";
		$at4_error=" ";
		$at5_error=" ";

//Check if entered cata is not empty

	if (empty($p_title)){
                $ttl_error="Page title cannot be empty.";
		$c++;
    	}elseif($dept_id=="Select"){
                $dept_id_error="You must specify the Group under which to insert this page.";
		$c++;
	}elseif(empty($p_sort) && $p_sort !== '0'){
		$ps_error="Sort order cannot be empty.";
		$c++;
	}elseif(empty($art_name1)){
                $an1_error="There must be at least one article on each page.";
		$c++;
    	}elseif(empty($art_text1)){
                $at1_error="There must be text for this article.";
		$c++;
    	}elseif(empty($an_sort1) && $an_sort1 !== '0'){
                $ans1_error="Sort order cannot be empty.";
		$c++;
	}elseif(!empty($art_name2) && empty($an_sort2) && $an_sort2 !== '0'){
                $ans2_error="Sort order cannot be empty.";
		$c++;
	}elseif(!empty($art_name3) && empty($an_sort3) && $an_sort3 !== '0'){
                $ans3_error="Sort order cannot be empty.";
		$c++;
	}elseif(!empty($art_name4) && empty($an_sort4) && $an_sort4 !== '0'){
                $ans4_error="Sort order cannot be empty.";
		$c++;
	}elseif(!empty($art_name5) && empty($an_sort5) && $an_sort5 !== '0'){
                $ans5_error="Sort order cannot be empty.";
		$c++;			
	}elseif(!empty($art_name2) && empty($art_text2)){
                $at2_error="There must be text for this article.";
		$c++;
	}elseif(!empty($art_name3) && empty($art_text3)){
                $at3_error="There must be text for this article.";
		$c++;
	}elseif(!empty($art_name4) && empty($art_text4)){
                $at4_error="There must be text for this article.";
		$c++;
	}elseif(!empty($art_name5) && empty($art_text5)){
                $at5_error="There must be text for this article.";
		$c++;		
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB
	mysqli_query($db, "INSERT INTO tbl_pages (p_title, p_sort, dept_id, status) VALUES ('$p_title', '$p_sort', '$dept_id', '$p_activate')");

		$art_type="txt";	

$stresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE p_title='$p_title'");
        $srow = mysqli_fetch_array($sresults);
        $page_id=$srow['id'];
	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name1', '$art_text1', '$art_type', '$an_sort1', '$page_id', '$a_activate1')");
	if(!empty($art_name2)){
	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name2', '$art_text2', '$art_type', '$an_sort2', '$page_id', '$a_activate2')");
	}
	if(!empty($art_name3)){
	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name3', '$art_text3', '$art_type', '$an_sort3', '$page_id', '$a_activate3')");
	}
	if(!empty($art_name4)){
	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name4', '$art_text4', '$art_type', '$an_sort4', '$page_id', '$a_activate4')");
	}
	if(!empty($art_name5)){
	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name5', '$art_text5', '$art_type', '$an_sort5', '$page_id', '$a_activate5')");
	}
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
                                <td>Page Group:</td><td>
<?php
                                if($dept_id!=""){
                                $qresults = mysqli_query($db, "SELECT id, name FROM tbl_dept WHERE id='$dept_id'");
                                $qrow = mysqli_fetch_array($qresults);
                                $dept_id=$qrow['id'];
                                $dept_name=$qrow['name'];
                                }else{
                                $dept_name="Select";
                                }
?>
                                                       <select name="dept_id" id="dept_id">
                                                       <option value="<?php echo $dept_id ?>"><?php echo $dept_name ?></option>
<?php
//Retrieve data from the DB and display
                                $rresults = mysqli_query($db, "SELECT id, name FROM tbl_dept WHERE status=1 ORDER BY sort_order");
                                        if( $rrow = mysqli_fetch_array($rresults)){
                                                do{
?>
                                                <option value="<?php echo $rrow['id'] ?>"><?php echo $rrow['name'] ?></option>
<?php
                                                }while($rrow = mysqli_fetch_array($rresults));
                                        }
                                ?>
                                </tr>
                                <tr>
				<td>Page Title:</td><td><input type="text" name="p_title" value="<?php echo $p_title ?>" size="85"><span class="red"><?php echo $ttl_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="p_sort" value="<?php echo $p_sort ?>" size="2"><span class="red"><?php echo $ps_error ?></span></td>
                                </tr>
				<tr>
				<td></td>
				<td><input type="checkbox" name="p_activate" value="1">Make Page Active.</td>
				</tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name1" value="<?php echo $art_name1 ?>" size="85"><span class="red"><?php echo $an1_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="an_sort1" value="<?php echo $an_sort1 ?>" size="2"><span class="red"><?php echo $ans1_error ?></span></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type="checkbox" name="a_activate1" value="1">Make Article Active.</td>
                                </tr>
                                <tr>
                                <tr>
				<td>Article Content:</td><td><textarea name="art_text1" cols="70" rows="15" Value="<?php echo $art_text1 ?>"><?php echo $art_text1 ?></textarea><span class="red"><?php echo $at1_error ?></span></td>
				</tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name2" value="<?php echo $art_name2 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an_sort2" value="<?php echo $an_sort2 ?>" size="2"><span class="red"><?php echo $ans2_error ?></span></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type="checkbox" name="a_activate2" value="1">Make Article Active.</td>
                                </tr>
                                <tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text2" cols="70" rows="15" Value="<?php echo $art_text2 ?>"><?php echo $art_text2 ?></textarea><span class="red"><?php echo $at2_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name3" value="<?php echo $art_name3 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an_sort3" value="<?php echo $an_sort3 ?>" size="2"><span class="red"><?php echo $ans3_error ?></span></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type="checkbox" name="a_activate3" value="1">Make Article Active.</td>
                                </tr>
                                <tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text3" cols="70" rows="15" Value="<?php echo $art_text3 ?>"><?php echo $art_text3 ?></textarea><span class="red"><?php echo $at3_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name4" value="<?php echo $art_name4 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an_sort4" value="<?php echo $an_sort4 ?>" size="2"><span class="red"><?php echo $ans4_error ?></span></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type="checkbox" name="a_activate4" value="1">Make Article Active.</td>
                                </tr>
                                <tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text4" cols="70" rows="15" Value="<?php echo $art_text4 ?>"><?php echo $art_text4 ?></textarea><span class="red"><?php echo $at4_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name5" value="<?php echo $art_name5 ?>" size="85"></td>
                                <td>Sort Order:</td><td><input type="text" name="an_sort5" value="<?php echo $an_sort5 ?>" size="2"><span class="red"><?php echo $ans5_error ?></span></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type="checkbox" name="a_activate5" value="1">Make Article Active.</td>
                                </tr>
                                <tr>
                                <tr>
                                <td>Article Content:</td><td><textarea name="art_text5" cols="70" rows="15" Value="<?php echo $art_text5 ?>"><?php echo $art_text5 ?></textarea><span class="red"><?php echo $at5_error ?></span></td>
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
