<?php
    session_start();

  //  if(isset($_SESSION["usn"]) || isset($_SESSION["uname"])){
    //    session_destroy();
	//} 
	if(isset($_SESSION['usn']) || isset($_SESSION['uname'])) {
		header("Location: ../");
	}
    
    if(isset($_POST["signin"])){

        $db="bdf";
        $username="root";
        $password="";
        $server="localhost";
        $conn=mysqli_connect($server,$username,$password,$db);	
        if(!$conn)
            echo "Failed to establish connection ";
            
        $usn=$_POST["usn"];
        $pass=$_POST["pass"];

        $sql="SELECT pwd FROM login WHERE usn='$usn';";
        $result=mysqli_query($conn,$sql);
        $result=mysqli_fetch_assoc($result);

        

    /*	$sql4 = "SELECT id2 FROM questions WHERE name = '$get_un';";
        $get_id2 = mysqli_query($conn, $sql4);
        $get_id2 = mysqli_fetch_assoc($get_id2);
        $id2 = $_SESSION["id2"] = $get_id2["id2"];

        $sq5 = "SELECT id3 FROM answers WHERE name = '$un';";
        $get_id3 = mysqli_query($conn, $sq5);
        $get_id3 = mysqli_fetch_assoc($get_id3);
        $id3 = $_SESSION["id3"] = $get_id3["id3"];         */

        if($pass == $result["pwd"]){

            $sq="SELECT id FROM login WHERE usn='$usn';";
            $get_id=mysqli_query($conn,$sq);
            $get_id=mysqli_fetch_assoc($get_id);
            $get_id=$get_id["id"];
            $_SESSION["id"] =  $get_id;

            $sq2="SELECT name FROM user_info WHERE id=$get_id";
            $get_un=mysqli_query($conn,$sq2);
            $get_un=mysqli_fetch_assoc($get_un);
            $_SESSION["uname"]=$get_un["name"];
            $get_un = $get_un["name"];
        
            $sql6="SELECT image FROM images WHERE id= $get_id;"; 
            $get_path = mysqli_query($conn, $sql6); 
            $get_path = mysqli_fetch_assoc($get_path); 
            $get_path = $get_path["image"];
            $_SESSION["image_name"] = $get_path;

            $sq3="SELECT department FROM user_info WHERE id=$get_id";
            $get_dept=mysqli_query($conn,$sq3);
            $get_dept=mysqli_fetch_assoc($get_dept);
            $_SESSION["branch"]=$get_dept["department"];

            $sq4="SELECT yr FROM user_info WHERE id=$get_id";
            $get_yr=mysqli_query($conn,$sq4);
            $get_yr=mysqli_fetch_assoc($get_yr);
            $_SESSION["year"]=$get_yr["yr"];

            $sq5="SELECT location FROM user_info WHERE id=$get_id";
            $get_loc=mysqli_query($conn,$sq5);
            $get_loc=mysqli_fetch_assoc($get_loc);
            $_SESSION["location"] = $get_loc["location"];

            $sq7 = "SELECT interest1,interest2, interest3, interest4 FROM user_info WHERE id=$get_id;";
            $get_interests = mysqli_query($conn, $sq7);
            $get_interests = mysqli_fetch_assoc($get_interests);
            $_SESSION["interest1"] = $get_interests["interest1"];
            $_SESSION["interest2"] = $get_interests["interest2"];
            $_SESSION["interest3"] = $get_interests["interest3"];
            $_SESSION["interest4"] = $get_interests["interest4"];

            $_SESSION["usn"] = $usn;	
            header("Location: ../");
        }
        else{
            echo "<script type='text/javascript'>alert('USN or Password is incorrect'); </script>";
            header("Refresh:0; url = ./login.php");
        }
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login and signup</title>

 	 <!-- <script language="javascript" type="text/javascript">
		window.history.forward();
		window.onunload = function(){null};
	 </script> -->

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<script type="text/javascript" src="loginsignup_validate.js" >
	</script>
</head>
<body>
	
    

	<div class="limiter">
		<div class="container-login100" style="background-image: url('bms college.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<center><h2><u>Discussion Forum</u></h2></center><br/>
				<form class="login100-form validate-form flex-sb flex-w" action="./login.php" method="post">
					<span class="login100-form-title p-b-53">
						Sign In With
					</span>

					
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							USN
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "USN is required">
						<input class="input100" type="text" name="usn" id="usn" onchange="validate1('usn');">
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						<a href="#" class="txt2 bo1 m-l-5">
							Forgot?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required" >
						<input class="input100" type="password" name="pass" id="pass">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" name="signin" type="submit">
						Sign In
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Not a member?
						</span>

						<a href="./signup.php" class="txt2 bo1">
							&nbsp;Sign up now
						</a>
					</div> 
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>