<?php
// Initialize the session
session_start();

if (isset($_SESSION["mainpage_discount"])) { //Retrieves discount if user accessed page through home page buttons.
    $discount = $_SESSION["mainpage_discount"];
} else {
    $discount = 0;
}

//Fetching the booked dates from database:
include_once('connect.php');
$query = "SELECT * FROM `quoteform`";
$result = mysqli_query($conn, $query);

$datesBooked = array();
while ($rows = mysqli_fetch_assoc($result)) { //Creates an array containing all dates that are already booked. 
    array_push($datesBooked, $rows['date']);
}
?>
<!DOCTYPE html>
<html>
<!--SOEN 287 Group Project
        Team 8 - PALLAS Entertainment
        Team members:
        Florian Charreau (26494889) 
        Piyush Goyal(40106759) 
        Aline Kurkdjian (40131528)
        Joseph Mezzacappa(40134799)
        Luiza Nogueira Costa (40124771)
        Yi Heng Yan (40060587)
        This page allows the user to request a quote estimation and book an event. 
    -->

<head>
    <style type="text/css">
        body {
            background-color: #fff;
            text-align: center;
        }

        footer {
            background-color: #fff;
        }

        main {
            padding: 20px;
            font-size: 1.1em;
        }

        .colortext {
            font-size: 2em;
            color: lightcyan;
        }

        form {
            font-size: 1.05em;
            font-family: "Montserrat";
        }

        select {
            border-radius: 10px;
            border: 2px solid whitesmoke;
            font-size: 1.05em;
            font-family: "Montserrat";
        }

        .quote {
            color: white;
            background-image: url(media/images/pattern2.jpg);
            border-radius: 5px;
            text-align: left;
            padding: 20px;
            margin: 0 auto;
            width: 65%;
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .3);
        }

        .item {
            padding-left: 30px;
        }

        input,
        textarea {
            border-radius: 10px;
            font-size: 1em;
            border: 2px solid whitesmoke;
            font-family: "Montserrat";
        }

        textarea {
            width: 100%;
        }


        .submitbutton {
            border-radius: 10px;
            border: 2px solid whitesmoke;
            font-size: 1.1em;
            font-family: "Montserrat";
        }

        .close {
            text-align: right;
        }

        .modal-title {
            color: black;
        }

        td.tdclosebutton {
            margin-left: 2em;
        }

        .red,
        .ui-datepicker .red span {
            background: none #ff4751;
            border: 1px solid #BF5A0C;
        }
    </style>
    <script type="text/javascript">
        // Get the modal

        // When the user clicks on the button, open the modal
        function showModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        function getQuote() { //Quote calculation based on form selections.
            var totalQuote = 0;

            var eventType = document.getElementById("eventtypes").value;
            var priceMultiplier = 1;
            if (eventType == "intimate") { //Adds multiplier depending on event size.
                priceMultiplier = 1;
            } else if (eventType == "medium") {
                priceMultiplier = 2;
            } else if (eventType == "large") {
                priceMultiplier = 3;
            } else if (eventType == "public") {
                priceMultiplier = 4;
            }
            var performancesMultiplier = 55;
            var counter = 0;
            //Adding multiplier based on performances selected:
            if (document.getElementById("abubbles").checked == true) {
                performancesMultiplier += 10;
                counter++;
            }
            if (document.getElementById("acontorsion").checked == true) {
                performancesMultiplier += 10;
                counter++;
            }
            if (document.getElementById("amagic").checked == true) {
                performancesMultiplier += 10;
                counter++;
            }
            if (document.getElementById("amusic").checked == true) {
                performancesMultiplier += 10;
                counter++;
            }
            //Total quote calculation:
            totalQuote = priceMultiplier * performancesMultiplier;
            if (document.getElementById("bgreeting").checked == true) {
                totalQuote += 100;
            }
            if (document.getElementById("bkids").checked == true) {
                totalQuote += 500;
            }
            if (document.getElementById("bmc").checked == true) {
                totalQuote += 500;
            }
            if (counter == 0) { //Generates alert if no performances were selected.
                alert("Please select one of our performances before proceeding.");
            } else { //Else, adds discount (if there is one) and displays final quote.
                var discount = <?php echo $discount; ?>;
                totalQuote = totalQuote - discount;
                document.getElementById("quoteRequestResult").innerHTML = "The total quote for your event is estimated to be $" + totalQuote + ".00";
                document.getElementById("quote").value = totalQuote;

                showModal(); //Shows modal.
            }
        }

        function validateForm() { //Validates that no form fields are empty.
            if (document.getElementById("fname").value == "") {
                return false;
            }
            if (document.getElementById("lname").value == "") {
                return false;
            }
            if (document.getElementById("email").value == "") {
                return false;
            }
            if (document.getElementById("phone").value == "") {
                return false;
            }
            if (document.getElementById("eventdate").value == null) {
                return false;
            }
            return true;
        }

        function reviewForm() {
            if (validateForm()) {
                getQuote();
            } else {
                alert("Please make sure that all form elements are filled adequately.");
            }
        }

        function submitQuote() { //Submits form only if it passes all client-side checks.
            document.forms["myform"].submit();
            alert("Quote has been sumitted");
        }

        function payNow() {
            //Submits form only if it passes all client-side checks, submits with pay now discount. 
            document.getElementById("quote").value = 0.9 * parseInt(document.getElementById("quote").value);
            document.forms["myform"].action = "saveformpaynow.php";
            document.forms["myform"].submit();
            alert("Quote has been sumitted");

        }
    </script>

    <meta charset="utf-8" />

    <script type="text/javascript" src="script.js"></script>

    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

    <!--JQuery for booking calendar -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() { //Datepicker for showing only available dates on calendar. 
            var pickerOptions = {
                dateFormat: "yy-mm-dd",
                beforeShowDay: function(date) {
                    var enableDays = <?php echo json_encode($datesBooked); ?>;
                    var formattedDate = jQuery.datepicker.formatDate("yy-mm-dd", date);
                    if (enableDays.indexOf(formattedDate) == -1) {
                        return [true, 'green'];
                    } else {
                        return [false, 'red'];
                    }
                }
            };
            $("#eventdate").datepicker(pickerOptions);
        });
    </script>
