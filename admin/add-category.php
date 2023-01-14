<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
            if (isset($_SESSION['add-category'])){  
                            
                            ?>
                                <script>
                                swal({
                                title: "<?php echo ($_SESSION['add-category']); ?>",
                                icon: "success",
                                button: "close",
                                });
                                </script>
        
                        <?php
                        unset($_SESSION['add-category']);

                        }
                        if (isset($_SESSION['upload'])){  
                            
                            ?>
                                <script>
                                swal({
                                title: "<?php echo ($_SESSION['upload']); ?>",
                                icon: "success",
                                button: "close",
                                });
                                </script>
        
                        <?php
                        unset($_SESSION['upload']);

                        }
        ?>
        <!-- add category form start -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                            <td><b>Title:</b></td>
                            <td>
                                <input required="required" type="text" class="input-lg" name="title" placeholder="Category Title">
                            </td>
                        </tr>
                        <tr>
                            <td><b>Select Image:</b></td>                  
                                <td>                               
                                    <input  type="file" name="image">                           
                                </td>                                      
                            </div>
                            
                        </tr>

                        <tr>
                            <td><b>Featured:</b></td>
                            <td>
                                <input required="required"  class="" type="radio" name="featured" value="yes">yes
                                <input required="required"  class="" type="radio" name="featured" value="no">no
                            </td>
                        </tr>

                        <tr>
                            <td><b>Active:</b></td>
                            <td>
                                <input required="required"  class="" type="radio" name="active" value="yes">yes
                                <input required="required"  class="" type="radio" name="active" value="no">no

                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
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
                 $title = $_POST['title'];
                 $featured = $_POST['featured'];
                 $active = ($_POST['active']); //password encryption with md5
                

                //check wether tha image is selected or not
                    //print_r($_FILES['image']);
                if(isset($_FILES['image']['name']))
                {
                   //Upload the image
                   //To upload image we need image name, source path and destination path
                   $image_name = $_FILES['image']['name'];
                    // uploead image if there is

                    if($image_name != ""){
                   //Auto Rename our image
                   //Get the Extension of our image (jpg. png. gif. etc) e.g. "specialfood1.jpg"
                   $ext= end(explode('.', $image_name));

                   //Rename The image
                   $image_name = "FoodCategory".rand(000, 999).'.'.$ext;// e.g. Food_Category_834.jpg

                   
                   $source_path = $_FILES['image']['tmp_name'];

                   $destination_path = "../images/category/".$image_name;

                   //Finally Upload the Image
                   $upload = move_uploaded_file($source_path, $destination_path);

                   //Check whether the image is uploaded or not
                   //And If the image is not uploaded then we will stop the process and redirect the error message
                    if($upload==false)
                        {
                            //Set Message
                            $_SESSION['upload'] = "Failed to upload the Image.";
                            //Redirect to add category Page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //Stop The process
                            die();
                        }
                    }
               }
               else
               {
                   //Don't upload the image and set the image_name value as blank
                   $image_name="";
               }


                 //sql Quary to save the data into Database
                 $sqli = "INSERT INTO tbl_category set
                 title = '$title',
                 img_name='$image_name',
                 featured = '$featured' ,
                 active = '$active'
                 ";
    
                
                
                // excuting Quary
                 $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));
    
                //check wether tha data is inserted or not
                if($res==true){
                    //data inserted
                    // create a session variable to display
                    $_SESSION['add-category'] = "Category Added Successfuly.";
                    //redirect page TO MANAGE ADMIN
                    header('location:'.SITEURL.'admin/manage-category.php');
    
                    
              }
                else{
                   // failed to  insert data;
                   // create a session variable to display
                   $_SESSION['add-category'] = "Failed to Add Category.";
                   //redirect page TO MANAGE ADMIN
                   header('location:'.SITEURL.'admin/add-category.php');
                    
                }
            }
           
    
    ?>

        


    </div>
</div>


<?php include('partials/footer.php'); ?>
