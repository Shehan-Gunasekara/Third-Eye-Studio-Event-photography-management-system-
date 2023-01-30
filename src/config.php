<?php
    //The connection object
    $con=new mysqli("localhost","root","","event_photography_management_system_db");
    // Check connection
    if($con->connect_error){
        die("Connection failed: " . $con->connect_error);
    }
?>
