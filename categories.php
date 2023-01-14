<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_category WHERE active='yes' ";
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


    <?php include('partials-front/footer.php'); ?>