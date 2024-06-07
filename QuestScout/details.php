<?php
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuestScout</title>
    <link rel="stylesheet" href="styles/style.css" media="all">
    <style>
 .btn-book,
        .btn-back,
        .btn-review {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 50px; 
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 150px;
            cursor: pointer;
            border-radius: 5px; 
        }

        .btn-book:hover,
        .btn-back:hover,
        .btn-review:hover {
            background-color: #45a049; 
        }
#single_package {
    width: 100%; 
    margin: 2.5%;
    padding: 10px;
    box-sizing: border-box;
    float: left; 
    box-sizing: border-box;
    margin-left: 0%; 
}



.reviews_container:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
}

.reviews_container::-webkit-scrollbar {
  width: 10px; 
}

.reviews_container::-webkit-scrollbar-thumb {
  background-color: #888; 
  border-radius: 10px; 
}

.reviews_container::-webkit-scrollbar-thumb:hover {
  background-color: #555; /
}

.reviews_container::-webkit-scrollbar-track {
  background-color: #f1f1f1; 
  border-radius: 10px; 
}


.reviews_container {
  max-height: 300px; 
  overflow-y: auto; 
  margin: 20px auto; 
  border: 1px solid #ccc; 
  border-radius: 8px; 
  padding: 10px; 
  width: 400px; /* Doubled width */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
  background-color: #fff; 
  transition: box-shadow 0.3s ease; 
}

.review {
  margin-bottom: 10px; 
  word-wrap: break-word; 
  width: 100%; 
  max-width: 100%; /* Ensure the review text does not exceed container width */
  white-space: pre-wrap; /* Preserve line breaks */
}

#review_form {
  margin: 1px auto; 
  width: 50%; 
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
        <?php include "includes/left-sidebar.php"; ?>
        <!--left-sidebar ends-->
        <div id="content_area">
            <div id="shopping_cart">
            </div>
            <div id="packages_box">
                <?php
                if (isset($_GET['pack_id'])) {
                    $package_id = $_GET['pack_id'];

                    $get_pack = "SELECT * FROM packages WHERE package_id='$package_id'";

                    $run_pack = mysqli_query($con, $get_pack);

                    while ($row_pack = mysqli_fetch_array($run_pack)) {
                        $pack_id = $row_pack['package_id'];
                        $pack_title = $row_pack['package_title'];
                        $pack_price = $row_pack['package_price'];
                        $pack_image = $row_pack['package_image'];
                        $pack_desc = $row_pack['package_desc'];

                        // Display tour information
                        echo "
                        <div id='single_package'>
                        <h3 style='font-family: Cambria; margin-bottom: 2px;'>$pack_title</h3>
                        <img src='admin_area/package_images/$pack_image' width='400' height='300'>
                        <p><b>Cost $ $pack_price</b></p>
                        <p>$pack_desc</p>
                        <a href='index.php' class='btn-back'>Go Back</a>
                        <a href='index.php?pack_id=$pack_id'><button class='btn-book'>Book</button></a>
                        </div>
                        ";
                    }

                    // Display reviews for the package
                    echo "<div id='reviews_section'>";
                    $get_reviews = "SELECT customers.customer_name, reviews.review_text FROM reviews INNER JOIN customers ON reviews.customer_id = customers.customer_id WHERE reviews.package_id='$package_id'";
                    $run_reviews = mysqli_query($con, $get_reviews);
                    echo "<div class='reviews_container'>";
                    while ($row_review = mysqli_fetch_array($run_reviews)) {
                        $customer_name = $row_review['customer_name'];
                        $review_text = $row_review['review_text'];
                        echo "<div class='review'>";
                        echo "<p><strong>$customer_name:</strong> $review_text</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }

                // Review form
                echo "
                <div id='review_form'>
                    <h3>Add Review</h3>
                    <form method='post' action=''>
                        <input type='hidden' name='package_id' value='$package_id'>
                        <textarea name='review_text' rows='4' cols='50' style='width: 100%; resize: vertical;' required></textarea><br> <!-- Додані стилі для textarea -->
                        <input type='submit' name='submit_review' value='Submit Review' class='btn-review' style='margin-top: 10px;'> <!-- Додані стилі для кнопки -->
                    </form>
                </div>
                ";

                // Process submitted review
                if (isset($_POST['submit_review'])) {
                    $package_id = $_POST['package_id'];
                    $review_text = mysqli_real_escape_string($con, $_POST['review_text']);
                    $customer_id = 1; 

                    $insert_review = "INSERT INTO reviews (package_id, customer_id, review_text) VALUES ('$package_id', '$customer_id', '$review_text')";
                    $run_review = mysqli_query($con, $insert_review);

                    if ($run_review) {
                        echo "<script>alert('Review added successfully!')</script>";
                        echo "<script>window.open('index.php?pack_id=$package_id','_self')</script>";
                    } else {
                        echo "<script>alert('Failed to add review.')</script>";
                    }
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
