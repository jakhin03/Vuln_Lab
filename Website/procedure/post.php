<?php 
	session_start();
	require("../database/connect.php");
	if (!isset($_POST['submit'])){
		header("location:../homepage/home.php?error=emptyinput");
	}
	if (!$_POST['post']){
		header("location:../homepage/home.php");
	}
	$title = "";
	$username = mysqli_real_escape_string($conn,$_SESSION['username']);
	$title = mysqli_real_escape_string($conn,$_POST['title']);
	$post = mysqli_real_escape_string($conn,$_POST['post']);
	$_POST = array();
	if (empty($post)){
		header("location:../homepage/home.php?error=emptyinput");
	}else{
	$sql = "INSERT INTO posts (username,title,post) VALUES ('$username','$title','$post')";
	if (mysqli_query($conn,$sql)){
		echo "SUCESSFUL! CLICK <a href = '../homepage/profile.php'>here</a>";
		exit();
	}
	else{
		echo"error";
	}}
?>