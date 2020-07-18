<?php
    session_start();
        
        if(session_destroy()){
            header("Location: http://localhost/ProjectWP/Login/login.php");
        } else {
            header("Refresh:0; ");
        }

?>