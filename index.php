<?php
    session_start();
	$db="bdf";
	$server="localhost";
	$username="root";
	$password="root";
	$conn=mysqli_connect($server,$username,$password,$db);
	if(!$conn)
		echo "Failed to establish connection ";
	require "check_session.php";
	if(isset($_GET['upvote']) and isset($_GET['id']))
	{
		$temp1=$_GET['upvote']+1;
		$tempid=$_GET['id'];
		$sql="UPDATE answers SET upvotes='$temp1' WHERE id3='$tempid' ";
		mysqli_query($conn,$sql);
		unset($_GET['upvote']);
		unset($_GET['id']);
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
		if(strlen(trim($com))){
		$query ="INSERT INTO comments(id3,name,comment1) VALUES('$id3', '$uname' , '$com') ";
		mysqli_query($conn,$query);
		}
			//echo "<script> alert('hi') </script>";
		//echo "<script> alert('succesfully'); </script>";
		
	}
	if(isset($_POST['posttheanswer']))
	{
		$uname=$_SESSION['uname'];
		$id3=$_POST['questionid'];
		//$com=array();
		$com=$_POST['answer'.$id3];
		if(strlen(trim($com))){
		$query ="INSERT INTO answers(id2,name,answer) VALUES('$id3', '$uname' , '$com') ";
		mysqli_query($conn,$query);
		}
			//echo "<script> alert('hi') </script>";
		//echo "<script> alert('succesfully'); </script>";
		
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home page-<?php echo $_SESSION["uname"]; ?> </title>
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
<!-- Navigation Bar-->

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
      <ul class="nav navbar-nav "> 
        <li class="navbar-item active"><a href="http://localhost/ProjectWP/index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Home</a></li>
        <li class="navbar-item">
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
  <!-- End of Navigation Bar-->
  <!-- Start of profile display--> 
<div class="container text-center" style="margin-top:60px;">    
  <div class="row">
    <div class="col-sm-3 well">
      <div class="well">
        <p style="font-style:italic;font-size:25px;font-family:'letter press';"><?php echo $_SESSION["uname"]; ?>
        </p>
		<?php 
        echo"<img src='images/".$_SESSION['image_name']."' class='img-circle' height='85' width='85' alt='Avatar'>
           <hr/>";
        
          $br=$_SESSION["branch"];
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
        <h5 align ="left"><span class=" glyphicon glyphicon-pencil"></span> <?php echo $br; ?> 
        </h5>
		 <h5 align ="left"><span class=" glyphicon glyphicon-education"></span> <?php echo " ". $yr." "."Year" ?> 
        </h5>
        <div align ="left"><h5><span class=" glyphicon glyphicon-home"></span>
		<?php 
		$b=$_SESSION['uname'];
			   $a="SELECT location FROM user_info WHERE name='$b'";  
               $success=mysqli_query($conn,$a);
               $success=mysqli_fetch_assoc($success);
             foreach($success as $bb)			   
			   echo $bb;
		 ?></h5></div>
       &nbsp;&nbsp;&nbsp; <a href="http://localhost/ProjectWP/settings_page.php"><span class="glyphicon glyphicon-edit">Edit</a>
      </div>
	  <!-- End of Profile display-->
	  <!-- Start  of Interest List-->
      <div class="well">
        <p><a href="http://localhost/ProjectWP/settings_page.php"><span class="glyphicon glyphicon-edit">Interests</span></a></p>
       <?php 
	    $b=$_SESSION['uname'];
		$a="SELECT interest1,interest2,interest3,interest4 FROM user_info WHERE name='$b'";
		$success=mysqli_query($conn,$a);
		$success=mysqli_fetch_assoc($success);
		foreach($success as $c)
		{ 
		echo"<h4>";
		 echo"<span class='label label-success'>";
			echo $c;
		 echo"</span>";
		 echo"<br>";
		 echo"</h4>";
		}
       ?>		
      </div>
	  <!-- End of Interest List-->
	  <!-- Start of Subject Selection-->
      <div class="well">
      <p style="font-size:30;align:center;font-style:italic;">Selection</p>
      <hr/>
	  <form method="post" action="index.php">
       <?php
              $sql="SELECT * FROM 
	       dependable";
		   $connect1=mysqli_query($conn,$sql);
		   if(!$connect1)
		   {
			   echo"Failed to establish a connection";
		   }
		    echo"<p align='left' style='font-family:'Times New Roman;''>Topic:</p>";
       echo"<select style='width:200px;' name='selection'>";
		  while ($list=mysqli_fetch_assoc($connect1))
	      {  
			  echo"<option value='".$list['Name6']."'>".$list['Name6']."</option>";
		  }		  	  
       echo"</select>";
	   ?>
	   <br/>
	   <br/>
       <input type="submit" value="Search" align="center" name="selection_submit" style="background-color:blue;font-size:36;color:white;"/>
       </form>
	   </div>
        </div>
		<!-- End of subject selection-->
		<!-- Start of Post Your Question-->		
    <div class="col-sm-8">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default text-center">
            <div class="panel-body">
      <button data-toggle="collapse" data-target="#post" style="color:red;background-color:black;font-family:Arial;font-weight:bold;">&nbsp;&nbsp;Post your Question&nbsp;&nbsp;</button>     
      <div id="post" class="collapse">
      <br/>
      <br/>
	  <form method="post" action="home.php">
      <p align="left" style="font-family:'Times New Roman;'">Year:
     <select name="name1" style="width:100px">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      </select>
      </p>
	    <?php
              $sql="SELECT * FROM 
	       dependable";
		   $connect1=mysqli_query($conn,$sql);
		   if(!$connect1)
		   {
			   echo"Failed to establish a connection";
		   }
		    echo"<p align='left' style='font-family:'Times New Roman;''>Topic:";
       echo"<select name='name3' style='width:100px;'>";
		  while ($list=mysqli_fetch_assoc($connect1))
	      {  
			  echo"<option value='".$list['Name6']."'>".$list['Name6']."</option>";
		  }		  	  
       echo"</select>";
	   ?>
       </p>
       <br/>
              <textarea  align="left" name="name4" placeholder="Ask Your Question.(Begin your question with question words like (which,why,whose etc))"rows="4" cols="87"></textarea>
              <br/>
              <br/>
              <input type="submit" value="&nbsp;&nbsp;&nbsp;Post&nbsp;&nbsp;&nbsp;&nbsp;"/>
              </form>
            </div>
          </div>
        </div>
      </div>
	 </div>
  <!-- End  of Post Your Question-->
       <?php
						$uname=$_SESSION["uname"];
						$result1=mysqli_query($conn,"SELECT interest1,interest2,interest3,interest4 FROM user_info WHERE name='$uname' ");
						$result1=mysqli_fetch_assoc($result1);
						$interest1=$result1['interest1'];
						$interest2=$result1['interest2'];
						$interest3=$result1['interest3'];
						$interest4=$result1['interest4'];
						if(isset($_POST['selection_submit'])){
							if($_POST['selection']!='All'){
								$interest=$_POST['selection'];
								$sql2="SELECT * FROM questions where topic2='$interest' ";
							}
							else if($_POST['selection']=='All')
							{$sql2="SELECT * FROM questions ";}
							//unset($_POST['selection']);
						}
						else if($interest1=="" and $interest2=="" and $interest3=="" and $interest4=="")
							{$sql2="SELECT * FROM questions ";}
						else
						{$sql2="SELECT * FROM questions where topic2='$interest1' || topic2='$interest2' || topic2='$interest3' || topic2='$interest4'";}
						$result2=mysqli_query($conn,$sql2);
						//while loop for the questions
						while($row1=mysqli_fetch_assoc($result2))
						{
						$id="#hi".$row1["id2"];
						$id1="hi".$row1["id2"];
						$aid="#ahi".$row1["id2"];
						$aid1="ahi".$row1["id2"];
						$temp=$row1["id2"];
						$questionname=$row1['name'];
						$sql3="SELECT answer,name,upvotes,id3 FROM answers WHERE id2='$temp' ";
						$result3=mysqli_query($conn,$sql3);
						$count=mysqli_num_rows($result3);
						//to retrieve image
						$nname=$row1['name'];
						$sql4="SELECT id FROM user_info WHERE name = '$nname' ";
						$userid=mysqli_query($conn,$sql4);
						$userid=mysqli_fetch_assoc($userid);
						$userid=$userid['id'];
						$sql5="SELECT image FROM images WHERE id = '$userid' ";
						$user_image= mysqli_query($conn,$sql5);
						$user_image= mysqli_fetch_assoc($user_image);
						$user_image=$user_image['image'];
						echo "	<div class='row'>
									<div class='col-sm-12'>
										<div class='well'>
											<a href='index.php?reportedq=$temp' style='float:right;color:red;'>Report this question</a>
											<br/>
											<img src='images/".$user_image."' alt='avatar' class='img-circle' height='60' width='60'><br/>".
											$questionname."
											<p style='font-weight:bold;font-size:150%'>".$row1["question"]."</p>
											<p align='left'>".$count." answers found</p>
											<br/>
											<button data-toggle='collapse' data-target='$aid' style='float:left;'>Answer this question</button>
											<div id='$aid1' class='collapse'>
												<form action='index.php' method='post'>
												<input type = 'hidden' name = 'questionid' value = '".$temp."' />
												<textarea name='answer$temp' rows='5' cols='60'>Enter your answer
												</textarea>
												<input type = 'submit' value = 'Post' name='posttheanswer'/>
												</form>
											</div>
											<button data-toggle='collapse' data-target='$id' style='float:right;'>Check the answers</button>
											<div id='$id1' class='collapse'>
												<table id='id11' style='padding:100px;'>";
												//while loop for the answers
												while($row2=mysqli_fetch_assoc($result3))
												{
													$i=1;
													$answered_person=$row2['name'];
													$sql6="SELECT id FROM user_info WHERE name = '$answered_person' ";
													$user_id=mysqli_query($conn,$sql6);
													$user_id=mysqli_fetch_assoc($user_id);
													$user_id=$user_id['id'];
													$image="SELECT image FROM images WHERE id='$user_id' ";
													$image=mysqli_query($conn,$image);
													$image=mysqli_fetch_assoc($image);
													$image=$image['image'];
													$upvotes=$row2['upvotes'];
													$id3=$row2['id3'];
													//$_SESSION['tempanswer'][$i]=$id3;
													$com_id="#hello".$id3;
													$com_id1="hello".$id3;
													echo "<tr><th rowspan='4'>
													<img src='images/".$image."' class='img-circle' height='60' width='60' alt='Avatar'><br/><a href='#'>".$row2['name']."</a><br/><br/><br/><br/></th>
													<td style='align:center;'>".$row2['answer']."</td>
													</tr>
													<tr>
													<td =style='align:center;'>
													".$upvotes." upvotes <a href='index.php?upvote=$upvotes&id=$id3' style='float:center;'><span class='glyphicon glyphicon-thumbs-up'></span>Upvote</a>
													&nbsp;&nbsp;&nbsp;&nbsp;
													<a href='index.php?reported=$id3' style='color:red;'> Report the Answer</a>
													<br/><br/>
													</td>
													</tr>
													<tr>
													<td>
													<form action='index.php' method='post'>
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
													$sql7="SELECT name,comment1 FROM comments WHERE id3='$id3' ";
													$result4=mysqli_query($conn,$sql7);
													//while loop for the comments
													while($row3=mysqli_fetch_assoc($result4))
													{
														$com_name=$row3['name'];
														$sql8="SELECT id FROM user_info WHERE name='$com_name' ";
														$result5=mysqli_query($conn,$sql8);
														$result5=mysqli_fetch_assoc($result5);
														$result5=$result5['id'];
														$sql9="SELECT image FROM images WHERE id='$result5' ";
														$result6=mysqli_query($conn,$sql9);
														$result6=mysqli_fetch_assoc($result6);
														$com_image=$result6['image'];
														echo "<tr>
																<th>
																<img src='images/".$com_image."' class='img-circle' height='60' width='60' alt='Avatar'><br/><a href='#'>".$com_name."</a>
																<br/><br/>
																</th>
																<td style='align:center;'>".
																$row3['comment1']."
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
	<!--questions -->  
    
   
  </div> 
</div>
<!-- Footer-->
<footer class="container container-fluid text-center">
  <p style="font-size:22 px;">BMSCE Discussion Forum</p>
</footer>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<?php
	if(count($_POST)>0)
		foreach($_POST as $k=>$v)
			unset($_POST[$k]);
	if(count($_GET)>0)
		foreach($_GET as $k=>$v)
			unset($_GET[$k]);
?>
</body>
</html>
