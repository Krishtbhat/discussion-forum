<?php
    
	session_start();
	$db="bdf";
	$username="root";
	$password="root";
	$server="localhost";
	$conn=mysqli_connect($server,$username,$password,$db);	
	if(!$conn)
        echo "Failed to establish connection ";

    $cur_pass = $_POST["curPass"];
    $new_pass = $_POST["newPass"];
    $cnf_pass = $_POST["cnfPass"];

    $uname = $_SESSION["uname"];

    $sq="SELECT id FROM user_info WHERE name='$uname';";
	$get_id=mysqli_query($conn,$sq);
	$get_id=mysqli_fetch_assoc($get_id);
    $get_id=$get_id["id"];
    
    $sq="SELECT usn FROM login WHERE id='$get_id';";
	$get_usn=mysqli_query($conn,$sq);
	$get_usn=mysqli_fetch_assoc($get_usn);
    $get_usn=$get_usn["usn"];
    $_SESSION["usn"]=$get_usn;

    $sql1="SELECT pwd FROM login WHERE id='$get_id';";
    $get_pwd = mysqli_query($conn, $sql1);
    $get_pwd = mysqli_fetch_assoc($get_pwd);
    $get_pwd = $get_pwd["pwd"];

    if ($cur_pass == $get_pwd) {
        
        if ($new_pass == $cnf_pass) {
            
            $sql2 = "UPDATE login SET pwd='$new_pass' WHERE usn='$get_usn';";
             mysqli_query($conn , $sql2);
            echo "<script type='text/javascript'> alert('Password updated successfully!!'); </script>";
            header("Refresh:0; url=./settings_page.php");

        } else {
            echo "<script type='text/javascript'> alert('Passwords not matching!!')</script>";
            header("Refresh:0; url=./settings_page.php");
        }
        
    }
    else {

        if($cur_pass == ""){
            echo "<script type='text/javascript'> alert('Password field is empty!!'); </script>";
            header("Refresh:0; url=./settings_page.php");

        }
        else{
            echo "<script type='text/javascript'> alert('Current Password is wrong!!'); </script>";
            header("Refresh:0; url=./settings_page.php");
        }
    }

?>