<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ADMIN PANEL</title>
    </head>
    <body>
    <?php 
        include("../../header.html");
        require("../../database/connect.php");
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['is_admin'] != 1){
            header('location:../home.php?err=notadmin');
        }
    ?>
    	<form action = "../home.php" method = "GET">		
		<button>Home page</button>
	</form>
    <form action = "adminproc.php" name = "search" method = "POST">
		<select name ="user">
            <?php 
            $sql = "SELECT * from users;";
            $result = mysqli_query($conn,$sql);
            
            While($row = mysqli_fetch_assoc($result)){
                echo "<option value ='".$row['username']."'>".$row['username']." (".($row['is_admin'] == 1 ? 'admin': 'normal').")</option>";
            }
            ?>
		</select>
        <button name = 'action' value = 'upgrade' type = 'submit'>Upgrade user</button>
        <button name = 'action' value = 'downgrade' type = 'submit'>Downgrade user</button>
        <button name = 'action' value = 'delete' type = 'submit'>Delete user</button>
		<br><br>
	</form>

    <hr>
    <form action = "../logout.php" method = "GET">       
        <button>Log out</button>
    </form>
    </body>
</html>