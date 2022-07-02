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
        $username = addslashes($_POST['username']);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['is_admin'] != 1){
            header('location:../home.php?err=notadmin');
        }
        if (!isset($_POST['action'])){
            header('location:../home.php');
        }
        $action = $_POST['action'];
        $user = $_POST['user'];
        if ($action == "upgrade"){
            $sql = "UPDATE users SET is_admin = 1 WHERE username = '$user'";
            if (mysqli_query($conn,$sql)){
                echo "Role updated!";
                header("location:admin.php");
            }
            
        }
        if ($action == "downgrade"){
            $sql = "UPDATE users SET is_admin = 0 WHERE username = '$user'";
            if (mysqli_query($conn,$sql)){
                echo "Role updated!";
                header("location:admin.php");
        }
    }
        if ($action == "delete"){
            $sql = "DELETE FROM users WHERE username='$user';";
            if (!mysqli_query($conn,$sql)){
                echo "Delete user succesful";
            }else{
                echo "Delete user unsuccesful";
            }
            
            $sql = "DELETE FROM posts WHERE username = '$user';";
            if (!mysqli_query($conn,$sql)){
                echo "Delelte posts unsuccesful";
            }else{
                echo "Delete posts succesful";
            } 
        }

        // if ($action != "delete" || $action != "downgrade" || $action != "upgrade"){
        //     header('location:../home.php');
        // }
    ?>


    <?php
        include("../footer.php"); ?>
    </body>
</html>