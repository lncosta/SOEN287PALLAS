<!--SOEN 287 Group Project
        Team 8 - PALLAS Entertainment
        Team members:
        Florian Charreau (26494889) 
        Piyush Goyal(40106759) 
        Aline Kurkdjian (40131528)
        Joseph Mezzacappa(40134799)
        Luiza Nogueira Costa (40124771)
        Yi Heng Yan(40060587)
-->
<?php

include_once('connect.php');
$query = "SELECT * FROM `generalreviews`";
$result = mysqli_query($conn, $query);
//Connects to database and retrives general review information:
while ($rows = mysqli_fetch_assoc($result)) { //Assigns number of each review type to a variable.
  $rev5 = $rows['r5'];
  $rev4 = $rows['r4'];
  $rev3 = $rows['r3'];
  $rev2 = $rows['r2'];
  $rev1 = $rows['r1'];
}
//Retrives reviews submitted by the users from another table:
$newquery = "SELECT * FROM `reviews`";
$newresult = mysqli_query($conn, $newquery);

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

  <!--Icons-->
  <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

  <style type="text/css">
    #myEvaluation {
      display: block;
      width: 100%;
      padding: 50px;
      text-align: center;
      background-color: #D8E7FF;
      background-image: url("media/images/pattern2.jpg");
      margin-top: 20px;
      /*color: rgb(0, 10, 27);*/
      color: white;
      border-radius: 10px;
      box-shadow: 1px 4px 5px rgba(0, 0, 0, .3);
    }

    #myEvaluation p {
      color: white;
    }

    .reviewtable {
      text-align: center;
      margin-right: auto;
      margin-left: auto;
      width: 88%;
      line-height: 40px;
      overflow: hidden;
      overflow-y: scroll;
      height: 200px;
    }

    .reviewtable table {
      min-width: 88%;
      width: 88%;
    }
    .reviewtable td{
      padding: 10px;
      vertical-align: top;
    }

    .gallery {
      border-radius: 10px;
      box-shadow: 1px 4px 5px rgba(0, 0, 0, .3);
      background-image: url("media/images/pattern2.jpg");
      padding: 50px;
      color: white;
      text-align: center;
      overflow-y: scroll;
      height: 600px;
    }

    .gallery-list {
      list-style-type: none;
    }

    .checked {
      color: orange;
    }

    * {
      box-sizing: border-box;
    }

    .heading {
      font-size: 25px;
      margin-right: 25px;
    }

    .fa {
      font-size: 25px;
    }

    .checked {
      color: orange;
    }

    .side {
      float: left;
      width: 15%;
      margin-top: 10px;
    }

    .middle {
      float: left;
      width: 70%;
      margin-top: 10px;
    }

    .right {
      margin-top: 0px;
      text-align: left;
      padding-left: 10px;
      padding-top: 0;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    .bar-container {
      width: 100%;
      background-image: url("media/images/pattern.jpg");
      text-align: center;
      color: white;
    }

    main {
      background-color: white;
      padding-left: 100px;
      padding-right: 100px;
      color: black;
    }


    #bar-5 {
      width: 60%;
      height: 18px;
      background-color: #97E3EF;
    }

    #bar-4 {
      width: 20%;
      height: 18px;
      background-color: #7FA5FF;
    }

    #bar-3 {
      width: 13%;
      height: 18px;
      background-color: #D89AFC;
    }

    #bar-2 {
      width: 6%;
      height: 18px;
      background-color: #FC9AEB;
    }

    #bar-1 {
      width: 1%;
      height: 18px;
      background-color: #FF9AB5;
    }

    @media (max-width: 300px) {

      .side,
      .middle {
        width: 50%;
      }

      /* Hide the right column on small screens */
      .right {
        display: none;
      }
    }

    .btn {
      background-color: white;
      border: 5px solid white;
      border-radius: 5px;
      font-size: 1.05em;
    }

    .stars {
      display: inline-block;
      font-size: 2em;
    }

    .stars * {
      float: right;
    }

    .stars input {
      display: none;
    }

    .stars label {
      font-size: 2em;
      text-shadow: 2px 1px orange;
    }

    .stars input:checked~label {
      color: gold;
    }

    .stars input:checked~label:hover,
    input:checked~label:hover~label {
      color: gold !important;
    }

    .image {
      padding: 50px;
      width: 50%;
    }
  </style>
  <script type="text/javascript">
    //Set up review table by displaying data from database:
    var rev5 = parseInt("<?php echo $rev5; ?>"); //Number of 5 star reviews...
    var rev4 = parseInt("<?php echo $rev4; ?>");
    var rev3 = parseInt("<?php echo $rev3; ?>");
    var rev2 = parseInt("<?php echo $rev2; ?>");
    var rev1 = parseInt("<?php echo $rev1; ?>"); //Number of 1 star reviews.

    var numRev = rev5 + rev4 + rev3 + rev2 + rev1; //Total number of reviews.
    var average = (5 * rev5 + 4 * rev4 + 3 * rev3 + 2 * rev2 + rev1) / numRev; //Review average.
  </script>
</head>

