<?php


    include_once('connect.php');
    $query = "SELECT * FROM `upcoming events`";
    $result = mysqli_query($conn, $query);
    //echo "<br/>Success2";

    $date ="";

    if(array_key_exists('button', $_POST)){
     // echo "This is the date: ".$_POST['date'];

      session_start();
      $_SESSION['date'] = $_POST['date'];
      $_SESSION['location'] = $_POST['location'];
      $_SESSION['price'] = $_POST['price'];
      $_SESSION['type'] = $_POST['type'];
      header('Location: checkout.php');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
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

    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css" />
    <link rel = "stylesheet" href = "Sales.css"/>

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

    <style>
        
        
        .odd{
          background-image: url("media/images/Pattern.jpg");
          text-align: center;
          color: white;
        }
        .even{
          text-align: center;
          border: solid rgba(123, 193, 250, 0.726) 2px;
        }
        .buy{
          padding-left: 4px;
          padding-right: 4px;
          transition: 1s;
        }
        .buy:hover{
          background-image: url("media/images/Pattern.jpg");
         color:white;
        }
        .eventstable{
         
          text-align: center;
          padding: 20px;
          width:90%;
          table-layout: auto;
        }
        td{
          padding: 10px;
        }
        
        </style>


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

      <p><br/></p>


    <section>
      <table class="eventstable">
          <tr>
            <th> Date </th>
            <th> Event Location </th>
            <th> Event Price </th>
            <th> Entertainment Type </th>
          </tr>

          <?php
          while($rows = mysqli_fetch_assoc($result)){

            if($rows['EventDate'] >= date("Y"."-"."m"."-"."d")){

            ?>

            <tr>
              <form method = "post">
              <td> <input class = "odd" type = "text" id = "date" name = "date" value ="<?php echo $rows['EventDate']; ?>" readonly> </td>
              <td> <input class = "even" type = "text" id = "location" name = "location" value ="<?php echo $rows['EventLocation']; ?>" readonly> </td>
              <td> <input class = "odd" type = "text" id = "price" name = "price" value ="<?php echo $rows['EventPrice']; ?>" readonly>$ </td>
              <td> <input class = "even" type = "text" id = "type" name = "type" value ="<?php echo $rows['EntertainmentType']; ?>" readonly> </td>
              <td><button class = "buy" type="submit" name="button" value = "button">Buy Tickets</button></td>
              </form>


            </tr>

            <?php

             }
            }

    ?>

  </table>
  </section>

<p><br/><br/></p>

<section class = "artists">
        <div><h2 class = "OurArtists">Our Performers</h2></div>
        <div class = "products-grid">
            <article class = "products">
                
                <div class = "image">
                    <img class = "ArtistImages"  src = "media/images/contortion.jpg" alt = "Contortionist" >
                </div>
            
                <h3>Sabrina - Contortionist</h3>
                
            </article>
            <article>
                <div class = "image">
                    <img class = "ArtistImages"  src = "media/images/Cirque.jpg" alt = "Cirque du Soleil" >            
                </div>
                <h3>The Amazing Trapeze Team</h3>
                
            </article>
            <article>
                <div class = "image">
                    <img class = "ArtistImages"  src = "media/images/fire.jpg" alt = "Fire" >   
                </div>
                <h3>Gabriel - Fire Breather</h3>
            </article>
            <article>
                <div class = "image">
                    <img class = "ArtistImages"  src = "media/images/Bubbles.png" alt = "Bubbles" >       
                </div>
                <h3>Florian - Bubble Art and Juggling</h3>
            </article>
            <article>
                <div class = "image">
                    <img class = "ArtistImages"  src = "media/images/magician.jpg" alt = "Magician" > 
                         
                </div>
                <h3>Andrew - Magic and Illusions</h3>
            </article>
            <article>
              <div class = "image">
                  <img class = "ArtistImages"  src = "media/images/GuitarPlayer.jpg" alt = "Guitar" >
              </div>
              <h3>Steven - Musician</h3>
          </article>
        </div>
    </section>
      <!-- Footer -->
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
