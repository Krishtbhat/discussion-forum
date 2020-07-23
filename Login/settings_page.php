<?php
	session_start();

	require "check_session.php";

	$conn=mysqli_connect("localhost", "root", "", "bdf");
	if (!$conn) {
		echo "<h2>Coudn't establish a connection</h2>";
	}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<title><?php echo "Settings- ".$_SESSION["uname"];    ?></title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS 4.1.3-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
		<!-- Bootstrap icons (fontawsome)-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


		<script type="text/javascript">

			//	function preback(){ window.history.forward();}
			//		setTimeout("preback()",0);
			//		window.onunload = function(){null};
			
			function logout_func(){
				if(confirm("Do you want to Logout?") === true){
					window.location.replace("http://localhost/ProjectWP/Login/login.php");
					
				} else{
					window.location.href = "http://localhost/ProjectWP/settings_page.php";
				}
			}

			function del_account() {
				if(confirm("You won't be able to recover it once you permanently delete the account. \nAre you sure you want to permanently delete the account?") == true)
					return true;
				else{
					return false;
				}
			}
		</script>

</head>
<body class="bg-light">
	<!--Nav bar-->
	
	<div class="container-fluid sticky-top bg-dark" style="color:black;background-color:black;">
	  <nav class="nav navbar navbar-expand-md navbar-dark bg-dark" style="color:black;">
		  <a class="navbar-brand display-4" href="#"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" width="30" height="30" alt="">&nbsp;Discussion Forum BMSCE</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
			  <li class="nav-item pl-md-4 mx-2 order-sm-1">
				<a class="nav-link " href="http://localhost/ProjectWP/index.php"><span><i class="fa fa-home"></i></span>&nbsp;Home <span class="sr-only">(current)</span></a>
			  </li>
		
			  <li class="nav-item mx-2 dropdown order-sm-2">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="fa fa-bell"></i></span>&nbsp;Notifications
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				  <a class="dropdown-item" href="#">Action</a>
				  <a class="dropdown-item" href="#">Another action</a>
				  <a class="dropdown-item" href="#">Something else here</a>
				</div>
			  </li>
			</ul>
			
			<div class="form d-md-flex order-sm-4 order-md-3">
				<form class="form-inline d-sm-block my-2 mr-3 my-lg-0">
				<div class="input-group">
				
				  <input type="text" class="form-control d-sm-block border-right" placeholder="Search here" aria-label="Recipient's username" aria-describedby="button-addon2">
				  <div class="input-group-append border-left">
					<button class="btn btn-light rounded-right input-group-addon  my-sm-0" type="submit"><i class="fa fa-search"></i></button>
				  </div>
				  
				</div>
				</form>
			</div>
			
			<ul class="navbar-nav mx-md-2 justify-content-end order-sm-3 order-md-4">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
					  My Profile
					</a>
					<div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
					  <a class="dropdown-item " href="http://localhost/ProjectWP/profile_page.php"><i class="fa fa-user"></i> Profile</a>
					  <a class="dropdown-item border-top active" href="http://localhost/ProjectWP/settings_page.php"><i class="fa fa-wrench"></i> Settings</a>
						<form method="post" action="Login/logout.php">
					  <button type="submit" class="dropdown-item border-top btn" id="logout" name="logout" ><i class="fa fa-sign-out"></i> Logout</button>
						</form>
							
					</div>
				  </li>
			</ul>
			
		  </div>
	</nav>
	</div>
		<!--End of nav-->
	
		<!---  next section ( row )-->
	<div class="container-fluid px-4 bg-light pt-0" >
			
	  <div class="row bg-light mb-2" >
		<!-- Left column-->	  
	  <div class="col-sm-3 order-sm-1 border-right border-left border-bottom my-2">
	  
	     <div class="bg-info mt-2 p-2">
			<h4 class="text-white ml-3"><i class="fa fa-cog"></i> Settings</h4>
		  </div>
		  
		<div class="list-group list-group-flush mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		  <a class="list-group-item list-group-item-action border active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" ><i class="fa fa-wrench"></i> General</a>
		  
		  <a class="list-group-item list-group-item-action border" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"><i class="fa fa-envelope-o"></i> Emails &amp; Notifications</a>
		  <a class="list-group-item list-group-item-action border" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"><i class="fa fa-key"></i> Password</a>
		</div>
	  </div>
	  
	  	  <!-- 3rd column -->
	  <div class=" col-md-3 col-sm-2 justify-content-end order-sm-3 mb-2 mt-1 bg-light p-2" >
	  
		<div class="tab-content" >
	
			<div class="card py-2 px-2 border">
				<center>
			  <div class="card-header bg-secondary text-white border rounded" style="width:87%;">
				<h5><?php echo $_SESSION["uname"]; ?></h5>
			  </div>
				</center>
			  <div class="card-block ">
				<center>
				<div class="card-img bg-light p-md-0 p-sm-3" style="width:86%;" >
				<form action="img_upload.php" method="post" enctype="multipart/form-data" >
					<div class="card-img btn border-dark" style="width:100%; height:17em;"> 
						<?php 
	 
							$uid=$_SESSION['id']; 
							$sql="SELECT image FROM images WHERE id= $uid;"; 
							$get_path=mysqli_query($conn, $sql); 
							$get_path=mysqli_fetch_assoc($get_path); 
							$get_path=$get_path['image'];
							$_SESSION["image_name"] = $get_path;
							if($get_path != ""){
								echo "<img name='prof_pic' id='prof_pic' class='card-img rounded-circle btn border rounded p-2 my-2 border h-5' style='width:90%;height:95%;' src='images/".$get_path."' alt='Profile picture'>";
							} else {
								echo "<img name='prof_pic' id='prof_pic' class='card-img rounded-circle btn border rounded p-2 my-2 border h-5' style='width:90%;height:95%;' src='images/profile-blank.png' alt='Profile picture'>";
							}

						?> 
					</div>
				</div>
					</center>
					
					<center>
						<div class="form-group ml-4 mt-2" style="width:85%;">
							<input type="file" name="up_img" class="form-control-file btn-sm" id="exampleFormControlFile1">
						</div>
					</center>
					<center>
						<button type="submit" name="add_pic"  id="" class="btn btn-inline btn-sm btn-secondary mr-2"> Add/Change Picture</button>
					
						<button type="submit" name="remove_pic" id="" class="btn btn-inline btn-sm btn-danger my-2"> Remove picture</button>
					</center>
				</form>
			  </div>
			</div>
		  
		</div>
	  </div>
	  
	<!-- Middle column-->  
	  <div class="col-sm-6 my-2 order-sm-2 border-right">
		<div class="tab-content" id="v-pills-tabContent">
		
		  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
		  <div class="container-fluid">
			
			<div class="blockquote border-bottom">
				<p class="lead mt-3 mb-1 ml-2">Update Account</p>
			</div>

			<ul class="list-group list-group-flush bg-light">
			  <li class="list-group-item bg-light border-0">
				<form class="form-inline" action="http://localhost/ProjectWP/settings_1.php" method="post">
				  <label class="my-1 mr-2" for="sel1"><i class="fa fa-pencil"></i>&nbsp;Change Year:&nbsp;</label>
				  <select class="custom-select my-1 btn-light mr-sm-2" id="sel1" name="sel1">
					<option value="First" id="one">&nbsp;First&nbsp;</option>
					<option value="Second" id="two">&nbsp;Second&nbsp;</option>
					<option value="Third" id="three">&nbsp;Third&nbsp;</option>
					<option value="Fourth" id="four">&nbsp;Fourth&nbsp;</option>
				  </select>
				
			  </li>
			  
			  <li class="list-group-item bg-light border-0">
				
				
				  <label class="my-1 mr-2" for="sel2" ><i class="fa fa-pencil"></i>&nbsp;Change Branch:&nbsp;</label>
				  <select class="custom-select btn-light my-1 mr-sm-2" id="sel2" name="sel2">
								<option id="cse" value="CSE" >Computer Science and Engineering</option>
								<option id="ise" value="ISE">Information Science and Engineering</option>
								<option id="ece" value="ECE">Electronics and Communications Engineering</option>
								<option id="eee" value="EEE">Electrical and Electronics Engineering</option>
								<option id="mle" value="MLE" >Mechanical Engineering</option>
								<option id="iem" value="IEM">Industrial Engineering and Management</option>
								<option id="bte" value="BTE">Bio-Technology</option>
								<option id="che" value="CHE">Chemical Engineering</option>
								<option id="civ" value="CIV">Civil Engineering</option>
								<option id="eie" value="EIE">Electronis and Instrumentation Engineering</option>
								<option id="tce" value="TCE">Telecommunication and Engineering</option>
								<option id="mde" value="MDE">Medical Electronics</option>
					</select>
				</li>
			  
			  <li class="list-group-item bg-light border-0">
					<label class="my-1 mr-2" ><i class="fa fa-map-marker"></i>&nbsp;Add / Change Location:&nbsp;</label>
					<input type="text" class="form-control mr-md-4" placeholder="Enter your city" id="changeloc" name="changeloc" value="<?php echo $_SESSION['location'] ?>" />
			  </li>
			  
			  <li class="list-group-item bg-light border-0">
				  <label class="my-1 mr-2" ><i class="fa fa-pencil-square-o"></i>&nbsp;Select Your Interests:&nbsp;</label><br/>

					<div class="row bg-light mb-2" >
						<div class="col-sm-6 col-md-3">
							<select class="custom-select my-1 btn-light " id="interest1" name="interest1">
								<option value="" id="none1">Interest 1..&nbsp;</option>
								<option value="First" id="int11">&nbsp;First&nbsp;</option>
								<option value="Second" id="int12">&nbsp;Second&nbsp;</option>
								<option value="Third" id="int13">&nbsp;Third&nbsp;</option>
								<option value="Fourth" id="int14">&nbsp;Fourth&nbsp;</option>
							</select>
						</div>
							
						<div class="col-sm-6 col-md-3">
							<select class="custom-select my-1 btn-light " id="interest2" name="interest2">
								<option value="" id="none2">Interest 2..&nbsp;</option>
								<option value="First" id="int21">&nbsp;First&nbsp;</option>
								<option value="Second" id="int22">&nbsp;Second&nbsp;</option>
								<option value="Third" id="int23">&nbsp;Third&nbsp;</option>
								<option value="Fourth" id="int24">&nbsp;Fourth&nbsp;</option>
							</select>
						</div>

						<div class="col-sm-6 col-md-3">
							<select class="custom-select my-1 btn-light " id="interest3" name="interest3">
								<option value="" id="none3">Interest 3..&nbsp;</option>
								<option value="First" id="int31">&nbsp;First&nbsp;</option>
								<option value="Second" id="int32">&nbsp;Second&nbsp;</option>
								<option value="Third" id="int33">&nbsp;Third&nbsp;</option>
								<option value="Fourth" id="int34">&nbsp;Fourth&nbsp;</option>
							</select>
						</div>

						<div class="col-sm-6 col-md-3">
							<select class="custom-select my-1 btn-light " id="interest4" name="interest4">
								<option value="" id="none4">Interest 4..&nbsp;</option>
								<option value="First" id="int41">&nbsp;First&nbsp;</option>
								<option value="Second" id="int42">&nbsp;Second&nbsp;</option>
								<option value="Third" id="int43">&nbsp;Third&nbsp;</option>
								<option value="Fourth" id="int44">&nbsp;Fourth&nbsp;</option>
							</select>
						</div>
					</div>

			  </li>
			  
			  <li class="list-group-item bg-light border-0 mb-4 mt-3">
				<button type="submit" class="btn  btn-success mr-2"><i class="fa fa-check"></i> Save changes
				</button>
				<button type="reset" class="btn  btn-secondary "> Cancel
				</button>
              </li>
				</form>

