<?php

require 'connection.php';
$conn = Connect();

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
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
    <title>Edit Movie</title>
    <link rel="stylesheet" type="text/css" href="style/mystyle.css">
  </head>

  <body>
    <div class="content" id="headlineWrapper">
    	<?php include('include/header.php') ?>
    	<?php include('include/nav.php') ?>
    </div>

    <br>

    <div class="content">
      <form name="edit-movie-form" action="update.php" onsubmit="return validateForm()" method="post">
        <fieldset>
          <legend>Update Movie</legend>
          <?php
            echo "<input type='hidden' name='id' value='$movie[id]'>";
            echo "<label>Movie Title: </label><br>";
            echo "<textarea name='newTitle'>$movie[title]</textarea><br>";

            echo "<label>Year: </label><br>";
            echo "<input type='text' name='newYear' value='$movie[year]'><br>";

            echo "<label>Genre: </label><br>";
            echo "<select name='newGenre'>";
            echo "<option value=''>- Please select the genre -</option>
                  <option value='romance'>Romance</option>
                  <option value='superhero'>Superhero</option>
                  <option value='action'>Action</option>
                  <option value='scifi'>Sci-fi</option>
                  <option value='fantasy'>Fantasy</option>
                  <option value='comedy'>Comedy</option>";
            echo "</select><br>";

            echo "<label>Image's url:</label><br>";
            echo "<input type='text' name='newImage' value='$movie[image]'><br>";

            echo "<label>Synopsis: </label><br>";
            echo "<textarea name='newSynopsis' style='height: 195px; width: 215px'>$movie[synopsis]</textarea><br>";
          ?>
          <input type="submit" name="update" value="Update">
        </fieldset>
      </form>
    </div>

    <div id="footerWrapper">
			<?php include('/include/footer.php') ?>
		</div>

  </body>
</html>

<script>
  function validateForm() {
    var title = document.forms["edit-movie-form"]["newTitle"].value;
    var year = document.forms["edit-movie-form"]["newYear"].value;
    var genre = document.forms["edit-movie-form"]["newGenre"].value;
    var image = document.forms["edit-movie-form"]["newImage"].value;
    if(title == "") {
      alert("Movie title must be filled out.")
      return false;
    }
    else if (year == "") {
      alert("Movie release year must be filled out.")
      return false;
    }
    else if (genre == "") {
      alert("Please choose the genre of the movie. ")
      return false;
    }
    else if (image == "") {
      alert("Please provide the image's url of the movie. ")
      return false;
    }
  }
</script>
