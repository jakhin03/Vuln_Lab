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
	include ("../database/connect.php");?>

	<?php
		if (isset($_SESSION['username']) && $_SESSION['username']){
			$username = $_SESSION['username'];
			echo 'Hello <strong> '.$username."</strong><br/>";
       }
       else{
           header("location:../index.php?message=nologin");
       }
       ?>
<!-- view user's profile-->
	<form action = "profile.php" method = "GET">
		<button type="submit">PROFILE</button>
	</form>
<!-- admin panel -->
	<?php
		$sql = "SELECT * FROM users WHERE username = '$username';";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		if ($row['is_admin'] == 1){
			echo "<form action = 'admin/admin.php' method = 'GET'>
			<button type = 'submit'>ADMIN PANEL</button></form>";
		}
	?>
<!-- search-->
	<form action = "search.php" name = "search" method = "GET">
		<input type="text" name="search" placeholder = "Search for something">
		<select name ="search_for">
			<option value ="user">User</option>
			<option value ="post">Post</option>
		</select>
		<button type="submit">Search</button>
		<br><br>
	</form>
<!-- Post-->
	<form action = "../procedure/post.php" method ="POST">
		<input type="text" name="title" placeholder = "Title"><br>
		<textarea name="post" rows="10" cols="40" placeholder="What are you thinking?"></textarea><br>
		<button type="submit" name = "submit">Post</button>
		<?php 
			if (isset($_GET['error'])){
				$err = $_GET['error'];
				if ($err == "emptyinput"){
					echo"Type something!<br>";
				}
				if ($err == "notadmin"){
					echo"Only admin";
				}
			}
		?>
	</form>
<!-- settings for adjust information -->
	<form action = "settings.php" method ="POST">
	   <button type="submit">Settings</button>
	</form>

	<?php include ("footer.php");?>
</body>
</html>