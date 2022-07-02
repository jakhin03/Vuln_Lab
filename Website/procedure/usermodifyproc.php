<?php  
	session_start();
	if (!isset($_POST['submit'])){
		header("../homepage/home.php");
		exit();
	}
	include("../database/connect.php");
	require("signupfunc.php");
	$username = $_SESSION['username'];
	$name = $email =$password =$confirm_password ="";
	if (!empty($_POST['name'])){
		$name = addslashes($_POST['name']);
		if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      	header("location:../homepage/usermodify.php?error=invalidname");
    	}
	}
	if (!empty($_POST['email'])){
		$email = addslashes($_POST['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      	header("location:../homepage/usermodify.php?error=invalidemail");
    	}
    	if (email_exists($conn,$email)){
			header("location:../homepage/usermodify.php?error=emailexists");
		}
	}
	if (!empty($_POST['password'])){
		$password = addslashes($_POST['password']);
		if (!empty($_POST['confirm_password'])){
			$confirm_password = addslashes($_POST['confirm_password']);
		}
		
		if (password_nomatches($password,$confirm_password)){
			header("location:../homepage/usermodify.php?error=password_nomatches");
		exit();
		}}


        if (!empty($name)){
            $sql = "UPDATE users SET name='$name' WHERE username='$username'";
            $result = mysqli_query($conn,$sql);
		}
		if (!empty($email)){
            $sql = "UPDATE users  SET email='$email' WHERE username='$username'";
            $result = mysqli_query($conn,$sql);
    	}
		if (!empty($password)){
            $sql = "UPDATE users SET password='$password' WHERE username='$username'";
            $result = mysqli_query($conn,$sql);
    	}
	echo "SUCESSFUL! CLICK <a href = '../homepage/profile.php'>here</a>";
	exit();
?>
