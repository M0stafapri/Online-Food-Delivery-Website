<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>


                <?php  

                    if(isset($_GET['id'])){
                        //get the id of the food
                         $id = $_GET['id'];
                        // create query
                        $sql = "SELECT *FROM tbl_food WHERE id=$id";
                        //execute
                        $res = mysqli_query($conn, $sql) or die('Query failed: '. mysqli_error($conn));
                        //Chect wether the query is executed or not
                        if($res==true){
                            // check wether the data available or not 
                            $count = mysqli_num_rows($res);

                            if($count == 1){                        
                            $rows  = mysqli_fetch_assoc($res);
                            $title = $rows['title'];
                            $descreption = $rows['descreption'];
                            $price = $rows['price'];
                            $current_img = $rows['img_name'];                       
                            $current_category = $rows['category_id'];                       
                            $featured = $rows['featured'];                       
                            $active = $rows['active'];                       
                            }
                            else{

                            $_SESSION['no-Food-found'] = "No Food Found.";
                            
                            header('location:'.SITEURL.'admin/manage-food.php');  
                            }
                        }
            
                    }
                    else{
                        //redirect page TO MANAGE ADMIN
                        header('location:'.SITEURL.'admin/manage-food.php');

                    }

                ?>

        <!-- add category form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                        <tr>
                            <td><b>Title:</b></td>
                            <td>
                                <input required="required" type="text" class="input-lg" name="title" value="<?php echo $title ?>" placeholder="food Title">
                            </td>
                        </tr>

                        <tr>
                            <td><b>Descreption:</b></td>
                            <td>
                                <textarea required="required" name="descreption" class="input-lg" cols="30" rows="3"  placeholder="Food Descreption"><?php echo $descreption ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td><b>Price:</b></td>
                            <td>
                                <input required="required" type="number" class="input-lg" name="price" value="<?php echo $price ?>" placeholder="Food Price">
                            </td>
                        </tr>

                        <tr>
                            <td><b>Current Image:</b></td>                  
                                <td>                               
                                <?php
                                            if($current_img!=""){
                                                //display the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_img; ?>" width= "100px" alt="">
                                                <?php

                                            }
                                            else{
                                                //display the message
                                                echo "<div class='fail'>Image Not Found<?div>";

                                            }
                                        
                                        ?>                    
                            </td>                                      
                        </tr>

                        <tr>
                            <td><b>New Image:</b></td>                  
                                <td>                               
                                    <input  type="file" name="image">                           
                                </td>                                      
                            </div>
                            
                        </tr>

                        
                        <tr>
                                <td><p>Category:</p></td>
                                <td>
                                    <select name="category" value="<?php echo $category_id ?>" id="">

                                        <?php
                                            //to display category 
                                            $sqli2 = "SELECT * FROM tbl_category WHERE active = 'yes'";
                                            //execute the query
                                            $res2 = mysqli_query($conn, $sqli2);
                                            //check if the query is excuted or not
                                            if($res2==true){
                                                //count the nums of the rows
                                                $count = mysqli_num_rows($res2);
                                                $sn = 1; //
                                                if($count>0){
                                                    while($rows=mysqli_fetch_assoc($res2)){
                                                        //using while loop to get all the data from database
                                                        //and while loop will run as lomg as we have data in the database

                                                        //get individual data
                                                        $category_title = $rows['title'];
                                                        $category_id = $rows['id'];
                                                        ?>
                                                            <option <?php if($current_category == $category_id){echo "selected"; }?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                                        <?php
                                                    }
                                                }
                                                else{
                                                    ?>
                                                    <option value="0">No Category Found</option>
                                                    <?php
                                                }
                                            }

                                                        
                                        ?>
                                    </select>
                                </td>
                            </tr>



                        <tr>
                            <td><b>Featured:</b></td>
                            <td>
                                <input required="required" <?php if($featured=="yes"){echo "checked";} ?> class="" type="radio" name="featured" value="yes">yes
                                
                                <input required="required" <?php if($featured=="no"){echo "checked";} ?> class="" type="radio" name="featured" value="no">no
                            </td>
                        </tr>

                        <tr>
                            <td><b>Active:</b></td>
                            <td>
                                <input required="required"  <?php if($active=="yes"){echo "checked";} ?> class="" type="radio" name="active" value="yes">yes
                                
                                <input required="required"  <?php if($active=="no"){echo "checked";} ?> class="" type="radio" name="active" value="no">no
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
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
                $title = $_POST['title'];
                $descreption = $_POST['descreption'];
                $price = $_POST['price'];
                $current_img = $_POST['current_img'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = ($_POST['active']); //password encryption with md5
                

                //check wether tha image is selected or not
                   //print_r($_FILES['image']);
                if(isset($_FILES['image']['name'])){
                   //Upload the image
                   //To upload image we need image name, source path and destination path
                   $img_name = $_FILES['image']['name'];

                   if($img_name !=""){
                        //Auto Rename our image
                        //Get the Extension of our image (jpg. png. gif. etc) e.g. "specialfood1.jpg"
                        $ext= end(explode('.', $img_name));

                        //Rename The image
                        $img_name = "Foodtype".rand(0000, 9999).'.'.$ext;// e.g. Food_Category_834.jpg


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/food/".$img_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And If the image is not uploaded then we will stop the process and redirect the error message
                        if($upload==false)
                        {
                            //Set Message
                            $_SESSION['upload'] = "Failed to upload the Image.";
                            //Redirect to add category Page
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //Stop The process
                            die();
                        }
                       
                        if($current_img !=""){
                            //remove the current image
                            $remove_path = "../images/food/".$current_img;
                            //remove the image
                            $remove = unlink($remove_path);
                            //failed to remove the image
                            if($remove=false){
                                // create a session variable to display
                                $_SESSION['failed-remove-food'] = "Failed to Delete Food";
                                //redirect page TO MANAGE ADMIN
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop the proccess
                                die();
                                }

                        }
                       

                   }
                   else{
                    $img_name= $current_img;
                   }

                   
                }
                else
                {
                    //Don't upload the image and set the image_name value as blank
                    $img_name= $current_img;
                }

                
                 //sql Quary to save the data into Database
                 $sqli3 = "UPDATE tbl_food set
                 title = '$title',
                 descreption = '$descreption',
                 price = $price,
                 img_name ='$img_name',
                 category_id= $category,
                 featured = '$featured' ,
                 active = '$active'
                 WHERE id= $id
                 ";
    
                
                // excuting Quary
                $res3 = mysqli_query($conn, $sqli3) or die('Query failed: '. mysqli_error($conn));
    
                //check wether tha data is inserted or not
                if($res3==true){
                    //data inserted
                    // create a session variable to display
                    $_SESSION['update-food'] = "Food Updated Successfuly.";
                    //redirect page TO MANAGE category
                    header('location:'.SITEURL.'admin/manage-food.php');
    
                    
                }
                else{
                   // failed to  insert data;
                   // create a session variable to display
                   $_SESSION['update-food'] = "Failed to Update Food.";
                   //redirect page TO MANAGE ADMIN
                   header('location:'.SITEURL.'admin/manage-food.php');
                    
                }
            }
           
    
    ?>

        


    </div>
</div>


<?php include('partials/footer.php'); ?>
