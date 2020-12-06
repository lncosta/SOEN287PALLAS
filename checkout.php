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
    This page is checkout page for ticket purchases. The user inputs their payment information and the purchase is processed. 
*/


include_once('connect.php');
$query = "SELECT * FROM `upcoming events`";
$result = mysqli_query($conn, $query);
require_once "config.php";

session_start();
$date = $_SESSION['date'];
$location = $_SESSION['location'];
$price = str_replace("$", "", $_SESSION['eventprice']);
$type = $_SESSION['type'];



$id = 0;

$datebooked = $date;

$fname = $lname = $email = $country = $street_address = $city = $zip = $card_type = $card_number = $cardholder = $expiration_date = $cvv = $ticket_quantity = "";
$fname_err = $lname_err = $email_err = $country_err = $street_address_err = $city_err = $zip_err = $card_type_err = $card_number_err = $cardholder_err = $expiration_date_err = $cvv_err = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ticket_quantity = $_POST["ticket_quantity"];
    // Validate fname
    if (empty(trim($_POST["first_name"]))) {
        $fname_err = "Please enter your first name.";
    } else {
        $fname = $_POST["first_name"];
    }

    // Validate lname
    if (empty(trim($_POST["last_name"]))) {
        $lname_err = "Please enter your last name.";
    } else {
        $lname = trim($_POST["last_name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate country
    if (empty(trim($_POST["country"]))) {
        $country_err = "Please enter your country.";
    } else {
        $country = trim($_POST["country"]);
    }

    // Validate card type
    if (empty(trim($_POST["card_type"]))) {
        $card_type_err = "Please enter your card type.";
    } else {
        $card_type = trim($_POST["card_type"]);
    }

    // Validate card number
    if (empty(trim($_POST["card_number"]))) {
        $card_number_err = "Please enter your card number.";
    } else if (!(is_numeric($_POST["card_number"]))) {
        $card_number_err = "Please enter a number.";
    } else {
        $card_number = trim($_POST["card_number"]);
    }

    // Validate card holder
    if (empty(trim($_POST["cardholder_name"]))) {
        $cardholder_err = "Please enter the name on the card.";
    } else {
        $cardholder = trim($_POST["cardholder_name"]);
    }

    // Validate street address
    if (empty(trim($_POST["street_address"]))) {
        $street_address_err = "Please enter your address.";
    } else {
        $street_address = trim($_POST["street_address"]);
    }

    // Validate expiration date
    if (empty(trim($_POST["expiration_date"]))) {
        $expiration_date_err = "Please enter the expiration date.";
    } else {
        $expiration_date = trim($_POST["expiration_date"]);
    }

    // Validate CVV
    if (empty(trim($_POST["CVV"]))) {
        $cvv_err = "Please enter the CVV.";
    } else {
        $cvv = trim($_POST["CVV"]);
    }

    // Validate city
    if (empty(trim($_POST["city"]))) {
        $city_err = "Please enter the city.";
    } else {
        $city = trim($_POST["city"]);
    }

    // Validate postal code
    if (empty(trim($_POST["postal_code"]))) {
        $zip_err = "Please enter the postal code.";
    } else {
        $zip = trim($_POST["postal_code"]);
    }



    // Check input errors before inserting in database
    if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($card_number_err) && empty($cardholder_err) && empty($street_address_err) && empty($expiration_date_err) && empty($cvv_err) && empty($city_err) && empty($zip_err)) {

        // Prepare an insert statement
        /*$sql = "INSERT INTO `upcoming events`(`EventDate`, `EventLocation`, `EventPrice`, `EntertainmentType`, `DiscountedEvent`)  VALUES (`$eventDate`, `$eventLocation`, `$eventPrice`, `$entertainmentType`, `$discountedEvent`)";
         */


        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['card_type'] = $card_type;
        $_SESSION['ticket_quantity'] = $ticket_quantity;
        $_SESSION['email'] = $email;
        $_SESSION['cardholder_name'] = $cardholder;
        $_SESSION['street_address'] = $street_address;
        $_SESSION['expiration_date'] = $expiration_date;
        $_SESSION['CVV'] = $cvv;
        $_SESSION['city'] = $city;
        $_SESSION['postal_code'] = $zip;

        $sql = "INSERT INTO `ticketsale`(id, fname, lname, email, country, streetaddress, city, zip, paymenttype, cardnumber, cardholder, expirydate, CVV, datebooked, ticketquantity) VALUES ('$id', '$fname', '$lname', '$email', '$country', '$street_address', '$city', '$zip', '$card_type', '$card_number', '$cardholder', '$expiration_date', '$cvv', '$datebooked', '$ticket_quantity')";

        if (mysqli_query($link, $sql)) {
            echo "Records added successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

        $id++;

        header("location: MailTest.php");
    }


    // Close connection
    mysqli_close($link);
}


?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="styles.css" />
    <script type="text/javascript">
        function increment() {
            var price = <?php echo $price ?>;
            var value = parseInt(document.getElementById("ticket_quantity").value);

            value = isNaN(value) ? 1 : value;
            value++;
            document.getElementById("ticket_quantity").value = value;
            var newPrice = value * price;

            document.getElementById("dynamicPrice").innerHTML = newPrice + "$";
            var tax = newPrice * .15;
            var subtotal = newPrice + tax;
            document.getElementById("tax").innerHTML = tax + "$";
            document.getElementById("subtotal").innerHTML = subtotal + "$";
        }

        function decrement() {
            var price = <?php echo $price ?>;
            var value = parseInt(document.getElementById("ticket_quantity").value);
            value = isNaN(value) ? 0 : value;
            value--;
            if (value <= 1) {
                value = 1;
            }
            var newPrice = value * price;
            document.getElementById("ticket_quantity").value = value;
            document.getElementById("dynamicPrice").innerHTML = newPrice + "$";

            var tax = newPrice * .15;
            var subtotal = newPrice + tax;
            document.getElementById("tax").innerHTML = tax + "$";
            document.getElementById("subtotal").innerHTML = subtotal + "$";
        }
    </script>
    <style>
        form {
            font-size: 1.05em;
            font-family: "Montserrat";
        }

        .help-block {
            color: lightcoral;
        }

        .checkout {
            font-family: "Montserrat";
            margin: 20px;
            padding: 10px;
            color: white;
            border-radius: 5px;
            background-image: url("media/images/pattern.jpg");
            border-radius: 10px;
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .3);
        }

        input,
        textarea,
        select {
            border-radius: 10px;
            font-size: 1em;
            border: 2px solid whitesmoke;
            font-family: "Montserrat";
            height: 30px;
        }

        textarea {
            width: 100%;
        }

        table {
            table-layout: fixed;
            width: 100%;
            text-align: left;
        }

        .checkout p {
            color: white;
        }

        table td,
        table td * {
            vertical-align: top;
        }

        td {
            padding: 5px;
        }

        fieldset {
            border: 2px solid whitesmoke;
            border-radius: 10px;
            padding: 10px;
            vertical-align: middle;
        }

        fieldset input {
            width: 100%;
        }

        img {
            border-radius: 10px;
            background-color: white;
        }

        button {
            font-size: 1.15em;
            background-color: lightblue;
            color: black;
            border: 2px solid lightblue;
            border-radius: 5px;
            text-decoration: none;
            font-style: "Montserrat";
        }

        #ticket_quantity {
            width: 50%;
        }
    </style>
    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />
    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="checkout">

        <form name="checkout_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Express Checkout</h1>
            <table>
                <tr>
                    <th colspan=2>Billing Address</th>
                    <th colspan=2>Payment</th>
                    <th>Cart</th>
                </tr>
                <tr>
                    <td><label>First name</label>
                        <br /> <input class="card" type="text" placeholder="First Name" name="first_name" value="<?php echo $fname; ?>">
                        <br />
                        <span class="help-block"><?php echo $fname_err . "<br/>"; ?></span>
                    </td>
                    <td>Last name
                        <br /> <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $lname; ?>">
                        <br />
                        <span class="help-block"><?php echo $lname_err . "<br/>"; ?></span>
                    </td>

                    <td>
                        <br />
                        <div class=border>
                            <label>
                                <input class="center" type="radio" name="card_type" placeholder="Card Type" value="credit card" checked>
                                <br>
                                <div class="center">
                                    Credit Card
                                </div>
                            </label>
                        </div>
                        <br />
                        <span class="help-block"><?php echo $card_type_err . "<br/>"; ?></span>
                    </td>
                    <td>
                        <br>
                        <div class="border">
                            <label>
                                <input class="center" type="radio" name="card_type" value="paypal">

                                <div class="center">Paypal</div>
                            </label>
                        </div>
                        <br />
                        <span class="help-block"><?php echo $card_type_err . "<br/>"; ?></span>
                    </td>
                    <td rowspan=5>
                        <table>
                            <tr>
                                <td><img src="media/images/minus.png" width="30px" height="30px" onclick="decrement()"></td>
                                <td><input type="text" width="15px" name="ticket_quantity" id="ticket_quantity" value="0" /></td>
                                <td><img src="media/images/plus.png" width=30px height=30px onclick="increment()"></td>
                            </tr>


                            <tr>
                                <td colspan="3"> Event Details:</td>
                            </tr>

                            <tr>
                                <td colspan="3"> Performance: <text><?php echo $type; ?></text></td>
                            </tr>
                            <tr>
                                <td colspan="3"> Location: <br> <text><?php echo $location; ?></text></td>
                            </tr>
                            <tr>
                                <td colspan="3">Price: <p id="dynamicPrice"></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Tax: <p id="tax"></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">Subtotal: <p id="subtotal"></p>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3"><button>Checkout</button></td>
                            </tr>

                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <label>Email</label>
                        </br>
                        <input type="text" name="email" placeholder="mail@mail.com" value="<?php echo $email; ?>">
                        <br />
                        <span class="help-block"><?php echo $email_err . "<br/>"; ?></span>
                    </td>
                    <td colspan="2">
                        <fieldset class="card">
                            <legend>Card Number</legend>
                            <input class="none" type='text' placeholder="0000 0000 0000" name=card_number>
                            <br />
                            <span class="help-block"><?php echo $card_number_err . "<br/>"; ?></span>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td colspan=2>
                        <label>Country</label>
                        </br>
                        <select name="country" value="<?php echo $country; ?>">
                            <option value="Argentina">Argentina</option>
                            <option value="Canada">Canada</option>
                            <option value="United States">United States</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                    <td colspan=2>
                        <fieldset class="card">
                            <legend>Name on Card</legend>
                            <input class="none" type="text" placeholder="Name on Card" name="cardholder_name" placeholder="Cardholder Name">
                            <br />
                            <span class="help-block"><?php echo $cardholder_err . "<br/>"; ?></span>

                        </fieldset>

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Street Address</label>
                        <br>
                        <input type="text" name="street_address" placeholder="Street" value="<?php echo $street_address; ?>">
                        <br />
                        <span class="help-block"><?php echo $street_address_err . "<br/>"; ?></span>
                    </td>
                    <td>
                        <div class="exp">
                            <input class="exp" type="type" name="expiration_date" placeholder="Expiration Date" value="<?php echo $expiration_date; ?>" onfocus="(this.type = 'date')">
                            <br />
                            <span class="help-block"><?php echo $expiration_date_err . "<br/>"; ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="exp">
                            <input class="exp" type="text" name="CVV" placeholder="CVV" maxlength="3" value="<?php echo $cvv; ?>">
                            <br />
                            <span class="help-block"><?php echo $cvv_err . "<br/>"; ?></span>

                        </div>
                    </td>
                </tr>
                <tr>

                    <td>
                        <label>Town/City</label>
                        <br>
                        <input class="two" type="text" name="city" placeholder="City" value="<?php echo $city; ?>">
                        <br />
                        <span class="help-block"><?php echo $city_err . "<br/>"; ?></span>
                    </td>
                    <td>
                        <label>Postal Code</label>
                        <br>
                        <input type="text" name="postal_code" placeholder="0000-0000" value="<?php echo $zip; ?>">
                        <br />
                        <span class="help-block"><?php echo $zip_err . "<br/>"; ?></span>
                    </td>

                </tr>
            </table>

            </table>
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
