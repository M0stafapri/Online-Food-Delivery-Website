<?php

//including constants
include('../config/constraint.php');

//get the id from admin
 $id = $_GET['id'];


// creat sql query to delete
$sqli = "DELETE FROM tbl_admin WHERE id=$id";

//execute
$res = mysqli_query($conn, $sqli) or die('Query failed: '. mysqli_error($conn));

//check whether the data deleted or not

if($res==true){
    //data deleted 
    // create a session variable to display
    $_SESSION['delete-admin'] = "Admin Deleted Successfuly.";
    //redirect page TO MANAGE ADMIN
    header('location:'.SITEURL.'admin/manage-admin.php');


}
else{
   //failed to  delete data;
   // create a session variable to display
   $_session['delete-admin'] = "Failed to Delete Admin";
   //redirect page TO MANAGE ADMIN
   header('location:'.SITEURL.'admin/add-admin.php');
    
}


?>