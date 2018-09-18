<?php

require 'connection.php';
$conn = Connect();

if (isset($_GET['show'])) {
  $id = $_GET['show'];
  $sql = "SELECT * FROM movie WHERE id='".$id."'";
  $result = $conn->query($sql);
  $movie = $result->fetch_assoc();

  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Movie Details</title>
    <link rel="stylesheet" type="text/css" href="style/mystyle.css">
  </head>
  <body>
    <div class="content" id="headlineWrapper">
    	<?php include('include/header.php') ?>
    	<?php include('include/nav.php') ?>
    </div>

    <br>

    <div>
      <table width="60%" border="solid" align="center">
        <thead>
          <tr>
            <th width="250px">Attribute</th>
            <th width="250px">Value</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Movie Poster</td>
            <td><?php echo "<img src='$movie[image]' width='250px' height='300px'>" ?></td>
          </tr>
          <tr>
            <td>Title</td>
            <td><?php echo "$movie[title]" ?></td>
          </tr>
          <tr>
            <td>Genre</td>
            <td><?php echo "$movie[genre]" ?></td>
          </tr>
          <tr>
            <td>Year Release</td>
            <td><?php echo "$movie[year]" ?></td>
          </tr>
          <tr>
            <td>Synopsis</td>
            <td><?php echo "$movie[synopsis]" ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div id="footerWrapper">
			<?php include('/include/footer.php') ?>
		</div>

  </body>
</html>
