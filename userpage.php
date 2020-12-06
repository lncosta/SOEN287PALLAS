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
    This page is the user portal. It displays information on purchased tickets, events, reviews, and offers personalized discounts. 
*/

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$email = $_SESSION["email"];
//Fetching necessary information about user from the database:
include_once('connect.php');
$query = "SELECT * FROM `quoteform`";
$result = mysqli_query($conn, $query);
$query2 = "SELECT * FROM `upcoming events`";
$result2 = mysqli_query($conn, $query2);
$query3 = "SELECT * FROM `ticketsale`";
$result3 = mysqli_query($conn, $query3);
$query8 = "SELECT * FROM `ticketsale`";
$result8 = mysqli_query($conn, $query8);

//Queries used in personalized discount:
$query7 = "SELECT * FROM `upcoming events`";
$result7 = mysqli_query($conn, $query7);
$query5 = "SELECT * FROM `upcoming events`";
$result5 = mysqli_query($conn, $query5);
$query6 = "SELECT * FROM `upcoming events`";
$result6 = mysqli_query($conn, $query6);

//Calculating personalized discount:

$ticket_quantity = 0;
$ticket_discount = 0;
$ticket_discount2 = 0;
$datebooked[0] = "";
$email_ticket[0] = "";
$email_from_result3 = "";
$i = 0;
$j = 0;
$count = 0; //Initializes counter for number of purchased services. 

$services[0] = "";
$services2[0] = "";
$services3[0] = "";

while ($rows = mysqli_fetch_assoc($result3)) { //Returns booking date and associated email.
    if ($rows['email'] == $email) {

        //$email_from_result3 = $rows['email'];
        $datebooked[$i] = $rows['datebooked'];
        $ticket_quantity .= $rows['ticketquantity'];
        $email_ticket[$i] = $rows['email'];
        $i++;
    }
}


while ($rows = mysqli_fetch_assoc($result5)) { // Retrieves the services for upcoming event.
    for ($i = 0; $i < sizeof($datebooked); $i++) {
        if ($rows['EventDate'] == $datebooked[$i]) {

            //echo $rows['services'];
            $services[$j] = $rows['services'];
            //echo $j;
            $j++;
        }
    }
}


$k = 0;

for ($i = 0; $i < sizeof($services); $i++) { //Explodes the array of services into a string.

    $string[$k] = explode(',', $services[$i]);
    $k++;
}

$k = 0;

for ($i = 0; $i < sizeof($string); $i++) { //Creates a one-dimensional array from a two-dimensional array. 
    for ($l = 0; $l < sizeof($string[$i]); $l++) {
        $services2[$k] = $string[$i][$l];
        $k++;
    }
}


if ($ticket_quantity !== 0 && $ticket_quantity % 3 === 0) { //Addtional discount depending on number of tickets purchased (discount for every 3 tickets purchased)

    $ticket_discount = 0.05;
}

$k = 0;

for ($i = 0; $i < sizeof($services2); $i++) { //Cleans out empty spaces in array if there are any. 

    if (empty($services2[$i])) {
        continue;
    } else {
        $services3[$k] = $services2[$i];
        $k++;
    }
}




while ($rows = mysqli_fetch_assoc($result6)) { //Sets discount based on performances from tickets purchased by user. 
    for ($i = 0; $i < sizeof($services3); $i++) { //+ $rows['DiscountedEvent'] == "yes" or 
        if (preg_match_all("/$services3[$i]/", $rows['services'])) {
            $count++;
            // echo $services2[$i];
            if ($count == 2) {

                $ticket_discount2 = $ticket_discount2 + 0.005;
                $count = 0;
                //echo $ticket_discount2;

            }
        }
    }
}

