<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Insert Difficulty</title>
        <style type="text/css">
            b {
                font-family: arial;
                font-size: 18px;
            }

            #btn {
                font-family: arial;
                font-size: 18px; /* Збільшив розмір шрифту */
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 20px; /* Збільшив відступ */
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin: 10px 0; /* Збільшив відступ */
                transition-duration: 0.4s;
                cursor: pointer;
                background-color: #90B8F5;
                color: black;
            }

            #btn:hover {
                background-color: #634ADF;
                color: white;
            }

            #new_cat { 
                font-size: 18px; 
                padding: 10px; 
            }
        </style>
    </head>
    <body>
        <form action="" method="post" style="padding: 80px;">
            <table align="center">
                <tr>
                    <td align="left"><b>Insert new Difficulty:</b></td>
                    <td align="right"><input type="text" name="new_cat" id="new_cat" required=""></td> 
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right"><input id="btn" type="submit" name="add_cat" value="Add Difficulty"></td>
                </tr>
            </table>
        </form>

        <?php
        include("includes/db.php");
        if (isset($_POST['add_cat'])) {
            $new_cat = $_POST['new_cat'];
            $insert_cat = "insert into categories (cat_title) values ('$new_cat')";
            $run_cat = mysqli_query($con, $insert_cat);

            if ($run_cat) {
                echo "<script>alert('New DIFFICULTY has been INSERTED successfully!')</script>";
                echo "<script>window.open('index.php?view_cats','_self')</script>";
            }
        }
        ?>
    </body>
    </html>
    <?php
}
?>
