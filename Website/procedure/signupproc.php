<?php  
	if (!isset($_POST['submit'])){
		header('location:../signup.php?error=nosignup');
	}
	include("../database/connect.php");
	require("signupfunc.php");
	$name = addslashes($_POST['name']);
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$email = addslashes($_POST['email']);
	$confirm_password = addslashes($_POST['confirm_password']);
	if (emptyInputSignup($username,$name,$email,$password,$confirm_password)){
		header("location:../signup.php?error=emptyInputSignup");
		exit();
	}
	if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      header("location:../signup.php?error=invalidname");
	  exit();
    }
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("location:../signup.php?error=invalidemail");
	  exit();
    }
	if (email_exists($conn,$email)){
		header("location:../signup.php?error=emailexists");
		exit();
	}
	if (user_exists($conn,$username)){
		header("location:../signup.php?error=user_exists");
		exit();
	}
	if (password_nomatches($password,$confirm_password)){
		header("location:../signup.php?error=password_nomatches");
		exit();
	}
	$sql = "INSERT INTO users (name,email,username,password) VALUES ('$name','$email','$username','$password');";
	
	if ($result = mysqli_query($conn, $sql)) {
 		echo("Sign up successful");
	}

	header("location:../index.php?message=signupsuccess");
	exit();
?>