<?php
session_start();
// Check if the user is already logged in and redirect to user page.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: userpage.php");
    exit;
}
require_once "config.php";
// Define parameter variables and intialize them as empty
$email = $password = "";
$email_err = $password_err = "";
// Server-side validation based on mySQL protocol
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate user input
    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, email, password, fname, lname FROM users WHERE email = ?";

        if ($query = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($query, "s", $param_email); //Binds parameter to statement
            $param_email = $email;
            if (mysqli_stmt_execute($query)) {
                mysqli_stmt_store_result($query);
                if (mysqli_stmt_num_rows($query) == 1) {  //If the email is registered                
                    mysqli_stmt_bind_result($query, $id, $email, $hashed_password, $fname, $lname); //Retrieves user information into variables
                    if (mysqli_stmt_fetch($query)) {
                        if (password_verify($password, $hashed_password)) { //Verifies hashed password
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["fname"] = $fname;
                            $_SESSION["lname"] = $lname;
                            $_SESSION["discount"] = rand(5, 25);
                            // Redirect user to user page
                            header("location: userpage.php");
                        } else {
                            // Display an error message if password does not match
                            $password_err = "The password does not match the account.";
                        }
                    }
                } else {
                    // Display an error message if the email is not registered
                    $email_err = "This email has not been registered as an account. Please register before logging in.";
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($query);
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
    <title>Login</title>
    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <style type="text/css">
        input {
            font-size: 1.05em;
            font-family: "Montserrat";
            font-size: 1.05;
            border: 2px solid grey;
            border-radius: 5px;
            width: 30%;
            height: 1.5em;
        }

        .btn-login {
            background-color: lightblue;
            border: 5px solid lightblue;
            border-radius: 5px;
            font-size: 1.05em;
            width: 10%;
            height: auto;
        }
    </style>

    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="loginsection">
        <h2>Log in!</h2>
        <p>Enter your information below to log in to PALLAS.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Email:</label>
            <br /><br />
            <input type="text" name="email" value="<?php echo $email; ?>" />
            <br /><br />
            <span><?php echo $email_err . "<br/>"; ?></span>
            <label>Password:</label>
            <br /><br />
            <input type="password" name="password" value="<?php echo $password; ?>" />
            <br /><br />
            <span><?php echo $password_err . "<br/>"; ?></span>
            <input type="submit" class="btn-login" value="Login" />
        </form>
        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        <p>Forgot your password? <a href="reset-password.php">Reset Here</a>.</p>
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
