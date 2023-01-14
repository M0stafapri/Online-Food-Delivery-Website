<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php
            
                        if (isset($_SESSION['upload'])){  
                            
                            ?>
                                <script>
                                swal({
                                title: "<?php echo ($_SESSION['upload']); ?>",
                                icon: "warning",
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
                                    <input required="required" type="text" class="input-lg" name="title" placeholder="Food Title">
                                </td>
                            </tr>

                            <tr>
                            <td><b>Descreption:</b></td>
                            <td>
                                <textarea required="required" name="descreption" class="input-lg" cols="30" rows="3" placeholder="Food Descreption"></textarea> 
                            </td>
                            </tr>

                            <tr>
                            <td><b>Price:</b></td>
                            <td>
                                <input required="required" type="number" step="any" class="input-lg" name="price" placeholder="Food Price">
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
                                <td>Category</td>
                                <td>
                                    <select name="category" id="">

                                        <?php
                                            //to display category 
                                            $sql = "SELECT * FROM tbl_category WHERE active = 'yes'";
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
                                                        ?>
                                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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
                 $descreption = $_POST['descreption'];
                 $price = $_POST['price'];
                 $category = $_POST['category'];
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
                   $image_name = "Foodtype".rand(0000, 9999).'.'.$ext;// e.g. Food_Category_834.jpg

                   
                   $source_path = $_FILES['image']['tmp_name'];

                   $destination_path = "../images/food/".$image_name;

                   //Finally Upload the Image
                   $upload = move_uploaded_file($source_path, $destination_path);

                   //Check whether the image is uploaded or not
                   //And If the image is not uploaded then we will stop the process and redirect the error message
                    if($upload==false)
                        {
                            //Set Message
                            $_SESSION['upload'] = "Failed to upload the Image.";
                            //Redirect to add category Page
                            header('location:'.SITEURL.'admin/add-food.php');
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
                 $sqli2 = "INSERT INTO tbl_food set
                 title = '$title',
                 descreption = '$descreption',
                 price = $price,
                 img_name='$image_name',
                 category_id = '$category',
                 featured = '$featured' ,
                 active = '$active'
                 ";
    
                
                
                // excuting Quary
                 $res = mysqli_query($conn, $sqli2) or die('Query failed: '. mysqli_error($conn));
                 
                //check wether tha data is inserted or not
                if($res==true){
                    //data inserted
                    // create a session variable to display
                    $_SESSION['add-food'] = "Food Added Successfuly.";
                    //redirect page TO MANAGE ADMIN
                    header('location:'.SITEURL.'admin/manage-food.php');
    
                    
              }
                else{
                   // failed to  insert data;
                   // create a session variable to display
                   $_SESSION['add-food'] = "Failed to Add Category.";
                   //redirect page TO MANAGE ADMIN
                   header('location:'.SITEURL.'admin/manage-food.php');
                    
                }
            }
           
    
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>
