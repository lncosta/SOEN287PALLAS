<?php

include_once('connect.php');
$query = "SELECT * FROM `upcoming events`";
$result = mysqli_query($conn, $query);
require_once "config.php";

session_start();
$date = $_SESSION['date'];
$location = $_SESSION['location'];
$price = $_SESSION['price'];
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
        $email_err = "Please enter your last name.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate country
    if (empty(trim($_POST["country"]))) {
        $country_err = "Please enter your last name.";
    } else {
        $country = trim($_POST["country"]);
    }

    // Validate card type
    if (empty(trim($_POST["card_type"]))) {
        $card_type_err = "Please enter your last name.";
    } else {
        $card_type = trim($_POST["card_type"]);
    }

    // Validate card number
    if (empty(trim($_POST["card_number"]))) {
        $card_number_err = "Please enter your last name.";
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
    <link rel="stylesheet" type="text/css" href="Fancy.css" />
    <script>
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
            color: red;
        }
    </style>
</head>

<body style="background-image: url(media/images/pattern2.jpg);">

    <form  name="checkout_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h1 style = "text-align: center;">Express Checkout</h1>
        <table style = "margin-left: auto; margin-right:auto; border: solid white 3px; border-radius: 8px;">
            <tr>
                <th style = "font-size: 23px;" colspan=2>Billing Address</th>
                <th  style = "font-size: 23px;" colspan=2>Payment</th>
                <th  style = "font-size: 23px;" >Cart</th>
            </tr>
            <tr>
                <td><label>First name</label>
                    <br /> <input class="card" type="text" name="first_name" value="<?php echo $fname; ?>">
                    <br />
                    <span class="help-block"><?php echo $fname_err . "<br/>"; ?></span>
                </td>
                <td>Last name
                    <br /> <input type="text" name="last_name" value="<?php echo $lname; ?>">
                    <br />
                    <span class="help-block"><?php echo $lname_err . "<br/>"; ?></span>
                </td>

                <td>
                    <br />
                    <div class=border>
                        <label>
                            <input style = "margin-left: 70px;" class="center" type="radio" name="card_type" value="credit card" checked>
                            <br>
                            <div class="center">
                                Credit Card
                            </div>
                        </label>
                    </div>
                    <br />
                    <span class="help-block"><?php echo $card_type_err . "<br/>"; ?></span>
                </td>
                <td style="width:165px;">
                    <br>
                    <div class="border">
                        <label>
                            <input style = "margin-left: 67px;" class="center" type="radio" name="card_type" value="paypal">

                            <div class="center">Paypal</div>
                        </label>
                    </div>
                    <br/>
                    <span class="help-block"><?php echo $card_type_err . "<br/>"; ?></span>
                </td>
                <td rowspan=5 style=" padding: 5px; width: auto; height: auto; border: solid white 2px; vertical-align: top;">
                    <div style="width: 100%; padding-left: 20px; padding-right: 20px; margin-top: 10px; ">
                        <img src="media/images/minus.png" width=30px; height=30px; onclick="decrement()" style="top:0; vertical-align: middle;cursor:pointer;" on>
                        <input value = 0 type=text name = "ticket_quantity" id="ticket_quantity" style="width: 30px; height: 30px; text-align: center; vertical-align: middle; ">
                        <img src="media/images/plus.png" width=30px height=30px onclick="increment()" style="vertical-align: middle;cursor:pointer;">
                    </div>
                    <div style=" font-size: 20px; margin-top:10px; padding-top: 5px;border: solid white 1px;text-align: center; margin: 7px;">Event Details
                        <div style=" font-size: 17px; margin-right: 5px; margin-top: 10px; ">Performance: <br> <text><?php echo $type ?></text></div>
                        <div style=" font-size: 17px; padding: 5px; margin-right: 5px; margin-top: 5px; ">Location: <br> <text><?php echo $location?></text></div>
                    </div>
                    <div>
                        <div style="font-size: 20px;margin: 10px; margin-top: 15px;">Price: <text id="dynamicPrice"></text></div>
                        <div style="font-size: 20px;margin: 10px; ">Tax: <text id="tax"></text></div>
                        <div style="font-size: 20px;margin: 10px; ">Subtotal: <text id="subtotal"></text></div>
                    </div>
                    <button style="text-align: center; width: 100%; height: 40px; font-size: 20px; cursor: pointer;">Checkout</button>
            </tr>

            <tr>
                <td colspan="2">
                    <label>Email</label>
                    </br>
                    <input type="text" name="email" value="<?php echo $email; ?>">
                    <br />
                    <span class="help-block"><?php echo $email_err . "<br/>"; ?></span>
                </td>
                <td  colspan="2">
                    <fieldset style="height: 55px; padding: 15px; padding-top: 3px;" class="card">
                        <legend>Card Number</legend>
                        <input style = " height: 30px; margin-bottom: 0px; bottom: 30px;" class="none" type='text' name=card_number>
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
                    </select>
                </td>
                <td colspan=2 style = "height: 90px;">
                    <fieldset class="card">
                       
                            <input style = "margin-bottom: 10px;" class="none" type="text" name="cardholder_name" placeholder="Cardholder Name">
                            <br />
                            <span style = " text-align: center; width: 100%;"class="help-block" ><?php echo $cardholder_err . "<br/>"; ?></span>
                            <!--REMEMBER TO CHANGE-->
                        
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
                    <div style = "height: 48px;" class="exp">
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
                    <input class="two" type="text" name="city" value="<?php echo $city; ?>">
                    <br />
                    <span class="help-block"><?php echo $city_err . "<br/>"; ?></span>
                </td>
                <td>
                    <label>Postal Code</label>
                    <br>
                    <input type="text" name="postal_code" value="<?php echo $zip; ?>">
                    <br />
                    <span class="help-block"><?php echo $zip_err . "<br/>"; ?></span>
                </td>

            </tr>
        </table>

        </table>
    </form>
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
