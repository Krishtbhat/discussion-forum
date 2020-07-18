<?php
	session_start();
	$db="bdf";
	$username="root";
	$password="root";
	$server="localhost";
	$conn=mysqli_connect($server,$username,$password,$db);	
	if(!$conn)
        echo "Failed to establish connection ";
        
    $br=$_REQUEST["sel2"];
    $yr=$_REQUEST["sel1"]; 
    $loc=$_REQUEST["changeloc"];
    $int1=$_POST["interest1"];
    $int2=$_POST["interest2"];
    $int3=$_POST["interest3"];
    $int4=$_POST["interest4"];

    $uname=$_SESSION["uname"];

    $sq1="UPDATE user_info SET department='$br', yr='$yr', location='$loc', interest1='$int1', interest2='$int2', interest3='$int3', interest4='$int4' WHERE name='$uname';";

    if(!(mysqli_query($conn, $sq1)))
        echo "COuld not update";
    else{
        $_SESSION["year"]= $yr;
        $_SESSION["branch"] = $br;
        $_SESSION["location"] = $loc;
        $_SESSION["interest1"] = $int1;
        $_SESSION["interest2"] = $int2;
        $_SESSION["interest3"] = $int3;
        $_SESSION["interest4"] = $int4;

        echo "<script type='text/javascript'> alert('Info Updated Succesfully!!'); </script>";
        header("Refresh:0; url=http://localhost/ProjectWP/settings_page.php");
    }
?>