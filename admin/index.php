<?php include('partials/menu.php'); ?>

        <!-- Main Content section starts--> 
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBORD</h1>
                <br><br>
                <?php
                    if (isset($_SESSION['login'])){                         
                        ?>
                            <script>
                            swal({
                            title: "<?php echo ($_SESSION['login']); ?>",
                            icon: "success",
                            button: "close",
                            });
                            </script>
                        
                       <?php
                       unset($_SESSION['login']);
                    }
                    ?>
                <br><br>

                <div class="col-4 text-center">

                    <?php
                        //Sql Query
                        $sql = "SELECT * FROM tbl_category";
                        //Execute Query
                        $res = mysqli_query($conn,$sql);
                        //Count Rows
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br>
                    Category
                </div>

                <div class="col-4 text-center">
                <?php
                        //Sql Query
                        $sql2 = "SELECT * FROM tbl_category";
                        //Execute Query
                        $res2 = mysqli_query($conn,$sql2);
                        //Count Rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
            
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Foods
                </div>
                
                <div class="col-4 text-center">
                <?php
                        //Sql Query
                        $sql3 = "SELECT * FROM tbl_order";
                        //Execute Query
                        $res3 = mysqli_query($conn,$sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Total Orders
                </div>
                
                <div class="col-4 text-center">
                <?php
                        //Create SQL query to get Total Revenue Generated
                        //Aggregate function in sql
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered' ";

                        //Execute Query
                        $res4 = mysqli_query($conn,$sql4);
                        //Get the Value
                        $row4 = mysqli_fetch_assoc($res4);

                        //Get the Total Revenue
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1>$<?php echo number_format((float)$total_revenue, 2, '.', '');
                    ?></h1>
                    <br>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

                
            </div>
        </div>
        <!-- Main Content section ends--> 

    <?php include('partials/footer.php'); ?>