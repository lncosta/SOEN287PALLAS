<?php
require_once "config.php";
// Escape user inputs for security

$param_email =  mysqli_real_escape_string($link, $_REQUEST['email']);
$param_fname =  mysqli_real_escape_string($link, $_REQUEST['fname']);
$param_rating =  mysqli_real_escape_string($link, $_REQUEST['rating']);
$param_userreview =  mysqli_real_escape_string($link, $_REQUEST['userreview']);

// Attempt insert query execution
$sql = "INSERT INTO reviews (email, fname, rating, userreview) VALUES ('$param_email', '$param_fname', '$param_rating', '$param_userreview')";
if (mysqli_query($link, $sql)) {
    echo "Records added successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />


    <style type="text/css">
        body {
            margin: 20px;
        }

        .mail {
            margin: 20px;
            padding: 20px;
            text-align: left;
            border: 2px solid blue;
        }

        .btn {
            background-color: lightblue;
            border: 5px solid lightblue;
            border-radius: 5px;
            color: black;
            text-decoration: none;

        }

        .btn a {
            color: black;

        }
    </style>
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>


</head>

<body>
    <?php include("navbar.php"); ?>
    <!--Displays review submission confirmation and provides option to redirect to main page -->
    <div>
        <br />
        <h1>Hi, <b><?php echo $param_fname ?></b>. Your review has been added. Here is a copy of it:</h1>
    </div>
    <br />
    <div class="mail">
        <h2>First Name: <b><?php echo $param_fname ?></b></h2>
        <h2>Rating: <b><?php echo $param_rating ?></b>/5</h2>
        <h2>Your Review: <b><?php echo $param_userreview ?></b></h2>
    </div>
    <br />
    <p>
        <a href="mainpage.php" class="btn">Return to Home Page</a>
    </p>

    <footer class="white-section" id="footer">
        <div class="container-fluid">
            <i class="footer-icon fab fa-twitter"></i>
            <i class="footer-icon fab fa-facebook-f"></i>
            <i class="footer-icon fab fa-instagram"></i>
            <i class="footer-icon fas fa-envelope"></i>
            <p>© Copyright 2020 PALLAS Entertainment</p>
        </div>
    </footer>
</body>

</html>
