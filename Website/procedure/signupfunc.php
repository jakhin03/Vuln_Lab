<?php
	if (!isset($_POST['submit'])){
		header('location:../index.php?error=nologin');
		exit;
	}
	function emptyInputSignup($username,$name,$email,$password,$confirm_password){
		if(!$username || !$password || !$confirm_password || !$name || !$email){
			return True;
		}
		return False;
	}
	function user_exists($conn,$username){
		$sql = "SELECT * FROM users WHERE username = '$username';";
		$result = mysqli_query($conn,$sql);
		if ($row = mysqli_fetch_assoc($result)){
			return True;
		}
		return False;
	}
	function email_exists($conn,$email){
		$sql = "SELECT * FROM users WHERE email = '$email';";
		$result = mysqli_query($conn,$sql);
		if ($row = mysqli_fetch_assoc($result)){
			return True;
		}
		return False;
	}

	function password_nomatches($password,$confirm_password){
		if ($password==$confirm_password){
			return False;
		}
		return True;
	}
?>