<?php

##############$--------------------------------------------------------------------###################
	echo "<script type='text/javascript'>";
	switch($_SESSION["branch"])
	{
		case "CSE":
			echo "var a=document.getElementById('cse'); a.setAttribute('selected','selected');";
			break;
		case "ISE":
			echo "var a=document.getElementById('ise'); a.setAttribute('selected','selected');";
			break;
		case "ECE":
			echo "var a=document.getElementById('ece');	a.setAttribute('selected','selected');";
			break;
		case "CIV":
			echo "var a=document.getElementById('civ'); a.setAttribute('selected','selected');";
			break;
		case "MLE":
			echo "var a=document.getElementById('mle'); a.setAttribute('selected','selected');";
			break;
		case "MDE":
			echo "var a=document.getElementById('mde'); a.setAttribute('selected','selected');";
			break;
		case "IEM":
			echo "var a=document.getElementById('iem'); a.setAttribute('selected','selected');";
			break;
		case "TCE":
			echo "var a=document.getElementById('tce'); a.setAttribute('selected','selected');";
			break;
		case "EEE":
			echo "var a=document.getElementById('eee'); a.setAttribute('selected','selected');";
			break;
		case "BTE":
			echo "var a=document.getElementById('bte'); a.setAttribute('selected','selected');";
			break;
		case "CHE":
			echo "var a=document.getElementById('che'); a.setAttribute('selected','selected');";
			break;
		case "EIE":
			echo "var a=document.getElementById('eie'); a.setAttribute('selected','selected');";
			break;
	}
	echo "</script>";

