<?php 
	if (!isset($_POST['submit'])){
		header('location:../index.php?error=nologin');
		exit;
	}
function user_noexists($conn,$username,$password){
		$sql = "SELECT username,password FROM users WHERE username = '$username'";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) == 0){
        	header("location:../login.php?error=user_noexists");
        	exit;
    	}
    	$row = mysqli_fetch_assoc($result);
    	if($password != $row['password']){
    		header("location:../login.php?error=wrongpassword");
    		exit;
    	}
}
function validate($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
 }	
?>