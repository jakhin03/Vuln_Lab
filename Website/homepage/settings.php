<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SETTING</title>
</head>
<body>
	<?php include("../header.html");?>
	<form action = "home.php"><button type ="submit">Home page</button></form>
	<form action="profile.php"><button type = "submit">Profile</button></form>
	<ul>
		<?php 		
			echo "<li><a href ='../homepage/usermodify.php'>Modify your account</a></li>";
			echo "<li><a href ='../procedure/checkuseraccount.php'>Delete Account</li>";
		?>
	</ul>
	<?php include("footer.php");?>
</body>
</html>