<?php include('partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php
                    
                    if (isset($_SESSION['orders'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['orders']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['orders']);

                    }

                    if (isset($_SESSION['order'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['order']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['order']);

                    }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' LIMIT 3";
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
                               
                                //display the data into our table
                                ?>

                                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;  ?>">
                                    <div class="box-3 float-container">

                                    <?php
                                        if($img_name==""){
                                            echo "<div class='fail'>Image Not Available.</div>";
                                        }
                                        else{
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $img_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    

                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>






            <?php

                                        }
                                    }
                                    else{

                                        echo "<div class='fail'>Category Not Added</div>";

                                    }

                                }
                            
                            ?>
           

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->




    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
                    //query to get all admin
                    $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 6";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    //check if the query is excuted or not
                    if($res2==true){
                        //count the nums of the rows
                        $count2 = mysqli_num_rows($res2);
                        $sn = 1; //
                        if($count2>0){
                            while($rows=mysqli_fetch_assoc($res2)){
                                //using while loop to get all the data from database
                                //and while loop will run as lomg as we have data in the database

                                //get individual data
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $price = $rows['price'];
                                $descreption = $rows['descreption'];
                                $img_name = $rows['img_name'];

                                //display the data into our table
                                ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">

                                    <?php
                                        if($img_name==""){
                                            echo "<div class='fail'>Image Not Available.</div>";
                                        }
                                        else{
                                            ?>  
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $img_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                            <?php
                                        }
                                    ?>
                                
                                    </div>

                                            <div class="food-menu-desc">
                                                <h4><?php echo $title; ?></h4>
                                                <p class="food-price">$<?php echo $price; ?></p>
                                                <p class="food-detail">
                                                    <?php echo $descreption; ?>
                                                </p>
                                                <br>

                                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;  ?>" class="btn btn-primary">Order Now</a>
                                            </div>
                     </div>
                                   

            <?php

                                        }
                                    }
                                    else{

                                        echo "<div class='fail'>Food Not Added</div>";

                                    }

                                }
                            
                            ?>



            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials-front/footer.php'); ?>


    