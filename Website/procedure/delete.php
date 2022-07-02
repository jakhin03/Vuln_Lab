<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DELETE USER</title>
</head>
<body>
	<?php
	session_start();
	require("../database/connect.php");
	$err = "";
	$check = False;
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST["password"])){
			header("location: /checkuseraccount.php");
		}else{
			$username=$_SESSION['username'];
			$password = $_POST["password"];
			$sql = "SELECT username,password FROM users WHERE username = '$username'";
			$result = mysqli_query($conn,$sql);
    		$row = mysqli_fetch_assoc($result);
    		if($password != $row['password']){
    			header("location: checkuseraccount.php");
    		}else{
    			$check = True;
    		}
		}
	}

	 
	?>
	<?php 
	if($check==True){
		$username = $_SESSION['username'];
		$sql = "DELETE FROM users WHERE username='$username'";
    	$result = mysqli_query($conn,$sql);
    	$sql = "DELETE FROM posts WHERE username = '$username'";
    	$result = mysqli_query($conn,$sql);
    	session_destroy();
    } ?>
    <a href="../index.php">Get back to login choices</a>
</body>
</html>