<?php
// Initialize the session
session_start();
//var_dump($_SESSION);
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
                        <a class="nav-link" href="ticketsales.php">Upcoming Performances</a>
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
    <div>
        <h1>Hi, <b><?php echo $_SESSION["fname"]; ?></b>. Welcome to our site.</h1>
    </div>
    <div>
        <h2>Your Tickets:</h2>
        <h2>Your Bookings:</h2>
        <h2>Your Reviews:</h2>
    </div>  
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>
