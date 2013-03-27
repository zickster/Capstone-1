<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $dept_id = mysqli_real_escape_string($db, strip_tags($_GET['id']));

        if($_POST['edit']){
//Added sql security to prevent sql injection
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Refer to correct page for edit
                        header('Location: select_article.php?id='.$id);
                        exit();
                }    

        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 1 if activating
                mysqli_query($db, "UPDATE tbl_pages SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_page.php?id='.$dept_id);
                        exit();
                }    

        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_pages SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_page.php?id='.$dept_id);
                        exit();
                }    

//go back one page
        if($_POST['back']){
                        header('Location: select_catagory.php');
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
                        <th><h2>Select a Web Page</h2></th>
                </tr>
                <tr>
                <td>
                <table>
				<tr>
				<th>Page Name</th>
				<th>Status</th>
				<th>Sort Order</th>
				<th>Actions</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_pages WHERE dept_id='$dept_id' ORDER BY p_sort");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['p_title'];
						$status=$trow['status'];
						$p_sort=$trow['p_sort'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td><?php echo $name ?></td>
				<td align="center">
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
				<td align="center"><?php echo $p_sort ?>
				<input type="hidden" name="id" value="<?php echo $id ?>"></td>
				<td><input type="submit" name="edit" value="Edit" class="button"/></td>
<?php
	if($status=="Active"){
?>
				<td><input type="submit" name="deactivate" value="Deactivate" class="button"/></td>
<?php
	}
	if($status=="Inactive"){
?>
				<td><input type="submit" name="activate" value="Activate" class="button"/></td>
<?php
	}
?>
                                </tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
				<td><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/></td>
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
