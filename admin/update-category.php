<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>




        
                <?php  

                    if(isset($_GET['id'])){
                        //get the id of the admin
                         $id = $_GET['id'];
                        // create query
                        $sqli = "SELECT *FROM tbl_category WHERE id=$id";
                        //execute
                        $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));
                        //Chect wether the query is executed or not
                        if($res==true){
                            // check wether the data available or not 
                            $count = mysqli_num_rows($res);

                            if($count == 1){                        
                            $rows  = mysqli_fetch_assoc($res);
                            $title = $rows['title'];
                            $current_img = $rows['img_name'];                       
                            $featured = $rows['featured'];                       
                            $active = $rows['active'];                       
                            }
                            else{

                            $_SESSION['no-category-found'] = "No Category Found.";
                            
                            header('location:'.SITEURL.'admin/manage-category.php');  
                            }
                        }
            
                    }
                    else{
                        //redirect page TO MANAGE ADMIN
                        header('location:'.SITEURL.'admin/manage-category.php');

                    }

                ?>

        <!-- add category form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                            <td><b>Title:</b></td>
                            <td>
                                <input required="required" type="text" class="input-lg" name="title" value="<?php echo $title ?>" placeholder="Category Title">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Current Image:</b></td>                  
                                <td>                               
                                <?php
                                            if($current_img!=""){
                                                //display the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_img; ?>" width= "100px" alt="">
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
                $current_img = $_POST['current_img'];
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
                        $img_name = "FoodCategory".rand(000, 999).'.'.$ext;// e.g. Food_Category_834.jpg


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$img_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And If the image is not uploaded then we will stop the process and redirect the error message
                        if($upload==false)
                        {
                            //Set Message
                            $_SESSION['upload'] = "Failed to upload the Image.";
                            //Redirect to add category Page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stop The process
                            die();
                        }
                       
                        if($current_img !=""){
                            //remove the current image
                            $remove_path = "../images/category/".$current_img;
                            //remove the image
                            $remove = unlink($remove_path);
                            //failed to remove the image
                            if($remove=false){
                                // create a session variable to display
                                $_SESSION['failed-remove-category'] = "Failed to Delete Category";
                                //redirect page TO MANAGE ADMIN
                                header('location:'.SITEURL.'admin/manage-category.php');
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
                 $sqli2 = "UPDATE tbl_category set
                 title = '$title',
                 img_name='$img_name',
                 featured = '$featured' ,
                 active = '$active'
                 WHERE id='$id'
                 ";
    
                
                // excuting Quary
                 $res = mysqli_query($conn, $sqli2) or die('Query failed: '. mysqli_error($conn));
    
                //check wether tha data is inserted or not
                if($res==true){
                    //data inserted
                    // create a session variable to display
                    $_SESSION['update-category'] = "Category Updated Successfuly.";
                    //redirect page TO MANAGE category
                    header('location:'.SITEURL.'admin/manage-category.php');
    
                    
                }
                else{
                   // failed to  insert data;
                   // create a session variable to display
                   $_SESSION['update-category'] = "Failed to Update Category.";
                   //redirect page TO MANAGE ADMIN
                   header('location:'.SITEURL.'admin/manage-category.php');
                    
                }
            }
           
    
    ?>

        


    </div>
</div>


<?php include('partials/footer.php'); ?>
