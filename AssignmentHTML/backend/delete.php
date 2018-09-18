<?php

require 'connection.php';
$conn = Connect();

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM movie WHERE id='".$id."'";
  $result = $conn->query($sql);

  $conn->close();
}

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
      <h3>Movie deleted!</h3>
      <p>Click on this <a href="../backend">destination</a> to go back to homepage.</p>
    </div>

    <div id="footerWrapper">
			<?php include('/include/footer.php') ?>
		</div>

  </body>
</html>
