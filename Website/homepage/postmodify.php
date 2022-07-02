<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POST MODIFY</title>
</head>
<body>
	<?php 
    require("../database/connect.php");
	include("../header.html");?>
    <form action = "../homepage/home.php" method = "GET">       
        <button>Home page</button>
    </form>
    <form action = "profile.php" method = "GET">
        <button type="submit">VIEW YOUR PROFILE</button>
    </form>
    <?php
    $id = $_GET['ID'];
    $sql = "SELECT * FROM posts where id = '$id'";
    $result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_assoc($result);
    $username = $_SESSION['username'];
    if ($rows['username'] != $username){
        header('location: home.php');
    }
    $title = "";
    $post = "";
    $posterror = "";
    ?>
    <form method="post">
        <h4>Edit title</h4>
        <input type="text" name="title" id="title" size="50" value="<?php echo $rows['title']; ?>"></input>

        <br><br>
        <h4> Edit content: </h4>
        <textarea name="post" value = "" rows="5" cols="48"><?php echo $rows['post']; ?> </textarea>
        <br>

<?php
    if (isset($_POST['submit'])){
        $title = $_POST['title'];
        $post = $_POST['post'];
        if (!empty($title)){
            $sql = "UPDATE posts SET title='$title' WHERE ID='$id'";
            if (mysqli_query($conn,$sql))
            {
                echo "";
            }
        }
        if (!empty($post)){
            $sql = "UPDATE posts SET post='$post' WHERE ID='$id'";
            if (mysqli_query($conn,$sql))
            {
                echo "UPDATE SUCCESSFUL!<br>";
                header("location:../homepage/profile.php");
            }
        }}
?>
        <input type="submit" name="submit" value="Submit">
        </input>
        <br>
    </form>    

    <form action = "settings.php" method ="POST">
       <button type="submit">Settings</button>
    </form>

    <?php include ("footer.php");?>
</body>
</html>