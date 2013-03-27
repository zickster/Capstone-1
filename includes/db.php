<?php
//Create DB variable for DB server and user credentials
        $db = mysqli_connect("localhost", "webtoolkit", "q76RR5rclX") or die(mysqli_error());
//Select DB ti use
        mysqli_select_db($db, "webtoolkit") or die(mysqli_error());
?>

