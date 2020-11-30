<?php
session_start();
// Check if the user is already logged in and redirect to user page.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: userpage.php");
    exit;
}
require_once "config.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />
    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>
    <style type="text/css">
        input {
            font-size: 1.05em;
            font-family: "Montserrat";
        }

        .btn-login {
            background-color: lightblue;
            border: 5px solid lightblue;
            border-radius: 5px;
            font-size: 1.05em;
            width: 15%;
        }

        .input-box {
            font-size: 1.05;
            border: 2px solid grey;
            border-radius: 5px;
            width: 30%;
            height: 1.5em;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php include("navbar.php"); ?>
    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <h1>Reset your password</h1>
                <p>An e-mail will be sent to you with instructions on how to reset your password.</p>
                <form action="reset-password.inc.php" method="post">
                    <input type="text" class="input-box" name="email" placeholder="Enter your e-mail address.">
                    <button type="submit" class="btn-login" name="reset-request-submit">Reset Password</button>

                </form>
                <?php
                if (isset($_GET["reset"])) {
                    if ($_GET["reset"] == "success") {
                        echo '<p class="signupsuccess">Check your e-mail!</p>';
                    }
                }
                ?>
            </section>
        </div>
    </main>
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
