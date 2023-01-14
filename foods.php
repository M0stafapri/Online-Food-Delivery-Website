<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
                    //query to get all admin
                    $sql2 = "SELECT * FROM tbl_food WHERE active='yes'";
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    //check if the query is excuted or not
                    if($res2==true){
                        //count the nums of the rows
                        $count2 = mysqli_num_rows($res2);
                        $sn = 1; //
                        if($count2>0){
                            while($rows2=mysqli_fetch_assoc($res2)){
                                //using while loop to get all the data from database
                                //and while loop will run as lomg as we have data in the database

                                //get individual data
                                $id = $rows2['id'];
                                $title = $rows2['title'];
                                $price = $rows2['price'];
                                $descreption = $rows2['descreption'];
                                $img_name = $rows2['img_name'];

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