<?php
//Create DB variable for DB server and user credentials
        $db = mysqli_connect("localhost", "flcollegeinfo", "Malcom123!") or die(mysqli_error());
//Select DB ti use
        mysqli_select_db($db, "flcollegeinfo") or die(mysqli_error());
?>

