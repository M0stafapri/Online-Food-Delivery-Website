<?php include('partials/menu.php'); ?>



        <!-- Main Content section starts--> 
        <div class="main-content">
            <div class="wrapper">
				<h1>Manage Category</h1>
                <br>
                <?php
                if (isset($_SESSION['add-category'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['add-category']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['add-category']);
                    }

                    if (isset($_SESSION['delete-category'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['delete-category']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['delete-category']);
                    }
               

                    if (isset($_SESSION['failed-delete-category'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['failed-delete-category']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['failed-delete-category']);
                    }
                    
                    if (isset($_SESSION['failed-remove-category'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['failed-remove-category']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['failed-remove-category']);
                    }
                    if (isset($_SESSION['no-category-found'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['no-category-found']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['no-category-found']);
                    }
                    if (isset($_SESSION['update-category'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['update-category']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['update-category']);
                    }
                    
                    if (isset($_SESSION['upload'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['upload']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['upload']);
                    }
                    
                ?>
                <br>
                <!-- button to add admin -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                
                <br>
                <br>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Feature</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_category";
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
                                $title = $rows['title'];
                                $img_name = $rows['img_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                           

                                //display the data into our table
                                ?>

                            <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td> <?php echo $title ?> </td>

                                    <td>
                                        <?php
                                            if($img_name!=""){
                                                //display the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $img_name; ?>" width= "100px" alt="">
                                                <?php

                                            }
                                            else{
                                                //display the message
                                                echo "<div class='fail'>Image Not Added<?div>";

                                            }
                                        
                                        ?>
                                    </td>

                                    <td>
                                        <?php                                              
                                              if($featured=="yes"){
                                                  echo "<label style='color: green;'>$featured</label>";
                                              }
                                              if($featured=="no"){
                                                  echo "<label style='color: red;'>$featured</label>";
                                              }                                                    
                                        ?>
                                    </td>

                                    <td>
                                        <?php 

                                                if($active=="yes"){
                                                    echo "<label style='color: green;'>$active</label>";
                                                }
                                                if($active=="no"){
                                                    echo "<label style='color: red;'>$active</label>";
                                                }
                                        ?>
                                    </td>

                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>" class="btn-danger">Delete Category</a>
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