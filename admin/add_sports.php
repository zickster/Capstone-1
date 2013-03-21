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
                $sport = mysqli_real_escape_string($db, strip_tags( $_POST['sport']));
                $sport1 = mysqli_real_escape_string($db, strip_tags( $_POST['sport1']));
                $sport2 =  mysqli_real_escape_string($db, strip_tags( $_POST['sport2']));
                $sport3 = mysqli_real_escape_string($db, strip_tags( $_POST['sport3']));
                $sport4 = mysqli_real_escape_string($db, strip_tags( $_POST['sport4']));
                $sport5 = mysqli_real_escape_string($db, strip_tags( $_POST['sport5']));

//Null variables
		$in_error=" ";
		$sp_error=" ";

//Validate entered data is not empty
	if ($name=="Select Institution"){
                $in_error="You must select an institution.";
		$c++;
	}elseif(empty($sport)){
		$sp_error="You must enter at least one sport.";
		$c++;
//If all data valid enter into DB 
        }else{
//Enter valid data into DB
		 mysqli_query($db, "INSERT INTO athletics (name, sport) 
			      VALUES ('$name', '$sport')");

		if(!empty($sport1)){
		 mysqli_query($db, "INSERT INTO athletics (name, sport) VALUES ('$name', '$sport1')");
		}
                if(!empty($sport2)){
                 mysqli_query($db, "INSERT INTO athletics (name, sport) VALUES ('$name', '$sport2')");
                }
                if(!empty($sport3)){
                 mysqli_query($db, "INSERT INTO athletics (name, sport) VALUES ('$name', '$sport3')");
                }
                if(!empty($sport4)){
                 mysqli_query($db, "INSERT INTO athletics (name, sport) VALUES ('$name', '$sport4')");
                }
                if(!empty($sport5)){
                 mysqli_query($db, "INSERT INTO athletics (name, sport) VALUES ('$name', '$sport5')");
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


        <title>Add Sport</title>
</head>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Add Sports</h2></th>
                </tr>
                <tr>
                <td>
                <table>



				 <tr><td><label for="name" > Select Institution </label></td><td>
                                                        <select name="name" id="name">
                                                        <option value="Select Institution">Select Institution</option>
<?php
//Retrieve required information from DB and display on page
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
                                <td>sport to add</td><td><input type="text" name="sport" value="<?php echo $sport ?>" size="30"><span class="red"><?php echo $sp_error ?></span></td>
                                </tr>
                                <tr>
                                <td>sport to add</td><td><input type="text" name="sport1" value="<?php echo $sport1 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>sport to add</td><td><input type="text" name="sport2" value="<?php echo $sport2 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>sport to add</td><td><input type="text" name="sport3" value="<?php echo $sport3 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>sport to add</td><td><input type="text" name="sport4" value="<?php echo $sport4 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>sport to add</td><td><input type="text" name="sport5" value="<?php echo $sport5 ?>" size="30"></td>
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
