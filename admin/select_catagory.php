<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');


        if($_POST['edit']){
//Added sql security to prevent sql injection
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Refer to correct page for edit
                        header('Location: select_page.php?id='.$id);
                        exit();
                }    
        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_dept SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_catagory.php?id='.$id);
                        exit();
                }    

        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_dept SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_catagory.php?id='.$id);
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
                        <th><h2>Select a Catagory</h2></th>
                </tr>
                <tr>
                <td>
                <table>
				<th>Catagory</th>
				<th>Status</th>
				<th>Action</th>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_dept ORDER BY sort_order");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['name'];
						$status=$trow['status'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td><?php echo $name ?></td>
                                <td><?php
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
                                echo $status ?></td>
				<td><input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="submit" name="edit" value="Edit" class="button"/>
<?php
	if($status=="Active"){
?>
				<input type="submit" name="deactivate" value="Deactivate" class="button"/>
<?php
	}
	if($status=="Inactive"){
?>	
				<input type="submit" name="activate" value="Activate      " class="button"/></td>
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
