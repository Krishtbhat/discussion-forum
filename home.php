<?php
session_start();
	if(!isset($_SESSION["uname"])) {
		header("Location: ./Login/login.php");
	}
	$db="bdf";
	$server="localhost";
	$username="root";
	$password="root";
	$conn=mysqli_connect($server,$username,$password,$db);
	if(!$conn)
		echo "Failed to establish connection ";

    $a=$_POST['name1'];
	 $e=$_POST['name3'];
	$g=$_POST['name4'];
	$i=$_SESSION['uname'];
	$k="INSERT INTO questions(question,reported,name,year2,topic2)VALUES('$g','FALSE','$i','$a','$e')";
	$succ=mysqli_query($conn,$k);
	if($succ)
	header("Location: http://localhost/ProjectWP/index.php");
	else 
		echo"<h2>Check Your Connection</h2>";
	unset($_POST['name1']);
	 unset($_POST['name3']);
	unset($_POST['name4']);
	mysqli_close($conn);
?>