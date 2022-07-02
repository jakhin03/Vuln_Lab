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
	<title>MY WEBSITE SIGNUP</title>
</head>
<body>
	<?php include ("header.html");	?>
	<form action="procedure/signupproc.php" method="POST">
		Name: <input type ="text" name = "name" placeholder ="Your name"><br>
		Email: <input type = "text" name = "email" placeholder="Your email"><br>
		Username: <input type="text" name="username" placeholder="username"><br>
		Password: <input type = "password" name= "password" placeholder="password"><br>
		Confirm password: <input type = "password" name= "confirm_password" placeholder="confirm_password"><br>
		<input type = "submit" name="submit">
	</form>
	<?php
		if (isset($_GET['error'])){
			$err = $_GET['error'];
			if ($err == "nosignup"){
				echo "Please sign up!<br>";
			}
			if ($err == "emptyInputSignup"){
				echo "Please fill the form.";
			}
			if ($err == "user_exists"){
				echo "Try another username.";
			}
			if ($err == "password_nomatches"){
				echo "Password not match.";
			}
			if ($err == "invalidname"){
				echo "Invalid name";
			}
			if ($err == "invalidemail"){
				echo "Invalid Email";
			}
			if ($err == "emailexists"){
				echo "Email exists";
			}
		}	
	?>
	<form action = "index.php" method = "GET">
		<button>Back to menu selection</button>
	</form>
	<?php include("footer.html");?>
</body>
</html>