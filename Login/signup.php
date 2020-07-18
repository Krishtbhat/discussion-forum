<?php
	
	session_start();

//	if(isset($_SESSION["usn"]) || isset($_SESSION["uname"])){
//		session_destroy();
//    }

	if(isset($_POST["signup"])){
		$db="bdf";
		$server="localhost";
		$username="root";
		$password="root";
		$conn=mysqli_connect($server,$username,$password,$db);
		if(!$conn)
			echo "<h2>Failed to establish connection </h2>";

		$un=$_REQUEST["un"];	
		$usn1=$_REQUEST["usn1"];
		$emailid=$_REQUEST["emid1"];
		$pwd=$_REQUEST["pass1"];
		$branch=$_REQUEST["sel2"];
		$year=$_REQUEST["sel1"];

		$_SESSION["uname"]=$un;	
		$_SESSION["year"]=$year;
		$_SESSION["usn"] = $usn1;
		$_SESSION["branch"]=$branch;

		$_SESSION["location"] = "";
		$_SESSION["interest1"] = "";
		$_SESSION["interest2"] = "";
		$_SESSION["interest3"] = "";
		$_SESSION["interest4"] = "";

		$sql="INSERT INTO login(usn,pwd) VALUES('$usn1','$pwd')";
		mysqli_query($conn,$sql);

		$sq ="SELECT id FROM login WHERE usn='$usn1';";
		$get_id=mysqli_query($conn, $sq );
		$get_id=mysqli_fetch_assoc($get_id);
		$get_id=$get_id["id"];
		$_SESSION["id"] =  $get_id;

		$sql1="INSERT INTO user_info(name,emailid,yr,department) VALUES('$un','$emailid','$year','$branch')";
		if(!(mysqli_query($conn,$sql1)))
			echo "<h2>Coudn't add the details</h2>";

		$sql2 = "INSERT INTO images(id) VALUES ($get_id);";
		if(!(mysqli_query($conn, $sql2))){
			echo "skjl";
		}

	/*	$sql3 = "INSERT INTO questions(name) VALUES ('$un');";
		$g = mysqli_query($conn, $sql3);
		$sq4 = "SELECT id2 FROM questions WHERE name = '$un';";
		$get_id2 = mysqli_query($conn, $sq4);
		$get_id2 = mysqli_fetch_assoc($get_id2);
		$id2 = $_SESSION["id2"] = $get_id2["id2"];

		$sql5 = "INSERT INTO answers(id2,name) VALUES ($id2, '$un');";
		$s = mysqli_query($conn, $sql5);
		$sq5 = "SELECT id3 FROM answers WHERE name = '$un';";
		$get_id3 = mysqli_query($conn, $sq5);
		$get_id3 = mysqli_fetch_assoc($get_id3);
		$id3 = $_SESSION["id3"] = $get_id3["id3"];  

		$sql6 = "INSERT INTO comments(id3, name) VALUES ($id3, '$un');";
		$h = mysqli_query($conn, $sql6);  */
		
		header("Location: http://localhost/ProjectWP/settings_page.php");

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login and signup</title>

	<script  type="text/javascript">
		window.history.forward();
		window.onunload = function(){null};
	</script>

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
	<script type="text/javascript" src="loginsignup_validate.js">
	</script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('bms college.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<center><h2><u>Discussion Forum BMSCE</u></h2></center><br/>
				<form class="login100-form validate-form flex-sb flex-w" action="http://localhost/ProjectWP/Login/signup.php" method="post">
					<span class="login100-form-title p-b-53">
						Sign Up
					</span>

					<div class="p-t-31 p-b-9">
						<span class="txt1" >
							Name
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input class="input100" type="text" name="un" id="un" placeholder="Enter full name">
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							USN
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "USN is required">
						<input class="input100" type="text" name="usn1" id="usn1"  onchange="validate2('usn1');"/>
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Email-id(College id)
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Email-id is required">
						<input class="input100" type="text" name="emid1" id="emid1" onchange="validate2('emid1');" >
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass1" id="pass1"  />
						<span class="focus-input100"></span>
					</div>
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Re-enter password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="repass1" id="repass1" onchange="validate2('repass1');" />
						<span class="focus-input100"></span>
					</div>
					<div class="form-group">
						<div class="p-t-31 p-b-9">
							<label for="sel2"><span class="txt1">Department</span></label>
						</div>
							<select class="form-control" id="sel2" name="sel2">
								<option value="CSE" id="cse0" name="cse0">Computer Science and Engineering</option>
								<option value="ISE" id="ise0" name="ise0">Information Science and Engineering</option>
								<option value="ECE" id="ece0" name="ece0">Electronics and Communications Engineering</option>
								<option value="EEE" id="eee0" name="eee0">Electrical and Electronics Engineering</option>
								<option value="MLE" id="mle0" name="mle0">Mechanical Engineering</option>
								<option value="IEM" id="iem0" name="iem0">Industrial Engineering and Management</option>
								<option value="BTE" id="bte0" name="bte0">Bio-Technology</option>
								<option value="CHE" id="che0" name="che0">Chemical Engineering</option>
								<option value="CIV" id="civ0" name="civ0">Civil Engineering</option>
								<option value="EIE" id="eie0" name="eie0">Electronis and Instrumentation Engineering</option>
								<option value="TCE" id="tce0" name="tce0">Telecommunication and Engineering</option>
								<option value="MDE" id="mde0" name="mde0">Medical Electronics</option>
							</select>
					</div>
					<div class="form-group">
						<div class="p-t-31 p-b-9">
							<label for="sel1"><span class="txt1">Year</span></label>
						</div>
							<select class="form-control" id="sel1" name="sel1">
								<option value="First" id="one">1</option>
								<option value="Second">2</option>
								<option value="Third">3</option>
								<option value="Fourth" id="four">4</option>
							</select>
					</div>
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" name="signup" type="submit" >
							Sign Up
						</button>
					</div>
					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Already have an account?
						</span>

						<a href="http://localhost/ProjectWP/Login/login.php" class="txt2 bo1">
							&nbsp;Sign in now
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