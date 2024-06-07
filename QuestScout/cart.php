<?php
session_start();
$total = 0;
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuestScout</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style>
        .update_cart_btn {
            background-color: #4CAF50; 
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }

        .continue_shopping_btn {
            background-color: #008CBA; 
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }

        .pay_btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }
    </style>
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
                <?php cart(); ?>
                <div id="shopping_cart">
                    <span style="float: right;font-size: 18px;padding: 5px;line-height: 40px;">
                        <?php
                        ?>
                    </span>
                </div>
                <div id="packages_box">
                    <form action="cart.php" method="post" enctype="multipart/form-data">
                        <table align="center" width="1000px" height="1580px" bgcolor="skyblue">
                            <tr align="center">
                                <th>Remove</th>
                                <th>Tours</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                            <?php
                            global $con;
                            $ip = getIp();
                            $sel_price = "SELECT * FROM cart WHERE ip_add='$ip'";
                            $run_price = mysqli_query($con, $sel_price);

                            while ($p_price = mysqli_fetch_array($run_price)) {
                                $pack_id = $p_price['p_id'];
                                $pack_price = "SELECT * FROM packages WHERE package_id='$pack_id'";
                                $run_pack_price = mysqli_query($con, $pack_price);

                                while ($pp_price = mysqli_fetch_array($run_pack_price)) {
                                    $package_price = $pp_price['package_price'];
                                    $package_title = $pp_price['package_title'];
                                    $package_image = $pp_price['package_image'];
                                    $single_price = $pp_price['package_price'];
                                    $total += $single_price * $p_price['qty'];
                                    ?>
                                    <tr align="center">
                                        <td><input type="checkbox" name="remove[]" value="<?php echo $pack_id; ?>"></td>
                                        <td>
                                            <?php echo $package_title; ?><br>
                                            <img src="admin_area/package_images/<?php echo $package_image; ?>"
                                                 width="300px" height="200px">
                                        </td>
                                        <td><input type="text" size="4" name="qty[<?php echo $pack_id; ?>]" value="<?php echo $p_price['qty']; ?>"></td>
                                        <td><?php echo "$" . ($single_price * $p_price['qty']); ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr align="right">
                                <td colspan="4"><b>Total:</b></td>
                                <td><?php echo "$" . $total; ?></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2"><input type="submit" name="update_cart" value="Update Cart" class="update_cart_btn"></td>
                                <td><input type="submit" name="continue" value="Continue Shopping" class="continue_shopping_btn"></td>
                                <td><button class="pay_btn"><a href="pay.php" style="text-decoration: none; color: white;">Pay</a></button></td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    function updatecart()
                    {
                        global $con;
                        $ip = getIp();

                        if (isset($_POST['update_cart'])) {
                            if (isset($_POST['remove'])) {
                                foreach ($_POST['remove'] as $remove_id) {
                                    $delete_package = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_add='$ip'";
                                    $run_delete = mysqli_query($con, $delete_package);
                                    if (!$run_delete) {
                                        die('Query Failed' . mysqli_error($con));
                                    }
                                }
                            }

                            if (isset($_POST['qty'])) {
                                foreach ($_POST['qty'] as $id => $qty) {
                                    if ($qty == 0) {
                                        $delete_package = "DELETE FROM cart WHERE p_id='$id' AND ip_add='$ip'";
                                        $run_delete = mysqli_query($con, $delete_package);
                                    } else {
                                        $update_qty = "UPDATE cart SET qty='$qty' WHERE p_id='$id' AND ip_add='$ip'";
                                        $run_qty = mysqli_query($con, $update_qty);
                                        if (!$run_qty) {
                                            die('Query Failed' . mysqli_error($con));
                                        }
                                    }
                                }
                            }

                            echo "<script>window.open('cart.php','_self')</script>";
                        }

                        if (isset($_POST['continue'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                    }

                    updatecart();
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
