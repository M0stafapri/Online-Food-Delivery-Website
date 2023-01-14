<?php  include('../config/constraint.php'); ?>
<?php  include('login-check.php'); ?>



<html>
   <head> 
        <title>Food Order Website - Home Page</title>

        <link rel="stylesheet" href="../js/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../js/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../css/admin.css" type="text/css">

        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/custom.css">  
        
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/sweetalert.min.js"></script>


   </head>

   <body>
        <!-- Menu section starts--> 
        <div class="menu">
            <div class="wrapper">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>admin/index.php"> Home </a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-admin.php"> Admin </a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-category.php"> Category </a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-food.php"> Food </a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/manage-order.php"> Order </a></li>
                    <li><a href="<?php echo SITEURL; ?>admin/logout.php"> Logout </a></li>

                </ul>
            </div>
        </div>
        <!-- Menu section ends--> 