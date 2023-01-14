<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
                <h1>Update Admin</h1>
                <br><br>

                <?php
                    //get the id of the admin
                    $id = $_GET['id'];
                    // create query
                    $sqli = "SELECT *FROM tbl_admin WHERE id=$id";
                    //execute
                    $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));
                    //Chect wether the query is executed or not
                if($res==true){
                        // check wether the data available or not 
                        $count = mysqli_num_rows($res);

                        if($count == 1){                        
                        $rows  = mysqli_fetch_assoc($res);
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];                       
                        }
                        else{
                        header('location:'.SITEURL.'admin/manage-admin.php');  
                        }
                }

                ?>

                <form action="" method="post">
                <table class="tbl-30">

                <tr>
                     <td><b>Full Name:</b></td>
                     <td>
                         <input required="required" type="text" class="input-lg" name="full_name" value="<?php echo $full_name ?>" placeholder="Enter Your Name">
                    </td>
                </tr>
                 

                <tr>
                    <td><b>Username:</b></td>
                    <td>
                        <input required="required"  class="input-lg" type="text" name="username" value="<?php echo $username ?>" placeholder="Enter Your Username">
                    </td>
                </tr>



                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         //sql Quary to save the data into Database
         $sqli = "UPDATE tbl_admin set
         full_name = '$full_name',
         username = '$username' 
         WHERE id='$id'
         ";
        // excuting Quary
         $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));
        //check wether tha data is inserted or not
        if($res==true){
            // create a session variable to display
            $_SESSION['update-admin'] = "Admin Updated Successfuly.";
            //redirect page TO MANAGE ADMIN
            header('location:'.SITEURL.'admin/manage-admin.php');


        }
        else{
           // create a session variable to display             
           $_SESSION['add-admin'] = "Failed to Update Admin.";
           //redirect page TO MANAGE ADMIN
           header('location:'.SITEURL.'admin/manage-admin.php');
            
        }
    }
   
?>







<?php include('partials/footer.php'); ?>




