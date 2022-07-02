<?php session_start(); 
	require("../database/connect.php");
	if (!isset($_POST['submit']) || !isset($_GET['ID'])){
		header('location:../homepage/profile.php');
	}
	$ID = $_GET['ID'];
	echo $ID;
    $sql = "DELETE FROM posts WHERE ID = '$ID';";
    $result = mysqli_query($conn,$sql);
    header("location:../homepage/profile.php");
?>
