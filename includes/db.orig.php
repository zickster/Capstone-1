<?php
//Create DB variable for DB server and user credentials
        $db = mysqli_connect("localhost", "webtoolkit", "Sn0Wwh!t3") or die(mysqli_error());
//Select DB ti use
        mysqli_select_db($db, "flcollegeinfo") or die(mysqli_error());
?>

