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
//Refer to correct page for college edit
                        header('Location: edit_college.php?id='.$id);
                        exit();
                }    

        if($_POST['delete']){
//Added sql security to prevent sql injection
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE institutions SET status='0' WHERE name='$name'");
                mysqli_close($db);


                        header('Location: index.php');
                        exit();
                }    
//return to homne page
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

        <table border="1" class="table1">
                <tr>
                        <th><h2>Edit an Institution</h2></th>
                </tr>
                <tr>
                <td>
                <table>

<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM institutions WHERE status=1 ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['name'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td><?php echo $name ?></td>
				<td><input type="hidden" name="id" value="<?php echo $id ?>"></td>
				<td><input type="submit" name="edit" value="Edit" class="button"/></td>
				<td><input type="submit" name="delete" value="Deactivate" class="button"/></td>
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
