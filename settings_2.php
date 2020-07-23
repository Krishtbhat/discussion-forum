<?php
    
	session_start();
	include "common.php";

	$user = $_SESSION["id"];

	if(!(isset($_POST["chk_box1"]))){
		$sq1 = "UPDATE login SET ques_notif = 'false' WHERE id=$user;";
		if(!(mysqli_query($conn, $sq1))){
			echo "<h3>Could not Update</h3><br/> $id2 ok";
		}
	} 

	if(!(isset($_POST["chk_box3"]))){
		$sq2 = "UPDATE login SET upvotes_notif = 'false' WHERE id = $user;";
		mysqli_query($conn, $sq2);
	} 

	if(!(isset($_POST["chk_box4"]))){
		$sq3 = "UPDATE login SET comments_notif = 'false' WHERE id = $user;";
		mysqli_query($conn, $sq3);
	} 

	header("Refresh:0; url=./settings_page.php");

?>