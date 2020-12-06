<?php
/*  SOEN 287 Group Project Fall 2020
    Team 8 - PALLAS Entertainment
    Team members:
    Florian Charreau (26494889) 
    Piyush Goyal(40106759) 
    Aline Kurkdjian (40131528)
    Joseph Mezzacappa(40134799)
    Luiza Nogueira Costa (40124771)
    Yi Heng Yan (40060587)
    This page allows the user to update their password.  
*/
session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
require_once "config.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,}$/'; //Standard pattern for password match.

    //Verifying user input:
    if (empty(trim($_POST["new_password"]))) { //Check if password is empty
        $new_password_err = "Please enter a password.";
    } else if (!preg_match($pattern,$_POST["new_password"])){ //Check if passwird matches the pattern
        $new_password_err = "Password must contain at least one capital letter, one number, and one special character. It must have at least 8 characters.";

    }
    if (empty(trim($_POST["confirm_password"]))) {
        $new_password_err = "Please confirm the password.";
    }
    if ($_POST["new_password"] != $_POST["confirm_password"]) { //Check that both passwords match
        $new_password_err = "Passwords do not match.";
    }


    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_email);

            // Set parameters
            $new_password = $_POST["new_password"];
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_email = $_SESSION["email"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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
    <div>
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>New Password</label>
            <br />
            <br />
            <input type="password" name="new_password" class="input-box" value="<?php echo $new_password; ?>">
            <br />
            <span><?php echo $new_password_err; ?></span>
            <br />
            <br />
            <label>Confirm Password</label>
            <br />
            <br />
            <input type="password" class="input-box" name="confirm_password">
            <br />
            <span><?php echo $confirm_password_err; ?></span>
            <br />
            <br />
            <input type="submit" class="btn-login" value="Submit">
            <br />
            <br />
            <button type="button" class="btn-login" onclick="location.href ='userpage.php'">Cancel</button>
    </div>
    </form>
    </div>
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
