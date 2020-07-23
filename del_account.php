<?php
    session_start();
    require "check_session.php";

    include "common.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo "See you soon ".$_SESSION["uname"]." :)"; ?></title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS 4.1.3-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<!-- Bootstrap icons (fontawsome)-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script language="javascript" type="text/javascript">
        window.history.forward();
		window.onunload = function(){null};
    </script>
</head>
<body class="bg-light">

<?php
    $flag=0;
    if(isset($_POST["del_account"])){

        $uname = $_SESSION["uname"];
        $uid = $_SESSION["id"];


        $que1 = "SELECT id2 FROM questions WHERE name = '$uname';";
        $id2 = mysqli_query($conn, $que1); $id21 = mysqli_fetch_assoc($id2); $id21 = $id21["id2"];

        if($id21){    
            $que2 = "SELECT id3 FROM answers WHERE id2=$id21;";
            $id3 = mysqli_query($conn, $que2);
            $id31 = mysqli_fetch_assoc($id3); $id31 = $id31["id3"]; 
        }
 
        $sql4 = "DELETE FROM comments WHERE name = '$uname' ;";
        $s1 = mysqli_query($conn, $sql4);
        if($id21){ 
            if($id31){
                $sq4 = "DELETE FROM comments WHERE id3 = $id31 ;";
                $s = mysqli_query($conn, $sq4); }
        }

        $sql5 = "DELETE FROM answers WHERE name = '$uname' ;";
        $t = mysqli_query($conn, $sql5);
        if($id21){
            if($id31){
                $sq5 = "DELETE FROM answers WHERE id3 = $id31 OR id2 = $id21 ;";
                $t1 = mysqli_query($conn, $sq5); }
        }

        $sql6= "DELETE FROM questions WHERE name = '$uname' ;";
        $u = mysqli_query($conn, $sql6);

        $sql2 = "DELETE FROM user_info WHERE name = '$uname';";
        if (!(mysqli_query($conn, $sql2))) {
            echo "Coudn't delete 2<br/> ";
            $flag=1;
        }
        $sql3 = "DELETE FROM login WHERE id=$uid;";
        if (!(mysqli_query($conn, $sql3))) {
            echo "Coudn't delete 3<br/> ";
            $flag=1;
        }

        if($flag == 0){
            $sql = "DELETE FROM images WHERE id=$uid;";  
            if (!(mysqli_query($conn, $sql))) {
                echo "Coudn't delete image  ";
                $flag=1;
            }

            echo "<h1 class='mt-4 ml-2'>Your Account was deleted successfully !!  </h1><br/>";
            echo "<a href='./Login/logout.php' class='btn btn-primary ml-4'>Go to Login page</a>";

        } else {
            echo "<h1> Error deleting the records !!! </h1>";
        }
    }

    else{
        header("Refresh:0; url=./settings_page.php");
    }

    session_unset();
    session_abort();

?>

<!-- Footer ---->
	 
    <div class="container-fluid fixed-bottom bg-secondary mx-0">
    <footer class="container-fluid bg-secondary p-2 mt-2">
        <p class=" text-white lead"style="text-align:center;">Discussion Forum BMSCE</p>
    </footer>
    </div>

</body>
</html>