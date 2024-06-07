<?php
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Insert Genre</title>
        <style type="text/css">
            b {
                font-family: arial;
                font-size: 18px;
            }

            #btn {
                font-family: arial;
                font-size: 18px; 
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 20px; 
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin: 10px 0; 
                transition-duration: 0.4s;
                cursor: pointer;
                background-color: #90B8F5;
                color: black;
            }

            #btn:hover {
                background-color: #634ADF;
                color: white;
            }

            #new_type { 
                font-size: 18px; 
                padding: 10px; 
            }
        </style>
    </head>
    <body>
        <form action="" method="post" style="padding: 80px;">
            <table align="center">
                <tr>
                    <td align="left"><b>Insert new Genre:</b></td>
                    <td align="right"><input type="text" name="new_type" id="new_type" required=""></td> 
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right"><input id="btn" type="submit" name="add_type" value="Add genre"></td>
                </tr>
            </table>
        </form>
        <?php
        include("includes/db.php");
        if (isset($_POST['add_type'])) {
            $new_type = $_POST['new_type'];
            $insert_type = "insert into types (type_title) values ('$new_type')";
            $run_type = mysqli_query($con, $insert_type);

            if ($run_type) {
                echo "<script>alert('New GENRE has been INSERTED successfully!')</script>";
                echo "<script>window.open('index.php?view_types','_self')</script>";
            }
        }
        ?>
    </body>
    </html>
    <?php
}
?>
