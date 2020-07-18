<?php
	include "common.php";
    session_start();
	require "check_session.php";

	if(isset($_GET['upvote']))
	{
		$flag=1;
		if(isset($_GET['id'])){
			$temp1=$_GET['upvote']+1;
			$tempid=$_GET['id'];
			$sql="UPDATE answers SET upvotes='$temp1' WHERE id3='$tempid' ";
			mysqli_query($conn,$sql);
			unset($_GET['upvote']);
			unset($_GET['id']);
		}
	}
	if(isset($_GET['reported']))
	{
		$tempid=$_GET['reported'];
		$sql="UPDATE answers SET reported1='1' WHERE id3='$tempid' ";
		if(mysqli_query($conn,$sql))
			echo "<script type='text/javascript'> alert ('The answer was reported succesfully '); </script>";
	}
	if(isset($_GET['reportedq']))
	{
		$tempid=$_GET['reportedq'];
		$sql="UPDATE questions SET reported='1' WHERE id2='$tempid' ";
		if(mysqli_query($conn,$sql))
			echo "<script type='text/javascript'> alert ('The question was reported succesfully '); </script>";
	}
	if(isset($_POST['postthecomment']))
	{
		$uname=$_SESSION['uname'];
		$id3=$_POST['answerid'];
		//$com=array();
		$com=$_POST['com'.$id3];
		
		$query ="INSERT INTO comments(id3,name,comment1) VALUES('$id3', '$uname' , '$com') ";
		mysqli_query($conn,$query);
			//echo "<script> alert('hi') </script>";
		//echo "<script> alert('succesfully'); </script>";
		
	}
	if(count($_POST)>0)
		foreach($_POST as $k=>$v)
			unset($_POST[$k]);
	if(count($_GET)>0)
		foreach($_GET as $k=>$v)
			unset($_GET[$k]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile-<?php echo $_SESSION["uname"]; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="BMS_College_of_Engineering.png"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="/path/to/jquery.min.js"></script>
<script src="/path/to/bootstrap.min.js"></script>
<script src="/path/to/bootstrap-hover-dropdown.min.js"></script>
  <style>
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
  </style>
</head>
<body>
	<!--navigation bar-->
<nav class="navbar nav navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header navbar-item mr-3">
		
      <a class="navbar-brand navbar-item p-2" href="#" style="padding:2;"><img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" width="30" height="30" class="navbar-left" alt="">&nbsp;Discussion Forum</a>
	  
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      
	</div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav"> 
        <li class="navbar-item"><a href="http://localhost/ProjectWP/home_page.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
        <li class="navbar-item active">
			<a href="http://localhost/ProjectWP/profile_page.php" class="nav-link"><span class="glyphicon glyphicon-user"></span> 
			<?php echo $_SESSION["uname"]." "; 
				$img = $_SESSION["image_name"];
				if($img!=""){
					echo "<img src='images/".$img."' class='img-circle' width='25' height='25' alt=''>";
				}
				else{
					echo "<img src='images/profile-blank.png' class='img-circle' width='20' height='20' alt=''>";
				}
			?>
			</a>
		</li> 
	  </ul>
     <ul class="nav navbar-nav navbar-right">
	  	<li class="navbar-item">
		<a href="http://localhost/ProjectWP/settings_page.php" style="margin-right:10px;">
		<span class="glyphicon glyphicon-wrench"></span>&nbsp;Account Settings
		</a></li>
		<li class="navbar-item">
		<a href="http://localhost/ProjectWP/Login/logout.php" style="margin-right:15px;">
		<span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout
		</a></li>
    <ul class="dropdown-menu">
        <li class="active"><a tabindex="-1" href="http://localhost/ProjectWP/profile_page.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li class="divider"></li>
        <li><a tabindex="-1" href="http://localhost/ProjectWP/settings_page.php"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
		<li class="divider"></li>
		<li><a href="Login/logout.php" name="logout" tabindex="-1" class="" ><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
    </ul>
	</ul>
      
    </div>
  </div>
</nav>

<!--End of navigaiton bar-->

<div class="container text-center" >    
	<!--Beginning of photo and user info at the top-->
	<div class="row" style="margin-top:60px;">
		<div class="col-sm-12 well">
			<p style="font-style:italic;font-size:25px;font-family:'letter press';"><?php echo $_SESSION["uname"]; ?>
			</p>
			<?php
				$uimage = $_SESSION["image_name"];
				if($uimage != ""){
					echo "<img src='images/".$uimage."' class='img-circle' height='85' width='85' alt='Avatar'>";
				}
				else{
					echo "<img src='images/profile-blank.png' class='img-circle' height='85' width='85' alt='Avatar'>";
				}
			?>
			<hr/>
			<?php 
				$br=$_SESSION["branch"];
				$yr=$_SESSION["year"];
				$yr=$_SESSION["year"];
				switch($br){
					case "CSE": $br="Computer Sceience"; break;
					case "ISE": $br="Information Sceience"; break;
					case "ECE": $br="Electronics & Communications"; break;
					case "MLE": $br="Mechanical Engineering"; break;
					case "EEE": $br="Electrical & Electronics"; break;
					case "IEM": $br="Industrial Engineering"; break;
					case "BTE": $br="Bio Technology"; break;
					case "CHE": $br="Chemical Engineering"; break;
					case "CIV": $br="Civil Engineering"; break;
					case "EIE": $br="Electronics & Instrumentation"; break;
					case "TCE": $br="Tele Communications"; break;
					case "MDE": $br="Medical Electronics"; break;
				}
				switch($yr){
					case "First":$yr="1<sup>st</sup>"; break;
					case "Second":$yr="2<sup>nd</sup>"; break;
					case "Third":$yr="3<sup>rd</sup>"; break;
					case "Fourth":$yr="4<sup>th</sup>"; break;
				} 	 
			?>
			<h4 align ="center"><span class=" glyphicon glyphicon-pencil"></span>&nbsp;<?php echo $br.", ".$yr." year"; ?></h4>
			<h4 align ="center"><span class=" glyphicon glyphicon-home"></span> Bangalore</h4>
			&nbsp;&nbsp;&nbsp; <a href="#"><span class="glyphicon glyphicon-edit">Edit</a>
		</div>
	</div>
	<!-- end of user photo and location-->
	<!--beginning of pills and its contents-->
	<div class="row">
		<div class="col-sm-3 well">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#interest" data-toggle="pill">Interests</a></li>
				<li  class="active"><a href="#question" data-toggle="pill">Questions</a></li>
				<li><a href="#answer" data-toggle="pill">Answers</a></li>
				<li><a href="#notifi" data-toggle="pill">Notifications</a></li>
			</ul>
		</div>
		<!--start of the contents of the pills-->
		<div class="col-sm-9 well">
			<div class="tab-content">
				<!--contenets of interest pill-->
				<?php
					$uname=$_SESSION["uname"];
					$sql="SELECT interest1,interest2,interest3,interest4 FROM user_info WHERE name = '$uname' ";
					$result = mysqli_query($conn,$sql);
					$row=mysqli_fetch_assoc($result);
					echo "<div id='interest' class='tab-pane fade in '>
							<ul class='list-group'> 
								<li class='list-group-item'>".$row['interest1']."</li>
								<li class='list-group-item'>".$row['interest2']."</li>
								<li class='list-group-item'>".$row['interest3']."</li>
								<li class='list-group-item'>".$row['interest4']."</li>
							</ul>
						  </div>";
				?>
				<!--end of content interest pill-->
				<!--contenets of questions pill-->
				<div id="question" class="tab-pane fade in active">
					<!--first question-->
					<?php
						$uname=$_SESSION["uname"];
						$sql="SELECT question,id2 FROM questions where name = '$uname' ";
						$result=mysqli_query($conn,$sql);
						//while loop for the questions
						while($row=mysqli_fetch_assoc($result))
						{
						$id="#hi".$row["id2"];
						$id1="hi".$row["id2"];
						$temp=$row["id2"];
						$sql1="SELECT answer,name,upvotes,id3 FROM answers WHERE id2='$temp' ";
						$result1=mysqli_query($conn,$sql1);
						$count=mysqli_num_rows($result1);
						echo "	<div class='row'>
									<div class='col-sm-12'>
										<div class='well'>
											<a href='profile_page.php?reportedq=$temp' style='float:right;color:red;'>Report this question</a>
											<br/>
											<p style='font-weight:bold;font-size:150%'>".$row["question"]."</p>
											<p align='left'>".$count." answers found</p>
											<br/>
											<button data-toggle='collapse' data-target='$id' style='float:right;'>Check the answers</button>
											<div id='$id1' class='collapse'>
												<table id='id11' style='padding:100px;'>";
												//while loop for the answers
												while($row1=mysqli_fetch_assoc($result1))
												{
													$i=1;
													$answered_person=$row1['name'];
													$sql2="SELECT id FROM user_info WHERE name = '$answered_person' ";
													$user_id=mysqli_query($conn,$sql2);
													$user_id=mysqli_fetch_assoc($user_id);
													$user_id=$user_id['id'];
													$image="SELECT image FROM images WHERE id='$user_id' ";
													$image=mysqli_query($conn,$image);
													$image=mysqli_fetch_assoc($image);
													$image=$image['image'];
													$upvotes=$row1['upvotes'];
													$id3=$row1['id3'];
													//$_SESSION['tempanswer'][$i]=$id3;
													$com_id="#hello".$id3;
													$com_id1="hello".$id3;
													echo "<tr><th rowspan='4'>
													<img src='images/".$image."' class='img-circle' height='60' width='60' alt='Avatar'><br/><a href='#'>".$row1['name']."</a><br/><br/><br/><br/></th>
													<td style='align:center;'>".$row1['answer']."</td>
													</tr>
													<tr>
													<td =style='align:center;'>
													".$upvotes." upvotes <a href='profile_page.php?upvote=$upvotes&id=$id3' id='upvote".$upvotes."'  style='float:center;'><span class='glyphicon glyphicon-thumbs-up'></span>Upvote</a>
													&nbsp;&nbsp;&nbsp;&nbsp;
													<a href='profile_page.php?reported=$id3' style='color:red;'> Report the Answer</a>
													<br/><br/>
													</td>
													</tr>
													<script type='text/javascript'>";
													if ($flag == 1) {
														echo "var x=document.getElementById('upvote".$upvotes."'); x.setAttribute('href','#');";
													}
													echo "</script>
													<tr>
													<td>
													<form action='profile_page.php' method='post'>
													<input type = 'hidden' name = 'answerid' value = '".$id3."' />
													<input type = 'text' name= 'com$id3' placeholder='add a comment' />
													<input type = 'submit' value = 'Post' name='postthecomment'/>
													</form>
													<br/>
													</td>
													</tr>
													<tr>
													<td style='align:center;'>
													<!--start of comments-->
													<button data-toggle='collapse' data-target='$com_id'>comments</button>
													<div id='$com_id1' class='collapse'>
													<table cellpadding='10'>";
													$sql="SELECT name,comment1 FROM comments WHERE id3='$id3' ";
													$result2=mysqli_query($conn,$sql);
													//while loop for the comments
													while($row2=mysqli_fetch_assoc($result2))
													{
														$com_name=$row2['name'];
														$sql="SELECT id FROM user_info WHERE name='$com_name' ";
														$result3=mysqli_query($conn,$sql);
														$result3=mysqli_fetch_assoc($result3);
														$result3=$result3['id'];
														$sql="SELECT image FROM images WHERE id='$result3' ";
														$result4=mysqli_query($conn,$sql);
														$result4=mysqli_fetch_assoc($result4);
														$com_image=$result4['image'];
														echo "<tr>
																<th>
																<img src='images/".$com_image."' class='img-circle' height='60' width='60' alt='Avatar'><br/><a href='#'>".$com_name."</a>
																<br/><br/>
																</th>
																<td style='align:center;'>".
																$row2['comment1']."
																</td>
															  </tr>";
													}
													echo "</table></div><br/><br/><hr/></td></tr>";
													$i++;
												}
												echo "</table>	
											</div>
										</div>
									</div>
								</div>";		
						}
					?>
					<!--end of first question-->
				</div>
				<!--end of contents of question pill-->
				<!--start of contents of answers pill-->
				<div class="tab-pane fade in" id="answer">
					<!--first question answered by the user-->
					<?php
						$query1="SELECT * FROM answers WHERE name = '$uname' ";
						$sql="SELECT id FROM user_info WHERE name = '$uname' ";
						$userid=mysqli_query($conn,$sql);
						$userid=mysqli_fetch_assoc($userid);
						$userid=$userid['id'];
						$sql="SELECT image FROM images WHERE id = '$userid' ";
						$user_image= mysqli_query($conn,$sql);
						$user_image= mysqli_fetch_assoc($user_image);
						$user_image=$user_image['image'];
						$result1=mysqli_query($conn,$query1);
						while($row1=mysqli_fetch_assoc($result1))
						{
							$id3=$row1['id3'];
							$com_id="#hello".$id3;
							$com_id1="hello".$id3;
							$upvotes=$row1['upvotes'];
							$questionid=$row1['id2'];
							$temp_id="#hi".$row1["id2"];
							$temp_id1="hi".$row1["id2"];
							$temp=$row["id2"];
							$query2="SELECT * FROM questions WHERE id2='$questionid' ";
							$result2=mysqli_query($conn,$query2);
							$row2=mysqli_fetch_assoc($result2);
							$questionname=$row2['name'];
							$query3="SELECT id FROM user_info WHERE name='$questionname' ";
							$result3=mysqli_query($conn,$query3);
							$row3=mysqli_fetch_assoc($result3);
							$row3=$row3['id'];
							$query4="SELECT image FROM images WHERE id='$row3' ";
							$result4=mysqli_query($conn,$query4);
							$row4=mysqli_fetch_assoc($result4);
							$image=$row4['image'];
							echo "<div class='row'>
									<div class='col-sm-12'>
										<div class='well'>
											<a href='profile_page.php?reportedq=$temp' style='float:right;color:red;'>Report this question</a>
											<br/>
											<img src='images/".$image."' alt='avatar' class='img-circle' height='60' width='60'>
											&nbsp;&nbsp;&nbsp;&nbsp;
											<p style='font-weight:bold;font-size:150%'>".$row2["question"]."</p></br>
											<button data-toggle='collapse' data-target='$temp_id' style='float:right;'>Check the answers</button>
											<div id='$temp_id1' class='collapse'>
												<table id='id11' style='padding:100px;'>
												<tr>
												<th rowspan='4' align = 'center' >
												<img src='images/".$user_image."' alt='avatar' class='img-circle' height='60' width='60'><br/>".
												$uname."<br/><br/><br/><br/>
												</th>
												<td style='align:center;'>".$row1['answer']."<br/><br/></td>
												</tr>
												<tr>
												<td =style='align:center;'>
													".$upvotes." upvotes <a href='profile_page.php?upvote=$upvotes&id=$id3' style='float:center;'><span class='glyphicon glyphicon-thumbs-up'></span>Upvote</a>
													&nbsp;&nbsp;&nbsp;&nbsp;
													<a href='profile_page.php?reported=$id3' style='color:red;'> Report the Answer</a>
													<br/><br/>
												</td>
												</tr>
												<tr>
												<td>
												<form action='profile_page.php' method='post'>
													<input type = 'hidden' name = 'answerid' value = '".$id3."' />
													<input type = 'text' name= 'com$id3' placeholder='add a comment' />
													<input type = 'submit' value = 'Post' name='postthecomment'/>
												</form>
												<br/>
												</td>
												</tr>
												<tr>
												<td style='align:center;'>
													<!--start of comments-->
													<button data-toggle='collapse' data-target='$com_id'>comments</button>
													<div id='$com_id1' class='collapse'>
													<table cellpadding='10'>";
													$query5="SELECT name,comment1 FROM comments WHERE id3='$id3' ";
													$result5=mysqli_query($conn,$query5);
													//while loop for the comments
													while($row5=mysqli_fetch_assoc($result5))
													{
														$com_name=$row5['name'];
														$sql="SELECT id FROM user_info WHERE name='$com_name' ";
														$result6=mysqli_query($conn,$sql);
														$result6=mysqli_fetch_assoc($result6);
														$result6=$result6['id'];
														$sql="SELECT image FROM images WHERE id='$result6' ";
														$result7=mysqli_query($conn,$sql);
														$result7=mysqli_fetch_assoc($result7);
														$com_image=$result7['image'];
														echo "<tr>
																<th>
																<img src='images/".$com_image."' class='img-circle' height='60' width='60' alt='Avatar'><br/><a href='#'>".$com_name."</a>
																<br/><br/>
																</th>
																<td style='align:center;'>".
																$row5['comment1']."
																</td>
															  </tr>";
													}
													echo "</table></div><br/><br/><hr/>
												</td>
												</tr>
												</table>
											</div>
										</div>
									</div>
								</div>";
						}
					?>
					<!--end of first question answered by the user-->
				</div>
				<!--end of contents of answer pill-->
				</div>
			</div>
		</div>
	</div>
		
<footer class="container-fluid text-center">
  <p style="font-size:22 px;">BMSCE Discussion Forum</p>
</footer>
</body>
</html>