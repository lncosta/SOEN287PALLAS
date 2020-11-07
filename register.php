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

    <!--Bootstrap-->
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
    crossorigin="anonymous"
    />
    <style type="text/css">
        .wrapper{ width: 50%; padding: 50px; margin: 50px;}
       
    </style>
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
    <?php error_reporting(E_ALL); ini_set('display_errors', 1);?>
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
                        <a class="nav-link" href="contactform.html">Contact + Booking</a>
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
                    </ul>
                    </div>
                </nav>
        </section>
    <main>
    <div class="">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Email</label>
                <br/>
                <input type="text" name="email" value="<?php echo $email; ?>">
                <br/>
                <span class="help-block"><?php echo $email_err."<br/>"; ?></span>
                
                <label>First Name</label>
                <br/>
                <input type="text" name="fname" value="<?php echo $fname; ?>">
                <br/>
                <span class="help-block"><?php echo $fname_err; ?></span> 

                <label>Last Name</label>
                <br/>
                <input type="text" name="lname" value="<?php echo $lname; ?>">
                <br/>
                <span class="help-block"><?php echo $lname_err; ?></span> 
                
                <label>Password</label>
                <br/>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <br/>
                <span class="help-block"><?php echo $password_err; ?></span>
                
                <label>Confirm Password</label>
                <br/>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <br/>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>

                <input type="submit" value="Submit">
                <input type="reset"  value="Reset">
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>  
</main>  
</body>
</html>
