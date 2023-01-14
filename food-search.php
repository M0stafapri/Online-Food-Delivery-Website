<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
                //get the search keyword
                //$search$_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
                

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                

                //sql quary to get food based on search
                //$search = burger'; DROP database name;
                //"SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR descreption LIKE '%burger%' ";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search' OR descreption LIKE '%$search' ";
                //execute the query
                $res = mysqli_query($conn, $sql);
                //check if the query is excuted or not
                if($res==true){
                    //count the nums of the rows
                    $count = mysqli_num_rows($res);
                    $sn = 1; //
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            // get the value daetails
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $price = $rows['price'];
                            $descreption = $rows['descreption'];
                            $img_name = $rows['img_name'];
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

                                            <a href="<?php echo SITEURL; ?>order.php" class="btn btn-primary">Order Now</a>
                                        </div>
                                    </div>

                            <?php
                        }
                    }
                    else{
                        echo "<div class ='fail'>No Search Matched</div>";
                    }
                }
                else{
                    echo "error";
                }

            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>