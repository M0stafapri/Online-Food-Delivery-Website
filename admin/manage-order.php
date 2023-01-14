<?php include('partials/menu.php'); ?>



        <!-- Main Content section starts--> 
        <div class="main-content">
            <div class="wrapper">
				<h1>Manage Order</h1>

                <?php
                if (isset($_SESSION['update-order'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['update-order']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['update-order']);
                    }

                    if (isset($_SESSION['update-orders'])){  
                        
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['update-orders']); ?>",
                            icon: "warning",
                            button: "close",
                            });
                            </script>
       
                       <?php
                       unset($_SESSION['update-orders']);
                    }

                ?>


                
                <br>
                <br>
                <br>

                <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query to get all order
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                    //execute the query
                    $res = mysqli_query($conn, $sql);
                    $sn=1;
                    //count the rows
                    $count = mysqli_num_rows($res);
                    //check if the query is excuted or not
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                                //using while loop to get all the data from database
                    
                                //get individual data
                                //get the data from form
                                $id = $rows['id'];
                                $food = $rows['food'];
                                $price = $rows['price'];
                                $qty = $rows['qty'];  
                                $total = $rows['total']; 
                                $order_date = $rows['order_date'];
                                $status =  $rows['status']; 
                                $customer_name = $rows['customer_name'];
                                $customer_contact = $rows['customer_contact'];
                                $customer_email = $rows['customer_email'];
                                $customer_address = $rows['customer_address'];

                                //display the data into our table
                                ?>
                                <tr>
                                    <td><?php echo $sn++ ?></td>
                                    <td> <?php echo $food ?> </td>                        
                                    <td><?php echo $price ?></td>
                                    <td><?php echo $qty ?></td>
                                    <td><?php echo $total ?></td>
                                    <td><?php echo $order_date ?></td>

                                    <td>
                                        <?php
                                            if($status=="Ordered"){
                                                echo "<label>$status</label>";
                                            }
                                            if($status=="On Delivery"){
                                                echo "<label style='color: orange;'>$status</label>";
                                            }
                                            if($status=="Delivered"){
                                                echo "<label style='color: green;'>$status</label>";
                                            }
                                            if($status=="Cancelled"){
                                                echo "<label style='color: red;'>$status</label>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $customer_name ?></td>
                                    <td><?php echo $customer_contact ?></td>
                                    <td><?php echo $customer_email ?></td>
                                    <td><?php echo $customer_address ?></td>
                                
                                

                                    <td>
                                        
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                    </td>
                                </tr>
                                <?php

                            
                        }
                    }
                    else{
                        //order not vailable
                        echo "<tr><td colspan='12' calss='fail' >Order Not Available.</td></tr>";
                    }

                    
                
                ?>

            </table>

				

				<div class="clearfix"></div>

				
            </div>
        </div>
        <!-- Main Content section ends--> 


 <?php include('partials/footer.php'); ?>