<!-- Homepage -->
<!DOCTYPE html>
<html>
	<head>
		<title>AAA Movie Library</title>
		<!-- External Css -->
		<link rel="stylesheet" type="text/css" href="style/mystyle.css">
		<!-- Script -->
		<script>
			function validateForm() {
				var title = document.forms["create-movie-form"]["title"].value;
				var year = document.forms["create-movie-form"]["year"].value;
				var genre = document.forms["create-movie-form"]["genre"].value;
				var image = document.forms["create-movie-form"]["image"].value;
				if(title == "") {
					alert("Movie title must be filled out.");
					return false;
				}
				else if (year == "") {
					alert("Movie release year must be filled out.");
					return false;
				}
				else if (genre == "") {
					alert("Please choose the genre of the movie. ");
					return false;
				}
				else if (image == "") {
					alert("Please provide the image's url of the movie. ");
					return false;
				}
			}
		</script>
	</head>

	<body>

<!-- Headling Wrapper -->
		<div class="content" id="headlineWrapper">
			<?php include('include/header.php') ?>
			<?php include('include/nav.php') ?>
		</div>

<!-- Showcase Wrapper -->
		<div class="content" id="showcaseWrapper">
			<h2>Welcome to AAA Movie Library</h2>
			<p>
				You can create, read, update and delete movie at this page.
				Feel free to contact this website developer to make further improvement.
			</p>
		</div>

<!-- Content Wrapper -->
		<div class="content" id="contentWrapper">
			<!-- Movie Table -->
			<div class="content-movie-table">
				<?php
					require 'connection.php';
					$conn = Connect();
					$sql = "SELECT * FROM movie";
					$movies = $conn->query($sql);

					if ($movies->num_rows > 0) {
						echo "<table width='45%' border='solid' align='center'><tr>
						<th width='250px'>Movie Poster</th>
						<th width='400px'>Movie Title</th>
						<th width='120px'>Year Release</th>
						<th width='150px'>Action</th></tr>";

						while ($row = $movies->fetch_assoc()) {
							echo "<tr>
							<td><img src='".$row["image"]."' width='250px' height='300'></td>
							<td>".$row["title"]."</td>
							<td>".$row["year"]."</td>
							<td><a href='edit.php?edit=".$row['id']."'>Edit</a> <a href='show.php?show=".$row['id']."'>Show</a> <a href='delete.php?delete=".$row['id']."'>Delete</a></td></tr>";
						}
						echo "</table>";
					} else {
						echo "No movies to display";
					}

					$conn->close();
				?>
			</div>

			<br>

			<!-- Create Form -->
			<div class="content" id="createWrapper">
				<form name="create-movie-form" action="create.php" onsubmit="return validateForm()" method="post">
					<fieldset>
						<legend>Create Movie</legend>
						<!-- Title -->
						<label>Movie Title: </label><br>
						<input type="text" name="title">
						<br>

						<!-- Year -->
						<label>Year: </label><br>
						<input type="text" name="year">
						<br>

						<!-- Genre -->
						<label>Genre: </label><br>
						<select name="genre">
							<option value="" disabled selected>- Please Select the genre -</option>
							<option value="romance">Romance</option>
							<option value="superhero">Superhero</option>
							<option value="action">Action</option>
							<option value="scifi">Sci-fi</option>
							<option value="fantasy">Fantasy</option>
							<option value="comedy">Comedy</option>
						</select>
						<br>

						<label>Image's url:</label><br>
						<input type="text" name="image">
						<br>

						<label>Synopsis: </label><br>
						<textarea name="synopsis" style="height: 195px; width: 215px"></textarea>
						<br>

						<input type="submit" value="Save Movie">
					</fieldset>
				</form>
			</div>

		</div>

		<div class="content">
			<?php include('include/footer.php') ?>
		</div>

	</body>
</html>
