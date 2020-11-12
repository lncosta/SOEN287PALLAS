<?php
// Initialize the session
session_start();
//var_dump($_SESSION);
 
// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$email = $_SESSION["email"];
include_once('connect.php');
$query = "SELECT * FROM `quoteform`";
$result = mysqli_query($conn, $query);

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

    <style type="text/css">
        .wrapper{ width: 50%; padding: 50px; margin: 50px;}
        .btndefault{
            font-size: 1.15em;
            background-color: lightblue;
            color: black;
            border: 2px solid blue;
            border-radius: 5px;
        }
        .booked{
            text-align: center;
            margin-right: auto;
            margin-left: auto;
            width:600px; 
            line-height:40px;
        }
       
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
    <div>
        <h1>Hi, <b><?php echo $_SESSION["fname"]; ?></b>. Welcome to our site.</h1>
    </div>
    <div>
        <h2>Your Tickets:</h2>
        <h2>Your Bookings:</h2>
            <table class="booked">
                <tr>
                    <th>Date</th>
                    <th>Booked Acts</th>
                    <th>Optional Services </th>
                    <th>Total Price</th>
                    <th>Event Type</th>
                </tr>
                <?php
                     while($rows = mysqli_fetch_assoc($result)){
                         if($rows['email'] == $_SESSION["email"]){
                        ?>
                            <tr>
                            <td> <?php echo $rows['date']; ?> </td>
                            <td> <?php echo $rows['services']; ?> </td>
                            <td> <?php echo $rows['optionals']; ?> </td>
                            <td> <?php echo $rows['quote']; ?> </td>
                            <td> <?php echo $rows['eventtype']; ?> </td>
                           </tr>
                        <?php
                        }
                    }
                ?>

            </table>
        <h2>Your Reviews:</h2>
    </div>  
    <p>
        <a href="logout.php" class="btndefault">Sign Out of Your Account</a>
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
