<?php include('partials/menu.php'); ?>



        <!-- Main Content section starts--> 
        <div class="main-content">
            <div class="wrapper">
				<h1>Manage Admin</h1>
                <br>

                
                <?php
                    if (isset($_SESSION['add-admin'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['add-admin']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['add-admin']);

                        

                    }
                    if (isset($_SESSION['delete-admin'])){
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['delete-admin']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['delete-admin']);

                    }
                    if (isset($_SESSION['update-admin'])){
                        ?>
                        <script>
                        swal({
                        title: "<?php echo ($_SESSION['update-admin']); ?>",
                        icon: "success",
                        button: "close",
                        });
                        </script>
   
                   <?php
                   unset($_SESSION['update-admin']);

                    }
            
                    if (isset($_SESSION['update-password'])){
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['update-password']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['update-password']);

                    }

                     
                    if (isset($_SESSION['password-dont-match'])){
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['password-dont-match']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['password-dont-match']);

                    }
              
                    
                    if (isset($_SESSION['error'])){
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['error']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['error']);

                    }

                ?>
                <br>
                <!-- button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                
                <br>
                <br>
                <br>

                <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_admin";
                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    //check if the query is excuted or not
                    if($res==true){
                        //count the nums of the rows
                        $count = mysqli_num_rows($res);
                        $sn = 1; //
                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res)){
                                //using while loop to get all the data from database
                                //and while loop will run as lomg as we have data in the database

                                //get individual data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                //display the data into our table
                                ?>
                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td> <?php echo $full_name ?> </td>
                                    <td><?php echo $username ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>

                                    </td>
                                </tr>
                                <?php

                            }
                        }
                        else{

                        }

                    }
                
                ?>

               

            </table>

				

				<div class="clearfix"></div>

				
            </div>
        </div>
        <!-- Main Content section ends--> 


 <?php include('partials/footer.php'); ?>