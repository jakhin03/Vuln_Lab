<form action = "../homepage/home.php"><button type ="submit">Home page</button></form>
<form action="../homepage/profile.php"><button type = "submit">Profile</button></form>
<hr>
<?php
	session_start();
	$username=$_SESSION['username'];
	require("../database/connect.php");
	$err = "";
	$check = False;
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST["password"])){
			$err = "Please enter your password";
		}else{
			$password = $_POST["password"];
			$sql = "SELECT username,password FROM users WHERE username = '$username'";
			$result = mysqli_query($conn,$sql);
    		$row = mysqli_fetch_array($result);
    		if($password != $row['password']){
    			$err = "Wrong password. Please enter your password again";
    			mysqli_close($conn);
    		}else{
    			$check = True;
    		}
		}
	}

	 
?>
<form method="post" action = "delete.php"> 
	Confirm your password: <input type= "password" placeholder="your password" name = "password">
	<span style = "color:red"><?php echo $err;?></span><br>
	<input type = "submit">
</form>