if (array_key_exists('button', $_POST)) { //Re-directs user to checkout page with ticket data. 
    // echo "This is the date: ".$_POST['date'];

    $_SESSION['date'] = $_POST['date'];
    $_SESSION['location'] = $_POST['location'];
    $_SESSION['eventprice'] = $_POST['discountedprice'];
    $_SESSION['type'] = $_POST['type'];
    header('Location: checkout.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

    <style type="text/css">
        .wrapper {
            width: 50%;
            padding: 50px;
            margin: 50px;
        }

        .btndefault {
            font-size: 1.15em;
            background-color: lightblue;
            color: black;
            border: 2px solid lightblue;
            border-radius: 5px;
            text-decoration: none;
            font-style: "Montserrat";
            font-weight: normal;
            font-family: inherit;

        }

        .btnbuy {
            background-color: lightblue;
            color: black;
            border: 2px solid lightblue;
            border-radius: 5px;
            text-decoration: none;
            font-style: "Montserrat";
            max-width: 75%;
            font-family: inherit;

        }

        .btnregular {
            background-color: lightcoral;
            color: black;
            border: 2px solid lightcoral;
            border-radius: 5px;
            text-decoration: none;
            font-style: "Montserrat";
            max-width: 75%;
            font-weight: normal;
            font-family: inherit;

        }

        .booked {
            text-align: center;
            margin-right: auto;
            margin-left: auto;
            width: 88%;
            line-height: 40px;
        }

        .review {
            text-align: left;
            margin-right: auto;
            margin-left: auto;
            width: 95%;
            line-height: 40px;
        }

        .review th,
        .review td {
            padding-left: 15px;
            padding-right: 15px;
        }

        .offcenter {
            width: 5%;
            padding-left: 20px;
        }

        .stars {
            display: inline-block;
        }

        .stars * {
            float: right;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 30px;
        }

        .stars input:checked~label {
            color: gold;
        }

        .stars label:hover,
        label:hover~label {
            color: gold;
        }

        */ .stars input:checked~label:hover,
        input:checked~label:hover~label {
            color: gold !important;
        }

        input,
        textarea {
            border-radius: 10px;
            font-size: 1em;
            border: 2px solid whitesmoke;
            font-family: "Montserrat";
        }

        .small input {
            max-width: 30%;
            min-width: 15%;
        }

        .medium input {
            width: 40%;
        }

        .booking {
            overflow-y: scroll;
            max-height: 400px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .booking th {
            position: sticky;
            top: 0;
            background-color: white;
        }
    </style>
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        // When the user clicks on the button, open the modal
        function showModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>

</head>

<body>
    <?php include("navbar.php"); ?>
    <div>
        <h1>Hi, <b><?php echo $_SESSION["fname"]; ?></b>. Welcome to our site.</h1>
    </div>
    <div>
        <!--Displaying discounted prices using session discount-->
        <h2>Special Prices, Just For You!</h2>
        <div class="booking">
            <table class="booked">
                <tr>
                    <th> Date </th>
                    <th> Event Location </th>
                    <th> Event Price </th>
                    <th> Your Discounted Price </th>
                    <th> Entertainment Type </th>
                </tr>
                <?php
                $discount = $_SESSION["discount"];
                $discount = $discount / 100 + $ticket_discount;
                while ($rows = mysqli_fetch_assoc($result2)) {
                    for ($i = 0; $i < sizeof($services3); $i++) { // + $rows['DiscountedEvent'] == "yes" or 
                        if (preg_match_all("/$services3[$i]/", $rows['services'])) { //Displays discounted events based on user purchases (blue button).

                ?>
                            <tr>
                                <form method="post">
                                    <td class="medium"> <input type="text" id="date" name="date" value="<?php echo $rows['EventDate']; ?>" readonly> </td>
                                    <td> <input type="text" id="location" name="location" value="<?php echo $rows['EventLocation']; ?>" readonly> </td>
                                    <td class="small"> <input type="text" id="price" name="price" value="<?php echo $rows['EventPrice']; ?>" readonly>$ </td>
                                    <td class="small"> <input type="text" id="discountedprice" name="discountedprice" value="<?php echo $rows['EventPrice'] * (1 - $discount - $ticket_discount2); ?>" readonly>$ </td>
                                    <td><?php echo $rows['EntertainmentType']; ?> </td>
                                    <td> <input type="hidden" id="type" name="type" value="<?php echo $rows['EntertainmentType']; ?>" readonly> </td>
                                    <td><button type="submit" name="button" class="btnbuy">Buy Tickets</button></td>
                                </form>
                            </tr>
                        <?php
                            break;
                        } else if ($rows['DiscountedEvent'] == "yes") { //Displays regular discounted events (red button).


                        ?>
                            <tr>
                                <form method="post">
                                    <td class="medium"> <input type="text" id="date" name="date" value="<?php echo $rows['EventDate']; ?>" readonly> </td>
                                    <td> <input type="text" id="location" name="location" value="<?php echo $rows['EventLocation']; ?>" readonly> </td>
                                    <td class="small"> <input type="text" id="price" name="price" value="<?php echo $rows['EventPrice']; ?>" readonly>$ </td>
                                    <td class="small"> <input type="text" id="discountedprice" name="discountedprice" value="<?php echo $rows['EventPrice'] * (1 - $discount); ?>" readonly>$ </td>
                                    <td><?php echo $rows['EntertainmentType']; ?> </td>
                                    <td> <input type="hidden" id="type" name="type" value="<?php echo $rows['EntertainmentType']; ?>" readonly> </td>
                                    <td><button type="submit" name="button" class="btnregular">Buy Tickets</button></td>
                                </form>
                            </tr>
                <?php
                            break;
                        }
                    }
                }
                ?>
            </table>
        </div>
        <h2>Your Tickets:</h2>
        <!--Displays all tickets bought by the user -->
        <div class="booking">
            <table class="booked">
                <tr>
                    <th> Date </th>
                    <th> Tickets Bought </th>
                    <th> Location </th>
                    <th> Price </th>
                </tr>
                <?php
                while ($rows = mysqli_fetch_assoc($result8)) {

                    if ($rows['email'] == $_SESSION['email']) { //Displays only tickets registered under user's email
                ?>
                        <tr>
                            <td> <?php echo $rows['datebooked']; ?> </td>
                            <td> <?php echo $rows['ticketquantity']; ?> </td>
                            <?php
                            $date = $rows['datebooked'];
                            $query4 = "SELECT * FROM `upcoming events` where EventDate ='$date'";
                            $result4 = mysqli_query($conn, $query4);
                            while ($rows2 = mysqli_fetch_assoc($result4)) { //Retrieves information for the event for which the ticket was purchased


                            ?>
                                <td> <?php echo $rows2['EventLocation']; ?> </td>
                                <td> <?php echo $rows2['EventPrice']; ?>$ </td>
                            <?php

                            }
                            ?>

                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
        <h2>Your Bookings:</h2>
        <!--Displays events booked by the user, as well as payment status -->
        <div class="booking">
            <table class="booked">
                <tr>
                    <th>Date</th>
                    <th>Booked Acts</th>
                    <th>Optional Services </th>
                    <th>Total Price</th>
                    <th>Event Type</th>
                    <th>Payment Status</th>
                    <th>Tickets Sold </th>
                </tr>
                <?php
                $publiccounter = 0;
                while ($rows = mysqli_fetch_assoc($result)) {
                    if ($rows['email'] == $_SESSION["email"]) {
                ?>
                        <tr>
                            <td> <?php echo $rows['date']; ?> </td>
                            <td> <?php echo $rows['services']; ?> </td>
                            <td> <?php echo $rows['optionals']; ?> </td>
                            <td> $<?php echo $rows['quote']; ?>.00 </td>
                            <td> <?php echo $rows['eventtype']; ?> </td>
                            <?php
                            if ($rows['eventtype'] == "public") {
                                $publiccounter++;
                            }
                            ?>
                            <td><?php
                                if ($rows['paidfor']) {
                                    echo "Payment Fulfilled";
                                } else {
                                    echo "Payment Pending";
                                }
                                ?>
                            </td>
                            <?php
                            $date = $rows['date'];
                            $ticketcounter = 0;
                            $query5 = "SELECT * FROM `ticketsale` where datebooked ='$date'";
                            $result5 = mysqli_query($conn, $query5);
                            while ($rows = mysqli_fetch_assoc($result5)) {
                                $ticketcounter++;
                            }
                            ?>
                            <td> <?php echo $ticketcounter; ?>
                            <td>
                        </tr>
                <?php
                    }
                }
                ?>

            </table>
        </div>
        <h3>Add tickets for sale</h3>
        <!--Displays public events booked by user and gives the option of adding ticker for sale-->
        <p>
            <?php
            if ($publiccounter > 0) { //If the user has booked a public event, displays the option to add tickets for sale
                echo "<a href=" . "addeventsale.php" . " class=" . "btndefault" . ">Sell Tickets For Your Public Event</a>";
            } else
                echo "<a href=\"\" class= \"btndefault\">You have no public events booked</a>";

            ?>
        </p>
        <h2>Your Reviews:</h2>
        <!--Display user's reviews-->
        <div id="reviews" class="booking">
            <button type="button" class="btndefault" onclick="showModal()">Add Review</button>
            <?php //Retrives reviews submitted by the users from another table:
            $newquery = "SELECT * FROM `reviews` where email='$email'";
            $newresult = mysqli_query($conn, $newquery);
            ?>
            <div>
                <table class="review">
                    <tr>
                        <th class="offcenter">Rating</th>
                        <th>Review</th>
                    </tr>
                    <?php
                    while ($newrows = mysqli_fetch_assoc($newresult)) { //Fetches user reviews from database and displays them in a table format:
                    ?>
                        <tr>
                            <td class="offcenter"> <?php echo $newrows['rating']; ?>/5 </td>
                            <td> <?php echo $newrows['userreview']; ?> </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
  
    <p> <!--Reset Password-->
        <a href="resetpassword.php" class="btndefault">Reset Password</a>
    </p>

    <p> <!--Logging out-->
        <a href="logout.php" class="btndefault">Sign Out of Your Account</a>
    </p>
    <!-- Modal for adding a review -->
    <div class="modal-div" id="myModal">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <table>
                        <tr>
                            <td>Add Review:</td>
                            <td class="tdclosebutton"><button type="button" id="close" class="close" onclick="closeModal()">&times;</button></td>
                        </tr>
                    </table>
                </h4>
            </div>
            <div class="modal-body">

                <form id="myform" action="savereview.php" method="post">
                    <label>Select Your Rating</label>
                    <br />
                    <div class="stars">
                        <!-- Radio buttons that allow user to select stars-->
                        <input type="radio" id="r1" name="rating" value="5">
                        <label for="r1">&#9733;</label>
                        <input type="radio" id="r2" name="rating" value="4">
                        <label for="r2">&#9733;</label>
                        <input type="radio" id="r3" name="rating" value="3">
                        <label for="r3">&#9733;</label>
                        <input type="radio" id="r4" name="rating" value="2">
                        <label for="r4">&#9733;</label>
                        <input type="radio" id="r5" name="rating" value="1">
                        <label for="r5">&#9733;</label>
                    </div>
                    <input type="hidden" name="fname" value="<?php echo $_SESSION["fname"]; ?>">
                    <input type="hidden" name="email" value="<?php echo $_SESSION["email"]; ?>">
                    <br />
                    <label>Write Your Review Below</label>
                    <br />
                    <br />
                    <textarea id="userreview" name="userreview" rows=4 cols="50" placeholder="Please add review here"></textarea>

            </div>
            <div class="modal-footer">
                <input type="submit" class="btndefault" />
                </form>
            </div>
        </div>
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
