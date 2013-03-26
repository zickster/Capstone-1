<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');
//added php-mysql security
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));

//Results of Sign up button
        if(isset($_POST['register'])){
//Create counter
		$c=0;
//Create generic text field data
		$art_text="Enter article content here...";

		$a_activate="0";
		$art_type="txt";
//Prevent sql injections, grab entered variable

                $dept_id = mysqli_real_escape_string($db, strip_tags( $_POST['dept_id']));
                $art_name = mysqli_real_escape_string($db, strip_tags( $_POST['art_name']));
                $a_activate = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate']));
                $an_sort =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort']));
                $art_text = mysqli_real_escape_string($db, strip_tags( $_POST['art_text']));


//Check that no page esists with this title
$tresults = mysqli_query($db, "SELECT art_name FROM tbl_articles WHERE art_name='$art_name'");
	$trow = mysqli_fetch_array($tresults);
	$name_test=$trow['art_name'];
	if(!empty($name_test)){
                $name_error="An article with this name already exists.";
               	$c++;
	}

//Null variables
		$an_error=" ";
		$at_error=" ";
		$ans_error=" ";

//Check if entered cata is not empty

	if(empty($art_name)){
                $an_error="YOu must specify an article name.";
		$c++;
    	}elseif(empty($art_text)){
                $at_error="There must be text for this article.";
		$c++;
    	}elseif(empty($an_sort) && $an_sort1 !== '0'){
                $ans_error="Sort order cannot be empty.";
		$c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name', '$art_text', '$art_type', '$an_sort', '$id', '$a_activate')");
               	mysqli_close($db);
                        header('Location: index.php');
	}
	}
        }
    
        if($_POST['back']){
                        header('Location: select_article.php?id='.$id);
                        exit();
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
                        <th><h2>Add Text Article</h2></th>
                </tr>
                <tr>
                <td>
                <table>
                                <tr>
<?php
$sresults = mysqli_query($db, "SELECT d.name, p.p_title FROM tbl_dept AS d, tbl_pages AS p WHERE p.dept_id-d.id AND p.id='$id'");
        $srow = mysqli_fetch_array($sresults);
	$dept_name=$srow['name'];
	$p_title=$srow['p_title'];
?>
                                <td>Page Group:</td><td><?php echo $dept_name ?></td>
                                </tr>
                                <tr>
				<td>Page Title:</td><td><?php echo $p_title ?></td>
                                </tr>
                                <tr>
                                <td>Article Title:</td><td><input type="text" name="art_name" value="<?php echo $art_name ?>" size="85"><span class="red"><?php echo $an_error ?></span></td>
                                <td>Sort Order:</td><td><input type="text" name="an_sort" value="<?php echo $an_sort ?>" size="2"><span class="red"><?php echo $ans_error ?></span></td>
                                </tr>
                                <tr>
                                <td></td>
                                <td><input type="checkbox" name="a_activate1" value="1">Make Article Active.</td>
                                </tr>
                                <tr>
                                <tr>
				<td>Article Content:</td><td><textarea name="art_text" cols="70" rows="15" Value="<?php echo $art_text1 ?>"><?php echo $art_text ?></textarea><span class="red"><?php echo $at_error ?></span></td>
				</tr>
                                <tr>
                                <td colspan="2">
                                <input type="submit" name="register" value="Add" class="button"/>&nbsp;
                                <input type="submit" name="back" value="Back" class="button" />&nbsp;
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
