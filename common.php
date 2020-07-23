<?php
    $server="localhost";
    $username="root";
    $password="";
    $db="bdf";
    $conn = mysqli_connect($server,$username,$password,$db);
    if(!$conn)
        echo "<h2>Coudn't connect to the server</h2>";
        
?>