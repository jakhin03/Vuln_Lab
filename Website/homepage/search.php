<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<?php
    include("../header.html");

    echo "<form action = 'home.php'><button type ='submit'>Home page</button></form>";
    echo "<form action = 'profile.php' method = 'GET'>
            <button type='submit'>VIEW YOUR PROFILE</button>
        </form><form action = 'search.php' name = 'search' method = 'GET'>
        <input type='text' name='search' placeholder = 'Search for some post'>
        <select name ='search_for'>
            <option value ='user'>User</option>
            <option value ='post'>Post</option>
        </select>
        <button type='submit'>Search</button>
        <br>
    </form>";
    require("../database/connect.php");
    if (empty($_GET['search'])){
        echo"Empty search";
        exit();
    }
    $search = $_GET['search'];
    $search_for = $_GET['search_for'];
    if ($search_for=="user"){
        $sql = "SELECT username FROM users WHERE username like '$search'";
        if ($result = mysqli_query($conn,$sql)){
            if (mysqli_num_rows($result)==0){
                echo "<p>Search for:'".$search."'<br>No user found</p>";
            }else{
                echo "<ul>Search for: '".$search."'<br>Number user found: ".mysqli_num_rows($result)."<br>";
                while ($rows=mysqli_fetch_array($result)){
                    echo"<li> <a href = 'profile.php?username=".$rows['username']."'>".$rows['username']."</a></li><br><br>";
                }
                echo "</ul>";
            }
        }
    }else{
        echo"<p>Only search for users or posts</p>";
    }
    if ($_GET['search_for']=="post"){
        $sql = "SELECT * FROM posts WHERE post like '%$search%' or title like '%$search%'";
        if ($result = mysqli_query($conn,$sql)) {
            if (mysqli_num_rows($result)==0){
                echo "<p>No post found</p>";
            }else{
                echo "<ul>";
                while ($rows=mysqli_fetch_array($result)){
                    echo "<li><b>" .$rows['username']." </b> has post:<br>";
                    echo "<b>Title</b>: ". $rows['title'] . "<br>";
                    echo "<b>Content: </b>".$rows['post']."<br></li>";

                }
                echo"</ul>";
            }
        }
    }
    
    echo"<form action = 'settings.php' method = 'POST'>
<button type='submit'>Settings</button>
</form>";
    
    include("footer.php"); 
?>
</body>
</html>