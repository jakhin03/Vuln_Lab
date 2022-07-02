<?php session_start(); 
		if (isset($_SESSION['username'])){
			header("location:homepage/home.php");
		}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.error{color: red;}
	</style>
	<title>MY WEBSITE LOGIN</title>
</head>
<body>
	<?php include ("header.html"); ?>
	<form action="procedure/loginproc.php" method="POST">
		Username: <input type="text" name="username" placeholder="username" value = "<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"><br>
		Password: <input type = "password" name= "password" placeholder="password" value = "<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"><br>
		<input type="checkbox" name="remember" /> Remember me<br>
		<input type = "submit" name="submit">
	</form>
	<?php

		if (isset($_GET['error'])){
			$error = $_GET['error'];
			if ($error == "nologin"){
				echo "Please login!";
			}
			if ($error == "emptyinput"){
				echo "Please fill the form.";
			}
			if ($error == "user_noexists"){
				echo "Username does not exist!";
			}
			if ($error== "wrongpassword"){
				echo "Wrong password!";
			}
		}	
	?>
	<form action = "index.php" method = "GET">
		<button>Back to menu selection</button>
	</form>
	<?php include("footer.html");?>
</body>
</html>