<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect them to user page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: userpage.php");
    exit;
}
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password, fname, lname FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            // Set parameters
            $param_email = $email;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $fname, $lname);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;  
                            $_SESSION["fname"] = $fname; 
                            $_SESSION["lname"] = $lname;                                                                                 
                            // Redirect user to welcome page
                            header("location: userpage.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password entered is not valid.";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found for this email.";
                }
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Login</title>
      <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link
    href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap"
    rel="stylesheet"
    />

    <!--Bootstrap-->
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
    crossorigin="anonymous"
    />
    
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script
    src="https://kit.fontawesome.com/ba7a137c00.js"
    crossorigin="anonymous"
    ></script>

    <!--Javascript and JQuery-->
    <script
    src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"
    ></script>
    <script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"
    ></script>
    <script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"
    ></script>
    
</head>
<body>
    <section class="colored-section" id="title">
                <div class="container-fluid">
                <!--NavBar-->
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand" href="mainPage.html">Pallas</a>
                    <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                    >
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="upcomingevents.html">Upcoming Performances</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="contactform.php">Contact + Booking</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="aboutpage.html">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="performancearchive.html">Performance Gallery</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="userpage.php">User's Page</a>
                        </li>
                    </ul>
                    </div>
                </nav>
        </section>
    <div class="loginsection">
        <h2>Log in!</h2>
        <p>Enter your information below to log in.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Email:</label>
                <br/>
                <input type="text" name="email" value="<?php echo $email; ?>">
                <br/>
                <span class="help-block"><?php echo $email_err."<br/>"; ?></span>  
                <label>Password</label>
                <br/>
                <input type="password" name="password"  value="<?php echo $password; ?>">
                <br/>
                <span class="help-block"><?php echo $password_err."<br/>"; ?></span>
                <input type="submit" value="Login">
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    

</body>
</html>
