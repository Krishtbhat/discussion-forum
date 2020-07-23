<?php
    session_start();
        
        if(session_destroy()){
            header("Location: ../");
        } else {
            header("Refresh:0; ");
        }

?>