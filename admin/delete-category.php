<?php //include('partials/menu.php'); ?>

<?php

    //including constants
    include('../config/constraint.php');

    if(isset($_GET['id']) And isset($_GET['img_name'])){

        //get the value of category
         $id = $_GET['id'];
         $img_name = $_GET['img_name'];

         //remove the physical image file 
            if($img_name!=""){
                //image is available to remove 
                $path = "../images/category/".$img_name;
                //remove the image
                $remove = unlink($path);

                //failed to remove the image
                if($remove=false){
                // create a session variable to display
                $_SESSION['failed-delete-category'] = "Failed to Delete Category";
                //redirect page TO MANAGE ADMIN
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the proccess
                die();
                }
            }
            //delete from the database 

            // creat sql query to delete
            $sqli = "DELETE FROM tbl_category WHERE id=$id";
            //execute the query
            $res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));

            //check whether the data deleted or not

            if($res==true){
                //data deleted 
                // create a session variable to display
                $_SESSION['delete-category'] = "Category Deleted Successfuly.";
                //redirect page TO MANAGE ADMIN
                header('location:'.SITEURL.'admin/manage-category.php');

            }else{

                //failed to  delete data;
                // create a session variable to display
                $_SESSION['failed-delete-category'] = "Failed to Delete Category";
                //redirect page TO MANAGE category
                header('location:'.SITEURL.'admin/manage-category.php');
                
            }
    
    }
    else{
        //redirect page TO MANAGE category
        header('location:'.SITEURL.'admin/manage-category.php');
        
    }





?>
<?php //include('partials/footer.php'); ?>

