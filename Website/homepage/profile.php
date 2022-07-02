<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MY WEBSITE</title>
</head>
<body>
	<?php 
	
	include("../header.html");
	require_once("../database/connect.php");
	?>

	<form action = "home.php" method = "GET">		
		<button>Home page</button>
	</form>	
	<?php  
		if(!isset($_GET['username'])){
			if (!isset($_SESSION['username'])){
				header("location:home.php");
			}else{
				$username = $_SESSION['username'];
			}
		}else{
		$username = $_GET['username'];
		}
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		echo "<br><b>Name: </b>".$row['name']."<br>";
		echo "<b>Email: </b>". $row['email']."<br>";
		echo "<b>User: </b>". $row['username']."<br><br><br>";
		$sql = "SELECT * FROM posts WHERE username = '$username'";
		$result = mysqli_query($conn,$sql);
		While($row = mysqli_fetch_assoc($result)) {
    		echo "-------------------------------------<br>";
			echo "<b>ID:</b>".$row['ID']."<br>";
	  		echo "<b>Title:</b> ".$row['title']. "<br>";
    		echo "<b>Date: </b>".$row['date'].'<br>';
    		echo "<b>Content: </b> <pre>". $row['post']."</pre>" ;
    		if ($username == $_SESSION['username']){
    		echo "<a href = '../homepage/postmodify.php?ID=".$row['ID']."''>Edit</a><br>";
    		echo "<a href = '../homepage/deletepost.php?ID=".$row['ID']."''>Delete</a><br>";
    	}
    	}
	?>
	-------------------------------------
	<form action = "settings.php" method ="POST">
	   <button type="submit">Settings</button>
	</form>
	

	
	<?php include ("footer.php");?>
</body>
</html>