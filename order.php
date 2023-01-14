<?php include('partials-front/menu.php'); ?>

    <?php

        if(isset($_GET['food_id'])){
            //get the id 
            $food_id = $_GET['food_id'];
            //query to get
            $sql = "SELECT * FROM tbl_food WHERE id = $food_id ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //get the calue from database 
            $count=mysqli_num_rows($res);

            //get the data
            if($count==1){
                    // get the value daetails
                    $rows=mysqli_fetch_assoc($res);
                    $title = $rows['title'];
                    $price = $rows['price'];
                    $img_name = $rows['img_name'];
            } 
            else{
                    header('location:'.SITEURL);  
                    
            }
        }
        else{
            //redirect to home
            header('location:'.SITEURL);  
        }



    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>" >
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" step="any" value="<?php echo $price; ?>" >
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //process the value from form and save it in Database
            

                //check wether the submit button is clicked or not 
                    if(isset($_POST['submit'])){
                        //get the data from form
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        
                        $total = $price * $qty; //total price

                        $order_date =date("y-m-d h:i:s a");

                        $status = "Ordered"; //ordered on delivery or delivered cancelled.
                        
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];


                        

                        //sql Quary to save the data into Database
                        $sqli = "INSERT INTO tbl_order set
                        food = '$food',
                        price = $price ,
                        qty = $qty ,
                        total = $total ,
                        order_date = '$order_date' ,
                        status = '$status' ,
                        customer_name = '$customer_name' ,
                        customer_contact = '$customer_contact' ,
                        customer_email = '$customer_email' ,
                        customer_address = '$customer_address'
                        ";

                        // excuting Quary
                        $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));

                        //check wether tha data is inserted or not
                        if($res==true){
                            //data inserted
                          
                            // create a session variable to display
                            $_SESSION['orders'] = "Oreder Added Successfuly.";
                            //redirect page TO MANAGE ADMIN
                            header('location:'.SITEURL.'index.php');

                            
                        }
                        else{
                        // echo "failed to  insert data";
                        // create a session variable to display
                        $_SESSION['order'] = "Failed to Add Order.";
                        //redirect page TO MANAGE ADMIN
                        header('location:'.SITEURL.'index.php');
                            
                        }
                    }
                

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>