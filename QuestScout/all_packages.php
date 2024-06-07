<?php
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuestScout</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
    <!--Main container starts here-->
    <div class="main_wrapper">
        <!--Header starts here-->
        <?php include 'includes/header.php'; ?>
        <!--Header ends here-->
        <!--Navbar starts here-->
        <?php include 'includes/navbar.php'; ?>
        <!--Navbar ends here-->
        <!--Content starts here-->
        <div class="content_wrapper">
            <!--left-sidebar starts-->
            <!--left-sidebar ends-->
            <div id="content_area">
                <div id="shopping_cart">
                </div>
                <div id="packages_box">
                    <?php
                    $get_pack = "SELECT * FROM packages";

                    $run_pack = mysqli_query($con, $get_pack);

                    while ($row_pack = mysqli_fetch_array($run_pack)) {
                        $pack_id = $row_pack['package_id'];
                        $pack_cat = $row_pack['package_cat'];
                        $pack_type = $row_pack['package_type'];
                        $pack_title = $row_pack['package_title'];
                        $pack_price = $row_pack['package_price'];
                        $pack_image = $row_pack['package_image'];

                        echo "
                        <div id='single_package'>
                        <h3 style='font-family: Cambria; margin-bottom: 2px;'>$pack_title</h3>
                        <img src='admin_area/package_images/$pack_image' width='180' height='180'>
                        <p><b> Cost $ $pack_price</b></p>
                        <a href='details.php?pack_id=$pack_id' style='float: left; font-size: 18px; text-decoration: none; margin-right: 10px; padding: 6px 15px; border: 1px solid #007bff; background-color: #007bff; color: #fff;'>Details</a>
				    <a href='index.php?add_cart=$pack_id'><button style='float: right; font-size: 14px; cursor: pointer; padding: 9px 12px; background-color: #28a745; color: #fff; border: none; width: 100px; text-align: center;'>Book</button></a>
                        </div>
                        ";
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--Content ends here-->
        <!--footer starts-->
        <?php include "includes/footer.php";?>
        <!--footer ends-->
    </div>
    <!--Main container ends here-->
</body>
</html>