<?php
session_start();
include("functions/functions.php");
include("includes/db.php");

if (isset($_SESSION['customer_email'])) {
    echo "<script>alert('You are already registered and logged in. Redirecting to your account.')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
    exit();
}

if (isset($_POST['register'])) {
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_passport = $_POST['c_passport'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];

    // Check if the email is already registered
    $check_email = "SELECT * FROM customers WHERE customer_email='$c_email'";
    $run_check = mysqli_query($con, $check_email);
    if (mysqli_num_rows($run_check) > 0) {
        echo "<script>alert('This email is already registered. Please try another one.')</script>";
        echo "<script>window.open('customer_register.php', '_self')</script>";
        exit();
    }

    // image will upload there
    move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");

    $insert_c = "INSERT INTO customers (customer_ip,customer_name,customer_email,customer_pass,c_passport,customer_country,customer_city,customer_contact,customer_address,customer_image) VALUES ('$ip','$c_name','$c_email','$c_pass','$c_passport','$c_country','$c_city','$c_contact','$c_address','$c_image')";

    $run_c = mysqli_query($con, $insert_c);

    $sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
    $run_cart = mysqli_query($con, $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    $_SESSION['customer_email'] = $c_email;
    echo "<script>alert('Account has been created successfully. Thanks!')</script>";

    if ($check_cart == 0) {
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    } else {
        echo "<script>window.open('checkout.php','_self')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuestScout : Register</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style type="text/css">
        #fixm {
            font-size: 24px; 
            padding: 12px; 
            font-family: Arial, sans-serif;
        }

        #fixi, input[type="email"], input[type="password"], select {
            font-size: 18px; 
            padding: 10px; 
            width: calc(100% - 22px);
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        #btn {
            font-family: Arial, sans-serif;
            font-size: 24px; 
            background-color: #4CAF50; 
            border: none;
            color: white;
            padding: 15px 30px; 
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 12px 6px; 
            transition-duration: 0.4s;
            cursor: pointer;
        }

        #btn:hover {
            background-color: #45a049;
            color: white;
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
            <div id="content_area">
                <?php cart(); ?>
                <div id="shopping_cart">
                </div>
                <form action="customer_register.php" method="post" enctype="multipart/form-data">
                    <table align="center" height="1785px" width="800px" style="margin-top: 60px;"> 
                        <tr align="center">
                            <td colspan="2">
                                <h2 style="margin-bottom: 45px; font-family: Cambria; font-size: 36px;">Create an Account</h2> 
                            </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Name:</td>
                            <td><input id="fixi" type="text" name="c_name" required></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Email:</td>
                            <td><input type="email" name="c_email" required></td> 
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Password:</td>
                            <td><input id="fixi" type="password" name="c_pass" required></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Passport ID:</td>
                            <td><input type="text" name="c_passport" required></td> 
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Image:</td>
                            <td><input id="fixi" type="file" name="c_image" required></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Country:</td>
                            <td>
                                <select name="c_country" required> 
                                    <option value="">Select a Country</option>
                                    <option>Ukraine</option>
                                    <option>Bangladesh</option>
                                    <option>India</option>
                                    <option>Japan</option>
                                    <option>China</option>
                                    <option>Portugal</option>
                                    <option>England</option>
                                    <option>Brazil</option>
                                    <option>Spain</option>
                                    <option>France</option>
                                    <option>Switzerland</option>
                                    <option>Croatia</option>
                                    <option>Argentina</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">City:</td>
                            <td><input id="fixi" type="text" name="c_city" required></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Contact number:</td>
                            <td><input id="fixi" type="text" name="c_contact" required></td>
                        </tr>
                        <tr>
                            <td align="right" id="fixm">Address:</td>
                            <td><input id="fixi" type="text" name="c_address" required></td>
                        </tr>
                        <tr align="center">
                            <td colspan="2"><input id="btn" type="submit" name="register" value="Create Account"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!--Content ends here-->
        <!--footer starts-->
        <?php include "includes/footer.php"; ?>
        <!--footer ends-->
    </div>
    <!--Main container ends here-->
</body>
</html>
