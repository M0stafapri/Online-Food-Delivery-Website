<?php
    //include constraints
    include('../config/constraint.php'); 

    // create a session variable to display
    $_SESSION['logout'] = "logged out seccessfully";
    
    //destroy the session
    session_destroy();
 
   
    //redirect to login
    header('location:'.SITEURL.'admin/login.php');


?>