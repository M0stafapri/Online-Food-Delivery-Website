<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">

        <h1>Update Order</h1>
        <br><br>

        <?php  

                if(isset($_GET['id'])){
                    //get the id of the order
                    $id = $_GET['id'];
                    // create query
                    $sql = "SELECT *FROM tbl_order WHERE id=$id";
                    //execute
                    $res = mysqli_query($conn, $sql) or die('Query failed: '. mysqli_error($conn));
                    //Chect wether the query is executed or not
                    if($res==true){
                        // check wether the data available or not 
                        $count = mysqli_num_rows($res);

                        if($count == 1){                        
                        $rows  = mysqli_fetch_assoc($res);

                        $food = $rows['food'];
                        $price = $rows['price'];
                        $qty = $rows['qty'];
                        $status = $rows['status'];                       
                        $customer_name = $rows['customer_name'];                       
                        $customer_contact = $rows['customer_contact'];                       
                        $customer_email = $rows['customer_email'];                       
                        $customer_address = $rows['customer_address'];                       
                        }
                        else{
                        //$_SESSION['no-Food-found'] = "No Food Found.";
                        header('location:'.SITEURL.'admin/manage-order.php');  
                        }
                    }
                }
                else{
                    //redirect page TO MANAGE Order
                    header('location:'.SITEURL.'admin/manage-order.php');

                 }

        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td><b>Food Name:</b></td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td><b>Price:</b></td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr> 

                <tr>
                    <td><b>Qty:</b></td>   
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" >
                    </td> 
                </tr>

                <tr>
                    <td><b>Status:</b></td>   
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                        <td><b>Customer Name:</b></td>
                        <td>
                            <input required="required" type="text" class="input-lg" name="customer_name" value="<?php echo $customer_name ?>" placeholder="customer Name">
                        </td>
                </tr>

                <tr>
                        <td><b>Customer Contact:</b></td>
                        <td>
                            <input required="required" type="tel" class="input-lg" name="customer_contact" value="<?php echo $customer_contact ?>" placeholder="customer Contact">
                        </td>
                </tr>

                <tr>
                        <td><b>Customer Email:</b></td>
                        <td>
                            <input required="required" type="text" class="input-lg" name="customer_email" value="<?php echo $customer_email ?>" placeholder="customer Email">
                        </td>
                </tr>

                <tr>
                        <td><b>Customer Address:</b></td>
                        <td>
                            <textarea required="required" type="text" class="input-lg" name="customer_address"  placeholder="customer Address"><?php echo $customer_address ?></textarea>
                        </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>


                        

            </table>
        </form>
        <!-- add category form end -->

        
        <?php
        //process the value from form and save it in Database
    
        //check wether the submit button is clicked or not 
            if(isset($_POST['submit'])){            
                //get the data from form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = ($_POST['customer_address']); //password encryption with md5
            
                 //sql Quary to save the data into Database
                 $sqli3 = "UPDATE tbl_order set
                 qty = $qty,
                 total = $total,
                 status ='$status',
                 customer_name= '$customer_name',
                 customer_contact = '$customer_contact' ,
                 customer_email = '$customer_email' ,
                 customer_address = '$customer_address'
                 WHERE id= $id
                 ";
    
                
                // excuting Quary
                $res3 = mysqli_query($conn, $sqli3) or die('Query failed: '. mysqli_error($conn));
    
                //check wether tha data is inserted or not
                if($res3==true){
                    //data inserted
                    // create a session variable to display
                    $_SESSION['update-order'] = "Order Updated Successfuly.";
                    //redirect page TO MANAGE category
                    header('location:'.SITEURL.'admin/manage-order.php');
    
                    
                }
                else{
                   // failed to  insert data;
                   // create a session variable to display
                   $_SESSION['update-orders'] = "Order to Update Food.";
                   //redirect page TO MANAGE ADMIN
                   header('location:'.SITEURL.'admin/manage-order.php');
                    
                }
            }
           
    
    ?>





    </div>
</div>


<?php include('partials/footer.php'); ?>
