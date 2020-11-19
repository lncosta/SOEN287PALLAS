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
                            $_SESSION["discount"] = rand(5, 25);                                                                                
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
    
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <style type="text/css">
        input{
            font-size: 1.05em;
            font-family: "Montserrat";
        }
        .btn-login{
            background-color: lightblue;
            border: 5px solid lightblue;
            border-radius: 5px;
            font-size: 1.05em;
        }
        .input-box{
            font-size: 1.05;
            border: 2px solid grey;
            border-radius: 5px;
            width: 30%;
            height: 1.5em;
        }
    </style>

    <!--Icons-->
    <script
    src="https://kit.fontawesome.com/ba7a137c00.js"
    crossorigin="anonymous"
    ></script>
    
</head>
<body>
    <section class="navbarsection">  
        <!--NavBar-->
            <div class="interiornav">
                <ul class="navigation" id="navmenu">
                    <li class="item">
                        <a class="link" href="mainPage.html"><span class="navbar-brand">PALLAS</span></a>
                    </li>
                    <li class="item">
                        <a class="link" href="ticketsales.php">Upcoming Performances</a>
                    </li>
                    <li class="item">
                        <a class="link" href="contactform.php">Contact + Booking</a>
                    </li>
                    <li class="item">
                        <a class="link" href="aboutpage.html">About</a>
                    </li>
                    <li class="item">
                        <a class="link" href="performancearchive.php">Performance Gallery</a>
                    </li>
                    <li class="item">
                        <a class="link" href="faq.html">FAQ</a>
                    </li>
                    <li class="item">
                        <a class="link" href="userpage.php">User's Page</a>
                    </li>
                </ul>
            </div>
    </section>
    <div class="loginsection">
        <h2>Log in!</h2>
        <p>Enter your information below to log in.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Email:</label>
                <br/><br/>
                <input type="text" class="input-box" name="email" value="<?php echo $email; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $email_err."<br/>"; ?></span>  
                <label>Password</label>
                <br/><br/>
                <input type="password" class="input-box" name="password"  value="<?php echo $password; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $password_err."<br/>"; ?></span>
                <input type="submit"  class="btn-login" value="Login">
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            <p>Forgot your password? <a href="">Reset Here</a>.</p>
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
