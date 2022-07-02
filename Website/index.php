<?php session_start(); 
		if (isset($_SESSION['username'])){
			header("location:homepage/home.php");
		}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MY WEBSITE</title>
</head>
<body>
	<?php include("header.html");?>
		<a href="login.php">LOG IN</a><br>
		<a href="signup.php">SIGN UP</a><br><br>
	<form action = "homepage/search.php" name = "search" method = "GET">
		<input type="text" name="search" placeholder = "Search for something">
		<select name ="search_for">
			<option value ="user">User</option>
			<option value ="post">Post</option>
		</select>
		<button type="submit">Search</button>
		<br><br>
	</form>
	<?php 

		if(isset($_GET['message'])){
			$message = $_GET['message'];
			if ($message == 'signupsuccess'){
				echo "Sign up successfully!";
			}
			if ($message == 'nologin'){
				echo"Please login or sign up new account!";
			}

		}
	?>
	<?php include("footer.html");?>

</body>
</html>