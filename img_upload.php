<?php
    session_start();
    include "common.php"; 

    $uid = $_SESSION["id"];

    if(isset($_POST["add_pic"])){ // name of 'Add/Change Picture' button
        $imageName = $_FILES["up_img"]["name"];    // name of file upload input
        $target = 'images/'.$imageName;
        $imageTmpName = $_FILES["up_img"]["tmp_name"];

        if($imageName != ""){
            
            $sql = "UPDATE images SET image='$imageName' WHERE id=$uid;";
            mysqli_query($conn, $sql);

            if (move_uploaded_file($imageTmpName, $target)) {        
            } 
            else {
                echo "<script type='text/javascript'>alert('There was an error uploading the image!!');</script>";
            }
            header("Refresh:0; url=./settings_page.php");
        }

        else{
            header("Refresh:0; url=./settings_page.php");
            echo "<script type='text/javascript'>alert('Please choose a picture!');</script>";
        }
    }
    
    if (isset($_POST["remove_pic"])){ // name of 'Remove picture' button

        $sql2 = "UPDATE images SET image='profile-blank.png' WHERE id=$uid;";
        mysqli_query($conn, $sql2);

        header("Refresh:0; url=./settings_page.php");

    }

?>