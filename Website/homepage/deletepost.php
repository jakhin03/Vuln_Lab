<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DELETE CONFIRM</title>
</head>
<body>
	<?php include("../header.html"); ?>
	<h3> DO YOU WANT TO DELETE? </h3>
	<form method = "POST" action = <?php echo '../procedure/deletepost.php?ID='.$_GET['ID']; ?> >
		<input type = "submit" name = "submit" value = "YES">
	</form>	
	<form method = "POST" action = "../homepage/profile.php">
		<input type = "submit" name = "submit" value = "NO">
	</form>
	<?php include("footer.php"); ?>


</body>
</html>