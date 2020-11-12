<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "demo");
 
// Check connection
if($link === false){
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
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
// Close connection
mysqli_close($link);
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
        .mail{
            margin: 20px;
            padding: 20px;
            text-align: left;
            border: 2px solid blue;
        }
        .btn{
            background-color: crimson;
            border: 5px solid crimson;
            border-radius: 5px;
            color: black;

        }
        .btn a{
            color: black;

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
        <br/>
        <h1>Hi, <b><?php echo $param_fname ?></b>. Your quote estimation has been sent to your email. Here is a summary of your request:</h1>
    </div>
    <br/>
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
        <h2>Your Quote: $<b><?php echo $param_quote ?>.00</b></h2>
    </div>  
    <p>
        <a href="mainpage.html" class="btn">Return to Home Page</a>
    </p>
</body>
</html>
