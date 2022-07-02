<?php  
	
	if (!isset($_POST['submit'])){
		header('location:../index.php?error=nologin');
		exit;
	}
	require("../database/connect.php");
	require("loginfunc.php");
	// $username =validate($_POST['username']);
	// $password =validate($_POST['password']);
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!$username || !$password) {
        header("location:../login.php?error=emptyinput");
        exit;
    }
	user_noexists($conn,$username,$password);

	session_start();
	$_SESSION['username']=$username;
	if(!empty($_POST["remember"])) {
		setcookie ("username",md5($_POST["username"]),time()+ 3600);
		setcookie ("password",md5($_POST["password"]),time()+ 3600);
	} else {
		setcookie("username","");
		setcookie("password","");
	}	
	header("location:../homepage/home.php");
	exit;	
?>