<?php

require 'connection.php';
$conn = Connect();

$id = $conn->real_escape_string($_POST['id']);
$newTitle = $conn->real_escape_string($_POST['newTitle']);
$newYear = $conn->real_escape_string($_POST['newYear']);
$newGenre = $conn->real_escape_string($_POST['newGenre']);
$newImage = $conn->real_escape_string($_POST['newImage']);
$newSynopsis = $conn->real_escape_string($_POST['newSynopsis']);

$query = "UPDATE movie SET title='".$newTitle."',
            year='".$newYear."',
            genre='".$newGenre."',
            image='".$newImage."',
            synopsis='".$newSynopsis."'
            WHERE id='".$id."'
          ";

$success = $conn->query($query);

if (!$success) {
    die("Couldn't enter data: ".$conn->error);
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thank you</title>
    <link rel="stylesheet" type="text/css" href="style/mystyle.css">
  </head>
  <body>
    <!-- Headling Wrapper -->
    <div class="content" id="headlineWrapper">
    	<?php include('include/header.php') ?>
    	<?php include('include/nav.php') ?>
    </div>

    <br>

    <div class="content">
      <h3>Movie updated!</h3>
      <p>Click on this <a href="../backend">destination</a> to go back to homepage.</p>
    </div>

    <div id="footerWrapper">
			<?php include('/include/footer.php') ?>
		</div>

  </body>
</html>
