<?php include('partials/menu.php'); ?>



        <!-- Main Content section starts--> 
        <div class="main-content">
            <div class="wrapper">
				<h1>Manage Food</h1>
                <br>
                <br>
                
                <?php
                if (isset($_SESSION['add-food'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['add-food']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['add-food']);
                    }

                    if (isset($_SESSION['failed-delete-food'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['failed-delete-food']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['failed-delete-food']);
                    }

                    if (isset($_SESSION['delete-food'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['delete-food']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['delete-food']);
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
                    
                    if (isset($_SESSION['failed-remove-food'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['failed-remove-food']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['failed-remove-food']);
                    }
                    
                    if (isset($_SESSION['update-food'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['update-food']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['update-food']);
                    }
                    
                    if (isset($_SESSION['no-Food-found'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['no-Food-found']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['no-Food-found']);
                    }

                ?>
                
                <!-- button to add admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                
                <br>
                <br>
                <br>

                <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>title</th>
                    <th>descreption</th>
                    <th>price</th>
                    <th>img_name</th>
                    <th>category_id</th>
                    <th>featured</th>
                    <th>active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_food";
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
                                $descreption = $rows['descreption'];
                                $price = $rows['price'];
                                $img_name = $rows['img_name'];
                                $category_id = $rows['category_id'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                           

                                //display the data into our table
                                ?>

                            <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td> <?php echo $title ?> </td>
                                    <td> <?php echo $descreption ?> </td>
                                    <td> <?php echo $price ?> </td>

                                    <td>
                                        <?php
                                            if($img_name!=""){
                                                //display the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $img_name; ?>" width= "100px" alt="">
                                                <?php

                                            }
                                            else{
                                                //display the message
                                                echo "<div class='fail'>Image Not Added<?div>";

                                            }
                                        
                                        ?>
                                    </td>
                                    <td><?php echo $category_id ?></td>


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
                                    <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>" class="btn-danger">Delete Food</a>
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