<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>AAA Movie Library</title>

    <link rel="stylesheet" type="text/css" href="style/mystyle.css">

    <script>
			function validateForm() {
				var keyword = document.forms["search-movie-by-type-form"]["keyword"].value;

				if(keyword == "") {
					alert("Please enter a keyword to search.");
					return false;
				}
			}
		</script>
  </head>
  <body>

    <div class="content" id="headlineWrapper">
			<?php include('include/header.php') ?>
			<?php include('include/nav.php') ?>
		</div>

    <div class="content" id="showcaseWrapper">
			<h2>Welcome to AAA Movie Library</h2>
			<p>
				You can search the movie in our library. Feel free to contact us if you
        find any problem.
			</p>
		</div>

    <div class="content" id="contentWrapper">
      <div id="formWrapper">
        <form name="search-movie-by-type-form" action="search.php" onsubmit="return validateForm()" method="post">
          <fieldset>
            <legend>Search movie by:</legend>
            <input type="radio" name="way" value="year" checked>Search by year<br>
            <input type="radio" name="way" value="genre">Search by genre<br>
            <input type="radio" name="way" value="title">Search by title<br>
            <label>Keyword: </label><br>
            <input type="text" name="keyword"><br>
            <br>
            <input type="submit" name="submit" value="Search">
          </fieldset>
        </form>
      </div>

      <br>

      <div id="tableWrapper">
        <table border="solid" width="68%" align="center">
          <?php
            require 'connection.php';
            $conn = Connect();
  					$sql = "SELECT * FROM movie";
  					$movies = $conn->query($sql);
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

            $conn->close();
          ?>
        </table>
      </div>

    </div>

    <div>
      <?php include('include/footer.php') ?>
    </div>

  </body>
</html>
