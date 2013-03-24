<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $article_id = mysqli_real_escape_string($db, strip_tags($_GET['id']));

        if($_POST['delete']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $page_id = mysqli_real_escape_string($db, strip_tags( $_POST['page_id']));
$dresults = mysqli_query($db, "DELETE FROM tbl_articles WHERE id='$id'");
//Refer to correct page for edit
                        header('Location: chose_article.php?id='.$page_id);
                        exit();
                }    

        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 1 if activating
                mysqli_query($db, "UPDATE tbl_articles SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }    

        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_articles SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }    

//return to home page
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<html>
<head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../includes/main.css" type="text/css">


        <title>Daily Living Toolkit</title>
</head>
<body>
<div class="container ">

        <table border="1" class="table1">
                <tr>
                        <th><h2>Edit an Article</h2></th>
                </tr>
                <tr>
                <td>
                <table>
				<tr>
				<th>Page Name</th>
				<th>Content</th>
				<th>Status</th>
				<th>Sort Order</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_articles WHERE id='$article_id'");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['art_name'];
						$id=$trow['id'];
						$sort=$trow['an_sort'];
						$status=$trow['status'];
						$art_text=$trow['art_text'];
						$page_id=$trow['page_id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td><?php echo $name ?></td>
				<td><?php echo $art_text ?></td>
                                <td>
                                <?php
                                        switch($status){
                                        case "0":
                                                $status="Inactive";
                                                break;
                                        case "1":
                                                $status="Active";
                                                break;
                                        default:
                                                $status="Unknown";
                                }
                                echo $status ?>
                                </td>
				<td><?php echo $sort ?></td>
				<td><input type="hidden" name="page_id" value="<?php echo $page_id ?>">
				<td><input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="submit" name="delete" value="delete" class="button"/></td>
				<td><input type="submit" name="deactivate" value="Deactivate" class="button"/></td>
				<td><input type="submit" name="activate" value="Activate" class="button"/></td>
                                </tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
				<td><input type="submit" name="exit" value="Exit" class="button"/></td>
				</tr>
				</form>


                </table>
                </td>
                </tr>

		 </table>

        </div>
  </div>

</body>
</html>
