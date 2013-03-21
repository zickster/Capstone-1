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
                $major = mysqli_real_escape_string($db, strip_tags( $_POST['major']));
                $major1 = mysqli_real_escape_string($db, strip_tags( $_POST['major1']));
                $major2 =  mysqli_real_escape_string($db, strip_tags( $_POST['major2']));
                $major3 = mysqli_real_escape_string($db, strip_tags( $_POST['major3']));
                $major4 = mysqli_real_escape_string($db, strip_tags( $_POST['major4']));
                $major5 = mysqli_real_escape_string($db, strip_tags( $_POST['major5']));

//Null variables
		$in_error=" ";
		$mj_error=" ";

//Validate entered data is not empty
	if ($name=="Select Institution"){
                $in_error="You must select an institution.";
		$c++;
	}elseif(empty($major)){
		$mj_error="You must enter at least one major subject of study.";
		$c++;
//If all data valid enter into DB 
        }else{
//Enter valid data into DB
		 mysqli_query($db, "INSERT INTO majors (name, major) 
			      VALUES ('$name', '$major')");

		if(!empty($major1)){
		 mysqli_query($db, "INSERT INTO majors (name, major) VALUES ('$name', '$major1')");
		}
                if(!empty($major2)){
                 mysqli_query($db, "INSERT INTO majors (name, major) VALUES ('$name', '$major2')");
                }
                if(!empty($major3)){
                 mysqli_query($db, "INSERT INTO majors (name, major) VALUES ('$name', '$major3')");
                }
                if(!empty($major4)){
                 mysqli_query($db, "INSERT INTO majors (name, major) VALUES ('$name', '$major4')");
                }
                if(!empty($major5)){
                 mysqli_query($db, "INSERT INTO majors (name, major) VALUES ('$name', '$major5')");
                }


               	mysqli_close($db);
                        header('Location: index.php');
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


        <title>Add Majors</title>
</head>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Add Majors</h2></th>
                </tr>
                <tr>
                <td>
                <table>



				 <tr><td><label for="name" > Select Institution </label></td><td>
                                                        <select name="name" id="name">
                                                        <option value="Select Institution">Select Institution</option>
<?php
//Retrieve required data from DB and print to page
				$tresults = mysqli_query($db, "SELECT name FROM institutions WHERE status=1 ORDER BY name");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                                <option value="<?php echo $trow['name'] ?>"><?php echo $trow['name'] ?></option>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
                                                        </select><span class="red"><?php echo $in_error ?></span></td></tr>

                                <tr>
                                <td>Major to add</td><td><input type="text" name="major" value="<?php echo $major ?>" size="30"><span class="red"><?php echo $mj_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Major to add</td><td><input type="text" name="major1" value="<?php echo $major1 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>Major to add</td><td><input type="text" name="major2" value="<?php echo $major2 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>Major to add</td><td><input type="text" name="major3" value="<?php echo $major3 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>Major to add</td><td><input type="text" name="major4" value="<?php echo $major4 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>Major to add</td><td><input type="text" name="major5" value="<?php echo $major5 ?>" size="30"></td>
                                </tr>
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
