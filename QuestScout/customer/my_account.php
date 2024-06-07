<?php
session_start();
include("functions/functions.php");

$user_email = "";
if (isset($_SESSION['customer_email'])) {
    $user_email = $_SESSION['customer_email'];

    global $con;
    $get_img = "SELECT * FROM customers WHERE customer_email='$user_email'";
    $run_img = mysqli_query($con, $get_img);
    $row_img = mysqli_fetch_array($run_img);

    $c_image = $row_img['customer_image'];
    $c_name = $row_img['customer_name']; 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Travel</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
</head>

<body>
    <!--Main container starts here-->
    <div class="main_wrapper">
        <!--Header starts here-->
        <div class="header_wrapper">
            <a href="../index.php"><img id="logo" src="images/logo.jpg"></a>
            <img id="banner" src="images/banner.jpg">
        </div>
        <!--Header ends here-->
        <!--Navbar starts here-->
        <div class="menubar">
            <ul id="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../all_packages.php">All Tours</a></li>
                <li><a href="my_account.php">My Account</a></li>
                <li><a href="../checkout.php">Sign in</a></li>
                <li><a href="../customer_register.php">Sign Up</a></li>
                <li><a href="../cart.php">Shopping cart</a></li>
            </ul>
            <div id="form">
                <form method="get" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search a package">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
        </div>
        <!--Navbar ends here-->
        <!--Content starts here-->
        <div class="content_wrapper">
            <div class="sidebar">
                <div id="sidebar_title">My Account:</div>
                <div id="packages_box">
                    <?php
                    if (!isset($_GET['my_orders'])) {
                        if (!isset($_GET['edit_account'])) {
                            if (!isset($_GET['change_pass'])) {
                                if (!isset($_GET['delete_account'])) {
                                    if (!empty($user_email)) {
                                    } else {
                                        echo "<h2 style='padding: 20px; color: black;'>Please login or register to access your account.</h2><br>";
                                    }
                                }
                            }
                        }
                    }
                    ?>
                <ul id="cats">
                <?php
if (!empty($user_email)) {
    echo "<p style='text-align: center; margin-top: 100px;'><img src='customer_images/$c_image' width='500' height='300'/></p>";
    echo "<li style='margin-top: 40px;'><a href='../cart.php'>My Orders</a></li>";
    echo "<li style='margin-top: 40px;'><a href='my_account.php?edit_account'>Edit Account</a></li>";
    echo "<li style='margin-top: 40px;'><a href='my_account.php?change_pass'>Change Password</a></li>";
    echo "<li style='margin-top: 40px;'><a href='my_account.php?delete_account'>Delete Account</a></li>";
    echo "<li style='margin-top: 40px;'><a href='logout.php'>Logout</a></li>";
} 
?>

                </ul>

            </div>
            <div id="content_area">
                <?php cart(); ?>
                <div id="shopping_cart">
                        <?php
                        if (!empty($user_email)) {
                        }
                        ?>
                    </span>
                </div>
                
                    <?php
                    if (isset($_GET['edit_account'])) {
                        include("edit_account.php");
                    }
                    if (isset($_GET['change_pass'])) {
                        include("change_pass.php");
                    }
                    if (isset($_GET['delete_account'])) {
                    include("delete_account.php");
                    }
                    ?>
                    </div>
                    </div>
                    </div>
                    <!--Content ends here-->
                    <div id="footer">
                    <h2 style="text-align: center; padding-top: 30px;">Support service</h2>
                    </div>
                    </div>
                    <!--Main container ends here-->
                    
                    </body>
                    </html>