<body>
  <?php include("navbar.php"); ?>

  <main>
    <h2>See what the public is saying:</h2>
    <br />
    <!-- Display the evaluations bars  -->
    <div id="myEvaluation">
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

      <p id="reviewResult"></p>
      <!--Shows number of reviews for each rating, taken from database-->
      <div class="row">
        <div class="side">
          <div>5 star</div>
        </div>
        <div class="middle">
          <div class="bar-container">
            <div id="bar-5"></div>
          </div>
        </div>
        <div class="side right">
          <p id="5stars"><?php echo $rev5; ?></p>
        </div>
        <div class="side">
          <div>4 star</div>
        </div>
        <div class="middle">
          <div class="bar-container">
            <div id="bar-4"></div>
          </div>
        </div>
        <div class="side right">
          <p id="4stars"><?php echo $rev4; ?></p>
        </div>
        <div class="side">
          <div>3 star</div>
        </div>
        <div class="middle">
          <div class="bar-container">
            <div id="bar-3"></div>
          </div>
        </div>
        <div class="side right">
          <p id="3stars"><?php echo $rev3; ?></p>
        </div>
        <div class="side">
          <div>2 star</div>
        </div>
        <div class="middle">
          <div class="bar-container">
            <div id="bar-2"></div>
          </div>
        </div>
        <div class="side right">
          <p id="2stars"><?php echo $rev2; ?></p>
        </div>
        <div class="side">
          <div>1 star</div>
        </div>
        <div class="middle">
          <div class="bar-container">
            <div id="bar-1"></div>
          </div>
        </div>
        <div class="side right">
          <p id="1stars"><?php echo $rev1; ?></p>
        </div>
      </div>

      <script type="text/javascript">
        //Modifies review table based on database information:

        numRev = rev5 + rev4 + rev3 + rev2 + rev1;
        average = (5 * rev5 + 4 * rev4 + 3 * rev3 + 2 * rev2 + rev1) / numRev;

        //Sets the progress bar based on percentage of each review type:
        document.getElementById("bar-5").style.width = parseFloat((rev5 * 100 / numRev), 10) + '%';
        document.getElementById("bar-4").style.width = parseFloat((rev4 * 100 / numRev), 10) + '%';
        document.getElementById("bar-3").style.width = parseFloat((rev3 * 100 / numRev), 10) + '%';
        document.getElementById("bar-2").style.width = parseFloat((rev2 * 100 / numRev), 10) + '%';
        document.getElementById("bar-1").style.width = parseFloat((rev1 * 100 / numRev), 10) + '%';

        //Calculates average review and sets star display (disabled radio buttons) to reflect that amount:
        document.getElementById("reviewResult").innerHTML = (Math.round(average * 100) / 100) + " average based on " + numRev + " reviews.";
        if (average > 4) {
          document.getElementById("r1").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r5").disabled = true;
        } else if (average > 3) {
          document.getElementById("r2").checked = true;
          document.getElementById("r1").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r5").disabled = true;
        } else if (average > 2) {
          document.getElementById("r3").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r1").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r5").disabled = true;
        } else if (average > 1) {
          document.getElementById("r4").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r1").disabled = true;
          document.getElementById("r5").disabled = true;
        } else {
          document.getElementById("r5").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r1").disabled = true;
        }
      </script>
      <div class="reviewtable">
        <table>
          <tr>
            <th>Name</th>
            <th>Rating</th>
            <th>Review</th>
          </tr>
          <?php
          while ($newrows = mysqli_fetch_assoc($newresult)) { //Fetches user reviews from database and displays them in a table format:
            if ($newrows['rating'] >= 4) { //Only displays reviews of 4 stars and above.
          ?>
              <tr>
                <td> <?php echo $newrows['fname']; ?> </td>
                <td> <?php echo $newrows['rating']; ?>/5 </td>
                <td> <?php echo $newrows['userreview']; ?> </td>
              </tr>
          <?php
            }
          }
          ?>
        </table>
      </div>
    </div>
    <br />
    <br />
    <br />
   <div class="gallery">
      <h1>Entertainment you just can't miss! </h1>
      <br />
      <!-- Display the title for video sectionementvideo  -->
      <h2> Below are videos of past events we participated in:</h2>
      <br />
      <!-- Display all the videos from the videogallery table  -->
        <?php
        $videogalleryQuery = "SELECT id, video_title, video_description, video_source FROM `videogallery`"; //Fetches video sources from database.
        $videogalleryResultSet = mysqli_query($conn, $videogalleryQuery);  // connect to database and run the query
         // loop to display the videos 
		 while ($rows = mysqli_fetch_array($videogalleryResultSet)) { //Displays images, each in a new line.
        ?>
	  <iframe src="<?php echo $rows["video_source"]; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
      </iframe>
	  <?php
        }
        ?>
      <br />
      <br />

    </div>
    <br />
    <br />
    <br />
    <!-- Display images  -->
    <div class="gallery">
      <h2>Here are some photos that will blow your mind!</h2>
      <br />
      <ul class="gallery-list">
        <?php
        $galleryQuery = "SELECT id, image_title, image_description, image_name FROM `gallery`"; //Fetches images from database.
        $galleryResultSet = mysqli_query($conn, $galleryQuery);
        $x = 1;
        while ($rows = mysqli_fetch_array($galleryResultSet)) { //Displays images, each in a new line.
        ?>
          <li>
            <a class="image-link" href="<?php echo $rows["image_name"]; ?>"><img class="image" src="<?php echo $rows["image_name"]; ?>" /></a>
          </li>
        <?php
        }
        ?>
      </ul>
      <br />
    </div>
    <br />
  </main>
  <!-- Display the footer section  -->

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
