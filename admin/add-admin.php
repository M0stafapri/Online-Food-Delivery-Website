<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>

        <?php
                    if (!empty($_SESSION['add'])){
                        print $_SESSION['add'];
                        unset($_SESSION['add']);

                    }
                ?>

        <br><br>
        <form action="" method="post">
            <table class="tbl-30">

                <tr>
                     <td><b>Full Name:</b></td>
                     <td>
                         <input required="required" type="text" class="input-lg" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                 

                <tr>
                    <td><b>Username:</b></td>
                    <td>
                        <input required="required"  class="input-lg" type="text" name="username" placeholder="Enter Your Username">
                    </td>
                </tr>

                <tr>
                    <td><b>Password:</b></td>
                    <td>
                        <input required="required"  class="input-lg" type="password" name="password" placeholder="Enter Your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //process the value from form and save it in Database
  

    //check wether the submit button is clicked or not 
        if(isset($_POST['submit'])){
            
            //get the data from form
             $full_name = $_POST['full_name'];
             $username = $_POST['username'];
             $password = md5($_POST['password']); //password encryption with md5

             //sql Quary to save the data into Database
             $sqli = "INSERT INTO tbl_admin set
             full_name = '$full_name',
             username = '$username' ,
             password = '$password'
             ";

            // excuting Quary
             $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));

            //check wether tha data is inserted or not
            if($res==true){
                //data inserted
                // create a session variable to display
                $_SESSION['add-admin'] = "Admin Added Successfuly.";
                //redirect page TO MANAGE ADMIN
                header('location:'.SITEURL.'admin/manage-admin.php');

                
            }
            else{
               // echo "failed to  insert data";
               // create a session variable to display
               $_SESSION['add-admin'] = "Failed to Add Admin.";
               //redirect page TO MANAGE ADMIN
               header('location:'.SITEURL.'admin/add-admin.php');
                
            }
        }
       

?>

