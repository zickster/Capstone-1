<!DOCTYPE html>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $article_id = mysqli_real_escape_string($db, strip_tags($_GET['id']));


        if($_POST['submit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $text = mysqli_real_escape_string($db, strip_tags( $_POST['text']));
//Set new text
                mysqli_query($db, "UPDATE tbl_articles SET art_text='$text' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }

//return to home page
        if($_POST['exit']){
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_article.php?id='.$id);
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
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_articles WHERE id='$article_id'");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['art_name'];
						$id=$trow['id'];
						$art_text=$trow['art_text'];
						$page_id=$trow['page_id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td><?php echo $name ?></td>
				<td><TEXTAREA NAME="text" COLS=80 ROWS=6><?php echo $art_text ?></TEXTAREA></td>
				<td><input type="submit" name="submit" value="Submit" class="button"/></td>
				<td><input type="hidden" name="page_id" value="<?php echo $page_id ?>"></td>
				<td><input type="hidden" name="id" value="<?php echo $id ?>"></td>
                                </tr>
				<tr><td><input type="submit" name="exit" value="Exit" class="button"/></td></tr>

				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
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