#######---------------------------------------------------------------------------------------
	echo "<script type='text/javascript'>";
	switch ($_SESSION["year"]) {
		case "First":
			echo "var a=document.getElementById('one');	a.setAttribute('selected','selected');"; break;
		case "Second":
			echo "var a=document.getElementById('two');	a.setAttribute('selected','selected');"; break;
		case "Third":
			echo "var a=document.getElementById('three');	a.setAttribute('selected','selected');"; break;
		case "Fourth":
			echo "var a=document.getElementById('four'); a.setAttribute('selected','selected');"; break;
	}
	echo "</script>";

#########-------------------------------------------------------------------------------------------
	echo "<script type='text/javascript'>";
	switch ($_SESSION["interest1"]) {
		case "First":
			echo "var a=document.getElementById('int11'); a.setAttribute('selected','selected');"; break;
		case "Second":
			echo "var a=document.getElementById('int12');	a.setAttribute('selected','selected');"; break;
		case "Third":
			echo "var a=document.getElementById('int13');	a.setAttribute('selected','selected');"; break;
		case "Fourth":
			echo "var a=document.getElementById('int14');	a.setAttribute('selected','selected');"; break;

	}
	echo	"</script>";

###-------------------------------------------------------------------------------------------------
	echo "<script type='text/javascript'>";
	switch ($_SESSION["interest2"]) {
		case "First":
			echo "var a=document.getElementById('int21');	a.setAttribute('selected','selected');"; break;
		case "Second":
			echo "var a=document.getElementById('int22');	a.setAttribute('selected','selected');"; break;
		case "Third":
			echo "var a=document.getElementById('int23');	a.setAttribute('selected','selected');"; break;
		case "Fourth":
			echo "var a=document.getElementById('int24');	a.setAttribute('selected','selected');"; break;

	}
	echo	"</script>";

