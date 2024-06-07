<?php
session_start();
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuestScout : Checkout</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style>
        .paypal-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #003087;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 40px;
            margin-bottom: 20px; 
        }

        .paypal-btn:hover {
            background-color: #009cde;
        }

        .cancel-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #8b0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 39px;
        }

        .cancel-btn:hover {
            background-color: #ff0000;
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
    if (isset($_SESSION['customer_email'])) {
        echo "<b>Welcome: </b><span style='color: black;'>" . $_SESSION['customer_email'] . "</span><b style='color: yellow;'> Your</b>";
    } else {
        echo "<b>Welcome Guest:</b>";
    }
    ?>
    <b style="color: yellow;">Shopping Cart-</b> Total Items: <?php total_items(); ?>
    <div style="display: inline-block; background-color: green; padding: 2px 5px; border-radius: 3px;">
        Total Price: <span style="color: black;"><?php total_price(); ?></span>
    </div>
    <a href="cart.php" style="color: yellow;">Go to Cart</a>
</span>

                </div>
                <div id="packages_box">
                    <?php
                    if (!isset($_SESSION['customer_email'])) {
                        include("includes/customer_login.php");
                    } else {
                        // Підключення до зовнішнього API PayPal
                        $paypal_client_id = "Ae3TVAH5vq2CuG3huPsm_edqsEukM1MARbYh-DzZqXyA5OXSsjWevainv1mOV-iTeNyHv6j_FJ46WaIj";
                        $paypal_secret_key = "EA0iAz8K9vWAvzGWKBtRTcxJzEPrbGSsxGYCFisAB-OUcIiRkxXYa-SRZEnFzUdT3aYHjRVhwZAUQqYY";
                        
                        // Код для виклику операцій з PayPal тут
                        // Кнопка для перенаправлення користувача на сторінку оплати PayPal
                        echo "<div style='text-align: center;'>";
                        echo "<img src='paypal.jpg' alt='PayPal' style='width: 1000px; height: 500px; margin-bottom: 40px;'>";
                        echo "<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>";
                        echo "<input type='hidden' name='cmd' value='_xclick'>";
                        echo "<input type='hidden' name='business' value='$paypal_client_id'>";
                        echo "<input type='hidden' name='item_name' value='Purchase'>";
                        echo "<input type='hidden' name='currency_code' value='USD'>";
                        echo "<input type='hidden' name='return' value='http://yourwebsite.com/return.php'>";
                        echo "<input type='hidden' name='cancel_return' value='http://yourwebsite.com/cancel.php'>";
                        echo "<input type='submit' name='submit' value='Pay with PayPal' class='paypal-btn'>";
                        echo "</form>";
                        // Кнопка скасування оплати
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='submit' name='cancel' value='Cancel Payment' class='cancel-btn'>";
                        echo "</form>";
                        echo "</div>";
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
