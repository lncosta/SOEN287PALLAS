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
            border: 2px solid lightblue;
            border-radius: 5px;
            text-decoration: none;
            font-style: "Montserrat";
        }
        .booked{
            text-align: center;
            margin-right: auto;
            margin-left: auto;
            width:88%; 
            line-height:40px;
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

        .stars input:checked ~ label {
        color: gold;
        }
        
        .stars label:hover,
        label:hover ~ label {
        color: gold;
        }
        */
      
       .stars  input:checked ~ label:hover,
        input:checked ~ label:hover ~ label {
        color: gold !important;
        }
       

       
    </style>
    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />

    <!--Icons-->
    <script
    src="https://kit.fontawesome.com/ba7a137c00.js"
    crossorigin="anonymous"
    ></script>

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
                        <a class="link" href="performancearchive.php">Performance Gallery</a>
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
        <h2>Special Prices, Just For You!</h2>
        <h2>Your Tickets:</h2>
        <h2>Your Bookings:</h2>
            <table class="booked">
                <tr>
                    <th>Date</th>
                    <th>Booked Acts</th>
                    <th>Optional Services </th>
                    <th>Total Price</th>
                    <th>Event Type</th>
                    <th>Payment Status</th>
                </tr>
                <?php
                    $publiccounter = 0;
                     while($rows = mysqli_fetch_assoc($result)){
                         if($rows['email'] == $_SESSION["email"]){
                        ?>
                            <tr>
                            <td> <?php echo $rows['date']; ?> </td>
                            <td> <?php echo $rows['services']; ?> </td>
                            <td> <?php echo $rows['optionals']; ?> </td>
                            <td> $<?php echo $rows['quote']; ?>.00 </td>
                            <td> <?php echo $rows['eventtype']; ?> </td>
                            <?php 
                                if($rows['eventtype'] == "public"){
                                    $publiccounter++;
                                }
                            ?>
                            <td><?php 
                                if($rows['paidfor']){
                                    echo "Payment Fulfilled";
                                }
                                else{
                                    echo "Payment Pending";
                                }
                            ?>
                            </td>
                           </tr>
                        <?php
                        }
                    }
                ?>

            </table>
            <h3>Add tickets for sale</h3>
            <p>
                <?php
                if($publiccounter > 0){
                    echo "<a href="."addeventsale.php"." class="."btndefault".">Sell Tickets For Your Public Event</a>";
                }
                else
                echo "<a href=\"\" class= \"btndefault\">You have no public events booked</a>";

                ?>
          </p>
        <h2>Your Ticket Sales</h2>
        <h2>Your Reviews:</h2>
        <div id="reviews">
            <button type="button" class="btndefault" onclick="showModal()">Add Review</button>
        </div>
    </div>  
    <p>
        <a href="logout.php" class="btndefault">Sign Out of Your Account</a>
    </p>
        <!-- Modal -->
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
                    <br/>
                    <div class="stars">
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
                    <br/>
                    <label>Write Your Review Below</label>
                    <br/>
                    <br/>
                    <textarea id="userreview" name="userreview" rows=4 cols="50" placeholder="Please add review here"></textarea>
                
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btndefault"/>
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