##-----------------------------------------------------------------------------------------------------
	echo "<script type='text/javascript'>";
	switch ($_SESSION["interest3"]) {
		case "First":
			echo "var a=document.getElementById('int31');	a.setAttribute('selected','selected');"; break;
		case "Second":
			echo "var a=document.getElementById('int32');	a.setAttribute('selected','selected');"; break;
		case "Third":
			echo "var a=document.getElementById('int33');	a.setAttribute('selected','selected');"; break;
		case "Fourth":
			echo "var a=document.getElementById('int34');	a.setAttribute('selected','selected');"; break;

	}
	echo	"</script>";

##----------------------------------------------------------------------------------------------------
	echo "<script type='text/javascript'>";
	switch ($_SESSION["interest4"]) {
		case "First":
			echo "var a=document.getElementById('int41');	a.setAttribute('selected','selected');"; break;
		case "Second":
			echo "var a=document.getElementById('int42'); a.setAttribute('selected','selected');"; break;
		case "Third":
			echo "var a=document.getElementById('int43'); a.setAttribute('selected','selected');"; break;
		case "Fourth":
			echo "var a=document.getElementById('int44');	a.setAttribute('selected','selected');"; break;

	}
	echo	"</script>\n";
##########-------------------------------------------------------------------------#########################

?>
			  
			  <div class="blockquote border-bottom mt-5 mb-5">
				<p class="lead mt-3 mb-1 ml-2">Delete / Deactivate Account</p>
				</div>
			  <li class="list-group-item bg-light border-0 pt-2">
				<form class="form-inline" onsubmit="del_account();" action="del_account.php" method="post">
				<div class="dropdown ">
					<button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<i class="fa fa-trash-o"></i>&nbsp;Delete Account
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<button class="btn btn-outline-danger btn-sm p-2 my-2 ml-2" type="submit" name="del_account"><i class="fa fa-trash-o"></i>&nbsp;Delete Permanently</button>
						<p class="p-2 text-danger"><u><span class="text-warning">Warning!: </span></u>&nbsp;You cannot have access to this account once you permanently delete it !!!</p>
						
					</div>
				</div>
				</form>
			  </li>
			</ul>     
			
			</div>
		  </div>
		
		
		  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
		  
			<div class="blockquote border-bottom">
				<p class="lead mt-3 mb-1 ml-2">Contents For You</p>
			</div>
			<ul class="list-group list-group-flush bg-light">
				<h6 class="border-bottom ml-3">Get Notifications/Emails for</h6>
			  <form action="settings_2.php" class="form-check" method="post" >
			  
			  <li class="list-group-item bg-light my-1 border-0">
				<div class="form-check">
				  <input class="form-check-input" name="chk_box1" type="checkbox" value="true" id="defaultCheck1" />
				  <label class="form-check-label" for="defaultCheck1">
					Questions you asked / followed
				  </label>
				</div>
			  </li>

			  <li class="list-group-item bg-light my-1 border-0">
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="true" name="chk_box3" id="defaultCheck3" />
				  <label class="form-check-label" for="defaultCheck3">
					Upvotes to your answers
				  </label>
				</div>
			  </li>
			  <li class="list-group-item bg-light my-1 border-0">
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" name="chk_box4" value="true" id="defaultCheck4" />
				  <label class="form-check-label" for="defaultCheck4">
					Comments on your Answers
				  </label>
				</div>
			  </li>
			  <li class="list-group-item bg-light my-1 border-0">
				<button type="submit" name="" class="btn  btn-outline-success mr-2"><i class="fa fa-check"></i> Save changes
				</button>
				<button type="reset" class="btn  btn-outline-secondary"> Cancel
				</button>
			  </li>
			  </form>
			</ul>

