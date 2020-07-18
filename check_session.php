<?php

    if(!(isset($_SESSION["usn"]) || isset($_SESSION["uname"]))){
        header("Refresh:0; url=http://localhost/ProjectWP/Login/login.php");
        exit();
    }

?>