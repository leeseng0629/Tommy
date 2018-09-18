<?php

require 'connection.php';
$conn = Connect();

$title = $conn->real_escape_string($_POST['title']);
$year = $conn->real_escape_string($_POST['year']);
$genre = $conn->real_escape_string($_POST['genre']);
$image = $conn->real_escape_string($_POST['image']);
$synopsis = $conn->real_escape_string($_POST['synopsis']);

$query = "INSERT into movie (title, year, genre, image, synopsis)
            VALUES ('".$title."', '".$year."', '".$genre."', '".$image."', '".$synopsis."')";
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
    <title>Thank You</title>
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
      <h3>Movie added!</h3>
      <p>Click on this <a href="../backend">destination</a> to go back to homepage.</p>
    </div>

    <div id="footerWrapper">
			<?php include('/include/footer.php') ?>
		</div>

  </body>
</html>
