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
    This page displays events with tickets for sale. 
*/


include_once('connect.php');
$query = "SELECT * FROM `upcoming events`";
$result = mysqli_query($conn, $query);
//echo "<br/>Success2";

$date = "";

if (array_key_exists('button', $_POST)) {
  // echo "This is the date: ".$_POST['date'];

  session_start();
  $_SESSION['date'] = $_POST['date'];
  $_SESSION['location'] = $_POST['location'];
  $_SESSION['eventprice'] = $_POST['price'];
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
  <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

  <!--Manual CSS-->
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="Sales.css" />

  <!--Icons-->
  <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

  <style>
    input {
      font-size: 1.05em;
      font-family: "Montserrat";
      font-size: 1.05;
      border: 2px solid grey;
      border-radius: 5px;

    }

    button {
      background-color: lightblue;
      border: 5px solid lightblue;
      border-radius: 5px;
      font-size: 1.05em;


    }

    .odd {
      background-image: url("media/images/Pattern.jpg");
      text-align: center;
      color: white;
    }

    .even {
      text-align: center;
      border: solid rgba(123, 193, 250, 0.726) 2px;
    }

    .buy {
      padding-left: 4px;
      padding-right: 4px;
      transition: 1s;
    }

    .buy:hover {
      background-image: url("media/images/Pattern.jpg");
      color: white;
      border: none;
      border-radius: 5px;
    }

    .eventstable {

      text-align: center;
      padding: 20px;
      width: 90%;
      table-layout: auto;
    }

    td {
      padding: 10px;
    }
  </style>


</head>

<body>

  <?php include("navbar.php"); ?>
  <section>
    <table class="eventstable">
      <tr>
        <th> Date </th>
        <th> Event Location </th>
        <th> Event Price </th>
        <th> Entertainment Type </th>
      </tr>

      <?php
      while ($rows = mysqli_fetch_assoc($result)) { //Fetches events which have tickets for sale

        if ($rows['EventDate'] >= date("Y-m-d")) { //Displays events happening today or in the future

      ?>

          <tr>
            <form method="post">
              <td> <input class="odd" type="text" id="date" name="date" value="<?php echo $rows['EventDate']; ?>" readonly> </td>
              <td> <input class="even" type="text" id="location" name="location" value="<?php echo $rows['EventLocation']; ?>" readonly> </td>
              <td> <input class="odd" type="text" id="price" name="price" value="<?php echo $rows['EventPrice'] . "$"; ?>" readonly> </td>
              <td> <input class="even" type="text" id="type" name="type" value="<?php echo $rows['EntertainmentType']; ?>" readonly> </td>
              <td><button class="buy" type="submit" name="button" value="button">Buy Tickets</button></td>
            </form>


          </tr>

      <?php

        }
      }

      ?>

    </table>
  </section>

  <p><br /><br /></p>

  <section class="artists">
    <div>
      <h2 class="OurArtists">Our Performers</h2>
    </div>
    <div class="products-grid">
      <article class="products">

        <div class="image">
          <img class="ArtistImages" src="media/images/contortion.jpg" alt="Contortionist">
        </div>

        <h3>Sabrina - Contortionist</h3>

      </article>
      <article>
        <div class="image">
          <img class="ArtistImages" src="media/images/Cirque.jpg" alt="Cirque du Soleil">
        </div>
        <h3>The Amazing Trapeze Team</h3>

      </article>
      <article>
        <div class="image">
          <img class="ArtistImages" src="media/images/fire.jpg" alt="Fire">
        </div>
        <h3>Gabriel - Fire Breather</h3>
      </article>
      <article>
        <div class="image">
          <img class="ArtistImages" src="media/images/Bubbles.png" alt="Bubbles">
        </div>
        <h3>Florian - Bubble Art and Juggling</h3>
      </article>
      <article>
        <div class="image">
          <img class="ArtistImages" src="media/images/magician.jpg" alt="Magician">

        </div>
        <h3>Andrew - Magic and Illusions</h3>
      </article>
      <article>
        <div class="image">
          <img class="ArtistImages" src="media/images/GuitarPlayer.jpg" alt="Guitar">
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
