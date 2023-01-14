<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
                <h1>Change Password</h1>
                <br><br>

                <?php
                    if (isset($_GET['id'])){ 
                    $id = $_GET['id'];
                    }             
                ?>
 
                <form action="" method="post">
                <table class="tbl-30">

                    <tr>
                        <td><b>Current Password:</b></td>
                        <td>
                            <input required="required"  class="input-lg" type="password" name="current_password"  placeholder="current password">
                        </td>
                    </tr>
                    

                    <tr>
                    <td><b>New Password:</b></td>
                        <td>
                            <input required="required"  class="input-lg" type="password" name="new_password"  placeholder="new password">
                        </td>
                    </tr>

                    <tr>
                    <td><b>Confirm Password:</b></td>
                        <td>
                            <input required="required"  class="input-lg" type="password" name="confirm_password"  placeholder="confirm password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                             <input type="hidden" name="id" value="<?php echo $id ?>"> 
                             <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>

                </table>
                </form>
    </div>
</div>

<?php
    //check wether the submit button is clicked or not 
    if(isset($_POST['submit'])){
        //get the data from form to update
         $id = $_POST['id'];
         $current_password = md5($_POST['current_password']);
         $new_password = md5($_POST['new_password']);
         $confirm_password = md5($_POST['confirm_password']);
        //check wether the user exist or not
        $sqli = "SELECT * FROM tbl_admin where id=$id AND password='$current_password'";
        // excuting Quary
        $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));
        
        if($res==true){
            // check wether the data available or not 
            $count = mysqli_num_rows($res);

            if($count == 1){      
                //user exist and password can be changed                  
                
                //check wether new password cofirm
                if($new_password==$confirm_password){
                    $sqli2 = "UPDATE tbl_admin set
                    password = '$new_password'
                    WHERE id='$id'
                    ";

                    $res2 = mysqli_query($conn, $sqli2) or die('Query failed: '. mysqli_error($conn));
                    if($res==true){
                        // create a session variable to display
                        $_SESSION['update-password'] = "Password Updated Successfuly.";
                        //redirect page TO MANAGE ADMIN
                        header('location:'.SITEURL.'admin/manage-admin.php');
            
                    }
                    else{
                       // create a session variable to display
                       $_SESSION['update-password'] = "Failed to Update Password.";
                       //redirect page TO MANAGE ADMIN
                       header('location:'.SITEURL.'admin/manage-admin.php');
                        
                    }

                }
                else{ 
                    // create a session variable to display
                    $_SESSION['password-dont-match'] = "Password Do Not Match.";
                    //redirect page TO update-password
                    header('location:'.SITEURL.'admin/manage-admin.php');  
                    ;  
                }
                
                                
            }
            else{
                //user does not exist
                $_SESSION['error'] = "User Not Found.";
                header('location:'.SITEURL.'admin/manage-admin.php');  
            }
        }
    }

?>



<?php include('partials/footer.php'); ?>

