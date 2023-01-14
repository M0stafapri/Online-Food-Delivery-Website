<?php include('../config/constraint.php'); ?>

<html>
    <head>
        <title>login food-order system</title>

        <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="../css/admin.css" type="text/css">

        <script src="resources/js/bootstrap.min.js"></script>
        <script src="resources/js/bootstrap.js"></script>
    </head>
    <body>
          
        <div class="main-content">
            <div class="contents logincont">
                
                <div class="login">
                    <h1>Login :</h1>
                    <br>
                    <?php
                        if (isset($_SESSION['login'])){                         
                            echo ($_SESSION['login']);                         
                            unset($_SESSION['login']);
                        }
                        if (isset($_SESSION['no-login-message'])){                       
                            echo ($_SESSION['no-login-message']);
                            unset($_SESSION['no-login-message']);
                        }
                    ?>
                    <form action="" method="post">
                        <input required="required" name="username" class="input-lg" type="text" placeholder="please enter a username">
                        <input required="required" name="password" class="input-lg" type="password" placeholder="please enter a password" > 
                        <input class="btn-primary btn-lg" type="submit" name="submit" value="Login">
                    </form>
                </div>
            </div>
        </div>

        <?php include('partials/footer.php'); ?>

 <?php
    //check wether the submit button is clicked or not 
    if(isset($_POST['submit'])){
       
       // get data from form
       //$username = $conn,$_POST['username'];
       //$password = md5($_POST['password']);

         $username = mysqli_real_escape_string($conn,$_POST['username']);
         $raw_password = md5($_POST['password']);
         $password = mysqli_real_escape_string($conn,$raw_password);

       //sql Quary to to check wether user name and password exist or not 
         $sqli = "SELECT *FROM tbl_admin WHERE username='$username' AND password='$password' ";

          // excuting Quary
          $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));
          
          //count the rows to check wether user exist
          $count = mysqli_num_rows($res);

            if($count == 1){ 
                //user availableand login success
                $_SESSION['login'] = "logged in successfully.";                
                $_SESSION['username'] = $username;
                //redirect page TO MANAGE ADMIN
                header('location:'.SITEURL.'admin/');         
            }
            else{
                //user not available login failed
                // create a session variable to display
                $_SESSION['login'] = "<div class='fail'>login failed. Username or Password Incorrect.</div>";
                //redirect page TO MANAGE ADMIN
                header('location:'.SITEURL.'admin/login.php');
            }
    }   
?>
