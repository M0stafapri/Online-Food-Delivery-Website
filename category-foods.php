<?php include('partials-front/menu.php'); ?>

    <?php  

        if(isset($_GET['category_id'])){
            //get the id of the admin
            $category_id = $_GET['category_id'];
            //query to get
            $sql = "SELECT title FROM tbl_category WHERE id = $category_id ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //get the calue from database 
            $rows=mysqli_fetch_assoc($res);
            //get the title
            $category_title = $rows['title'];
        }
        else{
            //redirect to home
            header('location:'.SITEURL);  
        }

    ?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <!-- -->

            

            <?php
                

                //sql quary to get food based on search
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id ";
                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check if the query is excuted or not
               
                    //count the nums of the rows
                    $count2 = mysqli_num_rows($res2);
                    
                    if($count2>0){
                        while($rows2=mysqli_fetch_assoc($res2)){
                            // get the value daetails
                            $id = $rows2['id'];
                            $title = $rows2['title'];
                            $price = $rows2['price'];
                            $descreption = $rows2['descreption'];
                            $img_name = $rows2['img_name'];
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
                                            <p class="food-price"><?php echo $price; ?></p>
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
                        echo "<div class='fail'>No Search Matched.</div>";
                    }
                

            ?>



            <!-- -->



            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>