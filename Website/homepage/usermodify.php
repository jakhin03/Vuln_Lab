<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>USER MODIFICATION</title>
    </head>
    <body>
        <?php include "../header.html"; ?>
        <form action = "home.php" method = "GET">		
		    <button>Home page</button>
	    </form>
        <form action = "profile.php" method = "GET">
		    <button type="submit">PROFILE</button>
	    </form>
        <form action="../procedure/usermodifyproc.php" method="POST">
            Name: <input type="text" name="name"><br>
            Email: <input type="text" name="email"><br>
            Password: <input type="password" name="password"><br>
            Confirm password: <input type="password" name="confirm_password"><br>
            <input type = "submit" name = "submit" value = "Submit">
        </form>
    <?php
        if (isset($_GET['error'])){
            $err = $_GET['error'];
            if ($err == "password_nomatches"){
                echo "<br>Password not match.";
            }
            if ($err == "invalidname"){
                echo "<br>Invalid name";
            }
            if ($err == "invalidemail"){
                echo "<br>Invalid Email";
            }
            if ($err == "emailexists"){
                echo "<br>Email exists";
            }
        }   
    ?>
    <?php include("footer.php"); ?>
    </body>
</html>