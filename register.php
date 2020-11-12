<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $fname = $lname = $confirm_password = "";
$email_err = $password_err = $fname_err = $lname_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email= ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate first name
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter a first name.";     
    } else{
        $fname= trim($_POST["fname"]);
    }
    // Validate last name
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter a last name.";     
    } else{
        $lname= trim($_POST["lname"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have at least 8 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($fname_err) && empty($lname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password, fname, lname) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_email, $param_password, $param_fname, $param_lname);
            
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fname = $fname;
            $param_lname = $lname;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //Send confirmation email
                $to_email = $param_email;
                $subject = "Pallas Entertainment - Your account has been created";
                $body = "Hi, ".$param_fname.".\nYour Pallas account has been created! Here's your account information:\nYour email: ".$param_email.".\nName: ".$param_fname." ".$param_lname."."."\nPassword: ".$password.".".
                "\nYou can now log into your account to view bookings, tickets, ticket sales, and add reviews. \nThank you for choosing PALLAS!. \n-The PALLAS team."
                ;
                $headers = "From: PALLAS";

                if (mail($to_email, $subject, $body, $headers)) {
                        echo "Email successfully sent to $to_email...";
                } 
                else {
                        echo "Email failed...";
                }
                // Redirect to login page
                header("location: login.php");
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
    <title>Sign Up</title>
    <meta charset="utf-8" />

    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link
    href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap"
    rel="stylesheet"
    />

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
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script
    src="https://kit.fontawesome.com/ba7a137c00.js"
    crossorigin="anonymous"
    ></script>

   
</head>
<body>
    <?php error_reporting(E_ALL); ini_set('display_errors', 1);?>
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
                        <a class="link" href="performancearchive.html">Performance Gallery</a>
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
    <main>
    <div class="">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Email</label>
                <br/><br/>
                <input type="text" class="input-box" name="email" value="<?php echo $email; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $email_err."<br/>"; ?></span>
                
                <label>First Name</label>
                <br/><br/>
                <input type="text" class="input-box" name="fname" value="<?php echo $fname; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $fname_err; ?></span> 

                <label>Last Name</label>
                <br/><br/>
                <input type="text" class="input-box" name="lname" value="<?php echo $lname; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $lname_err; ?></span> 
                
                <label>Password</label>
                <br/><br/>
                <input type="password" class="input-box" name="password" value="<?php echo $password; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $password_err; ?></span>
                
                <label>Confirm Password</label>
                <br/><br/>
                <input type="password" class="input-box" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <br/><br/>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>

                <input type="submit" class="btn-login" value="Submit">
                <input type="reset" class="btn-login" value="Reset">
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
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
