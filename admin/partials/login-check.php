<?php
    //authorization-access control
    //check wether the user is loged in or not 
    if (!isset($_SESSION['username'])) {                       
        //user is not logged in need to redirect
        $_SESSION['no-login-message'] = "<div class='fail'>Please Login to Access Admin Panel.</div>";
        //redirect page TO MANAGE ADMIN
        header('location:'.SITEURL.'admin/login.php');     
        exit;             
    }
?>