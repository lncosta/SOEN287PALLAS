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
    This processes the booking request with immediate payment. 
*/
$link = mysqli_connect("localhost", "root", "", "demo");
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security

$param_email =  mysqli_real_escape_string($link, $_REQUEST['email']);
$param_fname =  mysqli_real_escape_string($link, $_REQUEST['fname']);
$param_lname =  mysqli_real_escape_string($link, $_REQUEST['lname']);
$param_phone =  mysqli_real_escape_string($link, $_REQUEST['phone']);
$param_date =  mysqli_real_escape_string($link, $_REQUEST['date']);
$param_eventtype =  mysqli_real_escape_string($link, $_REQUEST['eventtype']);
$param_budget =  mysqli_real_escape_string($link, $_REQUEST['budget']);
$param_services =  implode(",", $_POST['performances']);
$param_optionals = implode(",", (array)$_REQUEST['options']);
$param_quote =  mysqli_real_escape_string($link, $_REQUEST['quote']);
$param_message =  mysqli_real_escape_string($link, $_REQUEST['message']);
// Attempt insert query execution
$sql = "INSERT INTO quoteform (email, fname, lname, phone, date, eventtype, budget, services, optionals, quote, message) VALUES ('$param_email', '$param_fname', '$param_lname', '$param_phone', '$param_date ', '$param_eventtype', '$param_budget', '$param_services', '$param_optionals', '$param_quote', '$param_message')";
if (mysqli_query($link, $sql)) { //If sucessful, begins session and stores information needed for payment.
    echo "Records added successfully.";
    session_start();
    $_SESSION["bookingdate"] = $param_date;
    $_SESSION["bookingprice"] = $param_quote;
    $_SESSION["bookingservices"] = $param_services;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

//Send confirmation email:
$to_email = $param_email;
$subject = "Pallas Entertainment - Your Quote Estimation";
$body = "Hi, " . $param_fname . ".\nHere's the quote for your event on " . $param_date . ".\nName: " . $param_fname . " " . $param_lname . "." . "\nPhone: " . $param_phone . "." . "\nType: " . $param_eventtype . "." . "\nPerformances: " . $param_services . "." .
    "\nOptional Services: " . $param_optionals . "." .
    "\nBudget: " . $param_budget . "." .
    "\nAdditional Requests: " . $param_message . "." .
    "\nQuote: $" . $param_quote . ".00." .
    "\nOne of our representatives will reach out to you soon to discuss your event. In the meantime, you can contact us through of our many channels. \nThank you for choosing PALLAS!. \n-The PALLAS team.";
$headers = "From: PALLAS";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

// Close connection
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Request Confirmation</title>
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
    <!--Display form summary-->
    <div>
        <br />
        <h1>Hi, <b><?php echo $param_fname ?></b>. Your quote estimation has been sent to your email. Here is a summary of your request:</h1>
    </div>
    <br />
    <div class="mail">
        <h2>First Name: <b><?php echo $param_fname ?></b></h2>
        <h2>Last Name: <b><?php echo $param_lname ?></b></h2>
        <h2>Email: <b><?php echo $param_email ?></b></h2>
        <h2>Phone: <b><?php echo $param_phone ?></b></h2>
        <h2>Date: <b><?php echo $param_date ?></b></h2>
        <h2>Type: <b><?php echo $param_eventtype ?></b></h2>
        <h2>Performances: <b><?php echo $param_services ?></b></h2>
        <h2>Optional Services: <b><?php echo $param_optionals ?></b></h2>
        <h2>Budget: <b><?php echo $param_budget ?></b></h2>
        <h2>Additional Requests: <b><?php echo $param_message ?></b></h2>
        <h2>Your Quote: $<b><?php echo $param_quote ?></b></h2>
    </div>
    <br />
    <p>
        <a href="bookingcheckout.php" class="btn">Proceed to Checkout</a>
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