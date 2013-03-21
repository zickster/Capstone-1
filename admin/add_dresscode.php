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
                $policy = mysqli_real_escape_string($db, strip_tags( $_POST['policy']));
                $policy1 = mysqli_real_escape_string($db, strip_tags( $_POST['policy1']));
                $policy2 =  mysqli_real_escape_string($db, strip_tags( $_POST['policy2']));
                $policy3 = mysqli_real_escape_string($db, strip_tags( $_POST['policy3']));
                $policy4 = mysqli_real_escape_string($db, strip_tags( $_POST['policy4']));
                $policy5 = mysqli_real_escape_string($db, strip_tags( $_POST['policy5']));

//Null variables
		$in_error=" ";
		$dc_error=" ";

//Validate entered data is not empty
	if ($name=="Select Institution"){
                $in_error="You must select an institution.";
		$c++;
	}elseif(empty($policy)){
		$dc_error="You must enter at least one policy subject of study.";
		$c++;
//If all data valid enter into DB 
        }else{
//Enter valid data into DB
		 mysqli_query($db, "INSERT INTO dress_code (name, policy) 
			      VALUES ('$name', '$policy')");

		if(!empty($policy1)){
		 mysqli_query($db, "INSERT INTO dress_code (name, policy) VALUES ('$name', '$policy1')");
		}
                if(!empty($policy2)){
                 mysqli_query($db, "INSERT INTO dress_code (name, policy) VALUES ('$name', '$policy2')");
                }
                if(!empty($policy3)){
                 mysqli_query($db, "INSERT INTO dress_code (name, policy) VALUES ('$name', '$policy3')");
                }
                if(!empty($policy4)){
                 mysqli_query($db, "INSERT INTO dress_code (name, policy) VALUES ('$name', '$policy4')");
                }
                if(!empty($policy5)){
                 mysqli_query($db, "INSERT INTO dress_code (name, policy) VALUES ('$name', '$policy5')");
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


        <title>Add Dress Code</title>
</head>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Add Dress Code</h2></th>
                </tr>
                <tr>
                <td>
                <table>



				 <tr><td><label for="name" > Select Institution </label></td><td>
                                                        <select name="name" id="name">
                                                        <option value="Select Institution">Select Institution</option>
<?php
//Retrive required data from teh DB and display it
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
                                <td>policy to add</td><td><input type="text" name="policy" value="<?php echo $policy ?>" size="30"><span class="red"><?php echo $dc_error ?></span></td>
                                </tr>
                                <tr>
                                <td>policy to add</td><td><input type="text" name="policy1" value="<?php echo $policy1 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>policy to add</td><td><input type="text" name="policy2" value="<?php echo $policy2 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>policy to add</td><td><input type="text" name="policy3" value="<?php echo $policy3 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>policy to add</td><td><input type="text" name="policy4" value="<?php echo $policy4 ?>" size="30"></td>
                                </tr>
                                <tr>
                                <td>policy to add</td><td><input type="text" name="policy5" value="<?php echo $policy5 ?>" size="30"></td>
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
