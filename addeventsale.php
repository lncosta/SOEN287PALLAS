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
    This page allows users to add tickets for sale for one of their booked public events. 
*/
// Initialize the session
session_start();
//var_dump($_SESSION);

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$email = $_SESSION["email"];
$email2 = "";
include_once('connect.php');
$query = "SELECT * FROM `quoteform`";
$query2 = "SELECT * FROM `upcoming events`";
$query3 = "SELECT * FROM `quoteform`";
$result = mysqli_query($conn, $query);
$result2 = mysqli_query($conn, $query2);
$result3 = mysqli_query($conn, $query3);
$services = "";


// Include config file
require_once "config.php";



// Define variables and initialize with empty values
$eventDate = $eventLocation = $entertainmentType = $discountedEvent = $eventPrice = "";

$eventDate_err = $eventLocation_err = $entertainmentType_err = $discountedEvent_err = $eventPrice_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    while ($rows = mysqli_fetch_assoc($result)) {
        if ($rows['email'] == $_SESSION["email"] && $rows['eventtype'] == "public") {
            // Validate event 
            $email2 = $rows['email'];
            if (empty(trim($_POST["EventDate"]))) {
                $eventDate_err = "Please enter the event date.";
            } else {
                $eventDate = $_POST["EventDate"];
            }

            // Validate event location
            if (empty(trim($_POST["EventLocation"]))) {
                $eventLocation_err = "Please enter the location of the event.";
            } else {
                $eventLocation = trim($_POST["EventLocation"]);
            }

            // Validate price of event
            if (empty(trim($_POST["EventPrice"]))) {
                $eventPrice_err = "Please enter the event price.";
            } else if (!(is_numeric($_POST["EventPrice"]))) {
                $eventPrice_err = "Please enter a number.";
            } else {
                $eventPrice = trim($_POST["EventPrice"]);
            }

            // Validate type of entertainment
            if (empty(trim($_POST["EntertainmentType"]))) {
                $entertainmentType_err = "Please enter the type of entertainment.";
            } else {
                $entertainmentType = trim($_POST["EntertainmentType"]);
            }

            // Validate if event is discounted or not
            if (empty(trim($_POST["DiscountedEvent"]))) {
                $discountedEvent_err = "Please let us know if the event price includes a discount.";
            } else {
                $discountedEvent = trim($_POST["DiscountedEvent"]);
            }



            // Check input errors before inserting in database
            if (empty($eventLocation_err) && empty($eventPrice_err) && empty($entertainmentType_err) && empty($discountedEvent_err)) {

                // Prepare an insert statement
                /*$sql = "INSERT INTO `upcoming events`(`EventDate`, `EventLocation`, `EventPrice`, `EntertainmentType`, `DiscountedEvent`)  VALUES (`$eventDate`, `$eventLocation`, `$eventPrice`, `$entertainmentType`, `$discountedEvent`)";
         */

                while ($rows = mysqli_fetch_assoc($result3)) {
                    if ($rows['email'] == $_SESSION["email"] && $rows['date'] == $eventDate) {

                        $services = $rows['services'];
                        break;
                    }
                }

                $sql = "INSERT INTO `upcoming events`(EventDate, EventLocation, EventPrice, EntertainmentType, DiscountedEvent, email, services) VALUES ('$eventDate', '$eventLocation', $eventPrice, '$entertainmentType', '$discountedEvent', '$email', '$services')";



                if (mysqli_query($link, $sql)) {
                    echo "Records added successfully.";
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                header("location: eventaddedconfirmation.php");
            }
        }
    }

    if ($email2 == "") {
        header("location: failuretoaddevent.php");
    }


    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add events</title>
    <meta charset="utf-8" />

    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

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
        }

        .input-box{
            font-size: 1.05em;
            border: 2px solid grey;
            border-radius: 5px;
            width: 30%;
            height: 1.5em;
            text-align: center;
        }
        select {
            font-size: 1.05em;
            border: 2px solid grey;
            border-radius: 5px;
            width: 15%;
            height: 1.5em;
            text-align: center;
            font-family: "Montserrat";
        }
        option{
            font-size: 2em; 
            text-align: center;
        }
    </style>
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>


</head>

<body>
    <?php error_reporting(E_ALL);
    ini_set('display_errors', 1); ?>
     <?php include("navbar.php"); ?>
    <main>
        <div class="">
            <h2>Sell tickets through Pallas Entertainment</h2>
            <p>Please fill this form to create your event.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Event date</label>
                <br /><br />
                <select name="EventDate">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['email'] == $email && $row['eventtype'] == "public") {
                            echo "<option value='" . $row['date'] . "'>" . $row['date'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <br /><br />
                <span class="help-block"><?php echo $eventDate_err . "<br/><br/>"; ?></span>

                <label>Event location</label>
                <br /><br />
                <input type="text" class="input-box" name="EventLocation" value="<?php echo $eventLocation; ?>">
                <br /><br />
                <span class="help-block"><?php echo $eventLocation_err . "<br/><br/>"; ?></span>

                <label>Event Description</label>
                <br /><br />
                <input type="text" class="input-box" name="EntertainmentType" value="<?php echo $entertainmentType; ?>">
                <br /><br />
                <span class="help-block"><?php echo $entertainmentType_err . "<br/><br/>"; ?></span>

                <label>Discounted event</label>
                <br /><br />
                <input type="radio" name="DiscountedEvent" value="<?php $discountedEvent = "yes";
                                                                    echo $discountedEvent; ?>">
                Yes
                </input>

                <input type="radio" name="DiscountedEvent" value="<?php $discountedEvent = "no";
                                                                    echo $discountedEvent; ?>" checked>
                No
                </input>
                <!--<input type="text" class="input-box" name="DiscountedEvent" value="<?php echo $discountedEvent; ?>">-->
                <br /><br />
                <span class="help-block"><?php echo $discountedEvent_err . "<br/><br/>"; ?></span>

                <label>Ticket price</label>
                <br /><br />
                <input type="text" class="input-box" name="EventPrice" value="<?php echo $eventPrice; ?>">
                <br /><br />
                <span class="help-block"><?php echo $eventPrice_err . "<br/><br/>"; ?></span>

                <input type="submit" class="btn-login" value="Submit">
                <input type="reset" class="btn-login" value="Reset">
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