</head>

<body>
    <?php include("navbar.php"); ?>
    <main>
        <h2>Contact us!</h2>
        <h3>Fill in the form below for a quote estimation, or send us a message in one of our many channels.</h3>

        <div class="quote">
            <!--Quote form-->
            <form id="myform" action="saveform.php" method="post">
                <table>
                    <tr>
                        <td>
                            <label>Name:</label>
                        </td>
                        <td class="item">
                            <input type="text" id="fname" name="fname" placeholder="First Name" />
                            <input type="text" id="lname" name="lname" placeholder="Last Name" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email Address:</label>
                        </td>
                        <td class="item">
                            <input type="text" id="email" name="email" placeholder="email@address.com" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Phone Number:</label>
                        </td>
                        <td class="item">
                            <input type="number" id="phone" name="phone" placeholder="123-456-7890" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Event Date:</label>
                            <!--Check if available-->
                        </td>
                        <td class="item">
                            <input type="text" name="date" id="eventdate" placeholder="dd/mm/yyyy" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Event Type:</label>
                        </td>
                        <td class="item">
                            <select name="eventtype" id="eventtypes">
                                <option value="intimate">Intimate</option>
                                <option value="medium">Medium</option>
                                <option value="large">Large</option>
                                <option value="public">Public</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Budget:</label>
                        </td>
                        <td class="item">
                            <input type="number" id="budget" name="budget" min="1" step="any" placeholder="$$$.$$" />
                        </td>
                    </tr>
                </table>
                <br />
                <label>Check which of our acts you want us to perform:</label>
                <br />
                <label><input type="checkbox" name="performances[]" id="abubbles" value="Bubbles" /> Bubble Blowing</label>
                <br />
                <label><input type="checkbox" name="performances[]" id="acontorsion" value="Contorsion" /> Contorsion</label>
                <br />
                <label><input type="checkbox" name="performances[]" id="amagic" value="Magic" /> Magic Show</label>
                <br />
                <label><input type="checkbox" name="performances[]" id="amusic" value="Music" /> Musical Performance</label>
                <br />
                <br />
                <label>Optional Services:</label>
                <br />
                <label><input type="checkbox" name="options[]" id="bgreeting" value="PersonalizedGreeting" /> Personalized Greeting </label>
                <br />
                <label><input type="checkbox" name="options[]" id="bkids" value="KidsSpecialPackage" /> Kids Special Package</label>
                <br />
                <label><input type="checkbox" name="options[]" id="bmc" value="MC" /> MC - Master of Cerimonies</label>
                <br />
                <br />
                <label>Additional Information:</label>
                <br />
                <textarea id="addinfo" name="message" rows=4 cols="50" placeholder="Please add any additional requests or considerations here"></textarea>
                <br />
                <br />
                <input type="hidden" name="quote" id="quote" value="" />
                <button type="button" name="submitForm" onclick="reviewForm()" class="submitbutton">Request Quote </button>
                <input type="reset" class="submitbutton">
            </form>
            <br />
            <br />
        </div>
        <!-- Modal -->
        <div class="modal-div" id="myModal">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <table>
                            <tr>
                                <td>Quote Request:</td>
                                <td class="tdclosebutton"><button type="button" id="close" class="close" onclick="closeModal()">&times;</button></td>
                            </tr>
                        </table>
                    </h4>
                </div>
                <div class="modal-body">
                    <p id="quoteRequestResult">Your estimated quote is: .</p>
                    <p>Book now and receive a 10% discount! Otherwise, we will get back to you in 5 business days.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" name="submitForm2" class="submitbutton" onclick="payNow()">Book Now!</button>
                    <button type="button" name="submitForm" class="submitbutton" onclick="submitQuote()">Request Quote via Email and Close.</button>
                </div>
            </div>
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