<?php
	$user = $_SESSION["id"];
	$qu = "SELECT ques_notif FROM login WHERE id=$user;";
	$checked1 = mysqli_query($conn, $qu);
	$checked1 = mysqli_fetch_assoc($checked1);

	$qu2 = "SELECT upvotes_notif, comments_notif FROM login WHERE id=$user ;";
	$get = mysqli_query($conn, $qu2);
	$get = mysqli_fetch_assoc($get);

	echo "<script type='text/javascript'>";
	if($checked1["ques_notif"] == 'true'){
		echo "var c1=document.getElementById('defaultCheck1'); c1.setAttribute('checked','checked');";
	}
	if($get["upvotes_notif"] == 'true'){
		echo "var c2=document.getElementById('defaultCheck3'); c2.setAttribute('checked','checked');";
	}
	if($get["comments_notif"] == 'true'){
		echo "var c3=document.getElementById('defaultCheck4'); c3.setAttribute('checked','checked');";
	}
	echo "</script>";

?>


	<!-- ----------------------------- -->
		  </div>
		  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"> 
			
			<div class="blockquote border-bottom">
				<p class="lead mt-3 mb-1 ml-2">Update Password</p>
			</div>
			<ul class="list-group list-group-flush bg-light">
			  <form action="http://localhost/ProjectWP/settings_3.php" method="post" class="form-inline">
			  <li class="list-group-item bg-light my-1 border-0">
				<div class="form-group">
					<label for="curPass">Current Password:</label>
					<input type="password" id="curPass" name="curPass" class="form-control mx-sm-3" placeholder="Enter current password" aria-describedby="passwordHelpInline">
				  </div>
			  </li>
			  
			  <li class="list-group-item bg-light my-1 border-0">
				<div class="form-group">
					<label for="newPass">New Password:&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="password" id="newPass" name="newPass" class="form-control mx-sm-3" placeholder="Enter new password" aria-describedby="passwordHelpInline">
					<small id="passwordHelpInline" class="d-block text-muted">
					  Must be 8-20 characters long.
					</small>
				  </div>
			  </li>
			  
			  <li class="list-group-item bg-light my-1 border-0">
				<div class="form-group">
					<label for="cnfPass">Confirm Password:</label>
					<input type="password" id="cnfPass" name="cnfPass" class="form-control mx-sm-3" placeholder="Confirm the password"aria-describedby="passwordHelpInline">
					<small id="passwordHelpInline" class="d-block text-muted">
					  Must match the new password.
					</small>
				  </div>
			  </li>
			  
			  <li class="list-group-item bg-light my-1 border-0">
				<button type="submit" class="btn  btn-success mr-2 border"><i class="fa fa-question" onclick="<script type='text/javascript'> var x=document.getElementById('v-pills-settings-tab'); a.setAttribute('areaselcted' , 'true'); </script>" ></i> Change Password
				</button>
				<button type="reset" class="btn  btn-secondary"> Cancel
				</button>
			  </li>
			  </form>
			</ul>
		  </div>
		</div>
		
	  </div>
		
	
	  
		
	</div>	
	
	<!-- End of 1st row-->
	
	<!-- 2nd row-->
	
	
	 <!-- Footer ---->
	 
	<div class="container-fluid bg-secondary mx-0">
	<footer class="container-fluid bg-secondary p-2 mt-5">
		<p class=" text-white lead"style="text-align:center;">Discussion Forum BMSCE</p>
	</footer>
	</div>

	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>