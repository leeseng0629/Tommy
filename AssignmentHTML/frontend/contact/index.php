<!-- Contact -->
<!DOCTYPE html>
<html>
	<head>
		<title>AAA Movie Library</title>
		<!-- External Css -->
		<link rel="stylesheet" type="text/css" href="../style/mystyle.css">
		<!-- Script -->
		<script>
			function validateForm() {
				var improveOption = document.forms["improve-form"]["improveOption"].value;
				var comment = document.forms["improve-form"]["comment"].value;

				if(improveOption == "") {
					alert("Please select the improve option.");
					return false;
				}
				else if (comment == "") {
					alert("Please write out your comment on the improve option.");
					return false;
				}
				else {
					alert("Thanks for sending messages to us.");
				}
			}
		</script>
	</head>

	<body>

		<div class="content" id="headlineWrapper">
			<?php include('../include/header.php') ?>
			<?php include('../include/nav.php') ?>
		</div>

		<div class="content" id="contentWrapper">
			<form name="improve-form" action="index.php" method="post" onsubmit="return validateForm()">
				<fieldset>
					<legend>Improvement Form</legend>
					<label>What you want to improve?</label> <br>
					<select name="improveOption">
						<option value="">- Please Select the option -</option>
						<option value="lookAndFeel">Look and feel</option>
						<option value="userInterface">Friendliness of User Interface</option>
						<option value="speedLoading">Speed of loading</option>
						<option value="other">Other</option>
					</select>

					<br>
					<br>

					<label>Comment on above topic</label> <br>
					<textarea name="comment" style="width:300px; height:250px"></textarea>

					<br>
					<br>

					<input type="submit" value="Send Message">
				</fieldset>

			</form>
		</div>

		<div id="footerWrapper">
			<?php include('../include/footer.php') ?>
		</div>

	</body>
</html>
