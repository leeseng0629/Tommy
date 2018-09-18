<?php

require "connection.php";
$conn = Connect();

$sql = "";
$way = $conn->real_escape_string($_POST['way']);
$keyword = $conn->real_escape_string($_POST['keyword']);

if ($way == 'year') {
  $sql = "SELECT * FROM movie WHERE year like '%$keyword%'";
}
elseif ($way == 'genre') {
  $sql = "SELECT * FROM movie WHERE genre like '%$keyword%'";
}
else {
  $sql = "SELECT * FROM movie WHERE title like '%$keyword%'";
}

$movies = $conn->query($sql);

$conn->close();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>AAA Movie Library</title>

    <link rel="stylesheet" type="text/css" href="style/mystyle.css">
  </head>

  <body>

    <div class="content" id="headlineWrapper">
			<?php include('include/header.php') ?>
			<?php include('include/nav.php') ?>
		</div>

    <div class="content" id="contentWrapper">

      <div id="tableWrapper">
        <table border="solid" width="68%" align="center">
          <?php
            $num = 0;

            if ($movies->num_rows > 0) {
              echo "<tr>";
              while ($movie = $movies->fetch_assoc()) {
                echo "<td align='center'><a href='show.php?show=".$movie['id']."'><img src='".$movie["image"]."' width='250px' height='300'><br>
                      <span>".$movie['title']."</span></a></td>";
                $num++;
                if ($num == 5) {
                  echo "</tr><tr>";
                  $num = 0;
                }
              }
            } else {
              echo "No movies to display";
            }
          ?>
        </table>
      </div>

    </div>

  </body>
</html>
