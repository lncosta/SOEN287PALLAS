<?php

    include_once('connect.php');
    $query = "SELECT * FROM `generalreviews`";
    $result = mysqli_query($conn, $query);

    while($rows = mysqli_fetch_assoc($result)){
        $rev5 = $rows['r5'];
        $rev4 = $rows['r4'];
        $rev3 = $rows['r3'];
        $rev2 = $rows['r2'];
        $rev1 = $rows['r1'];
    }

    $newquery = "SELECT * FROM `reviews`";
    $newresult = mysqli_query($conn, $newquery);

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
        Yi Heng Yan(40060587)
    -->
    

    <head>
        <meta charset="utf-8" />

        <!--Google Fonts-->
        <!--Luckiest Guy || Montserrat-->
        <link
        href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap"
        rel="stylesheet"
        />
    
        <!--Manual CSS-->
        <link rel="stylesheet" href="styles.css" />
    
        <!--Icons-->
        <script
        src="https://kit.fontawesome.com/ba7a137c00.js"
        crossorigin="anonymous"
        ></script>
    
        <style type="text/css">
        #myEvaluation {
          display:block;
          width: 100%;
          padding: 50px;
          text-align: center;
          background-color: #D8E7FF;
          margin-top: 20px;
          color:rgb(0, 10, 27);
          border-radius: 10px;
          box-shadow: 1px 4px 5px rgba(0,0,0,.3);
        }

        .reviewtable{
            text-align: center;
            margin-right: auto;
            margin-left: auto;
            width:88%; 
            line-height:40px;
        }

        .gallery{
          border-radius: 10px;
          box-shadow: 1px 4px 5px rgba(0,0,0,.3);
          background-image: url("media/images/pattern2.jpg");
          padding: 50px;
          color: white;
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
          background-color: #f1f1f1;
          text-align: center;
          color: white;
        }

        main{
          background-color: white;
          padding-left: 100px;
          padding-right: 100px;
          color: black;
        }


        #bar-5 {width: 60%; height: 18px; background-color: #0080b3;}
        #bar-4 {width: 20%; height: 18px; background-color: #2196F3;}
        #bar-3 {width: 13%; height: 18px; background-color: #00bcd4;}
        #bar-2 {width: 6%; height: 18px; background-color: #0e1c66;}
        #bar-1 {width: 1%; height: 18px; background-color: #490c8f;}

        @media (max-width: 300px) {
          .side, .middle {
            width: 50%;
          }
          /* Hide the right column on small screens */
          .right {
            display: none;
          }
        }

        .btn{
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

        .stars input:checked ~ label {
          color: gold;
        }
       .stars  input:checked ~ label:hover,
        input:checked ~ label:hover ~ label {
          color: gold !important;
        }
    </style>
    <script type="text/javascript">
        //Set up review table:
        var rev5 = parseInt("<?php echo $rev5; ?>");
        var rev4 = parseInt("<?php echo $rev4; ?>");
        var rev3 = parseInt("<?php echo $rev3; ?>");
        var rev2 = parseInt("<?php echo $rev2; ?>");
        var rev1 = parseInt("<?php echo $rev1; ?>");

        var numRev = rev5 + rev4 +rev3 +rev2 + rev1;
        var average = (5*rev5 + 4*rev4 +3*rev3 + 2*rev2 + rev1)/numRev;

        </script>
    </head>

    <body>
      <section class="navbarsection">
               
        <!--NavBar-->
          <div class="interiornav">
            <ul class="navigation">
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

            
  <main>
    <h2>See what the public is saying:</h2>
        <br/>
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
            <hr style="border:3px solid #f1f1f1">

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
        //Set up review table:

        numRev = rev5 + rev4 +rev3 +rev2 + rev1;
        average = (5*rev5 + 4*rev4 +3*rev3 + 2*rev2 + rev1)/numRev;

        document.getElementById("5stars").innerHTML = rev5;
        document.getElementById("4stars").innerHTML = rev4;
        document.getElementById("3stars").innerHTML = rev3;
        document.getElementById("2stars").innerHTML = rev2;
        document.getElementById("1stars").innerHTML = rev1;

        document.getElementById("bar-5").style.width = parseFloat((rev5*100/numRev),10) +'%';
        document.getElementById("bar-4").style.width = parseFloat((rev4*100/numRev),10) +'%';
        document.getElementById("bar-3").style.width = parseFloat((rev3*100/numRev),10) +'%';
        document.getElementById("bar-2").style.width = parseFloat((rev2*100/numRev),10) +'%';
        document.getElementById("bar-1").style.width = parseFloat((rev1*100/numRev),10) +'%';

        document.getElementById("reviewResult").innerHTML = (Math.round(average * 100) / 100) +" average based on "+numRev+" reviews.";
        if (average > 4){
          document.getElementById("r1").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r5").disabled = true;
        }
        else if (average > 3){
          document.getElementById("r2").checked = true;
          document.getElementById("r1").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r5").disabled = true;
        }
        else if (average > 2){
          document.getElementById("r3").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r1").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r5").disabled = true;
        }
        else if (average > 1){
          document.getElementById("r4").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r1").disabled = true;
          document.getElementById("r5").disabled = true;
        }
        else{
          document.getElementById("r5").checked = true;
          document.getElementById("r2").disabled = true;
          document.getElementById("r3").disabled = true;
          document.getElementById("r4").disabled = true;
          document.getElementById("r1").disabled = true;
        }
        </script>
        <div>
        <table class="reviewtable">
                <tr>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Review</th>
                </tr>
                <?php
                     while($newrows = mysqli_fetch_assoc($newresult)){
                        ?>
                            <tr>
                            <td> <?php echo $newrows['fname']; ?> </td>
                            <td> <?php echo $newrows['rating']; ?>/5 </td>
                            <td> <?php echo $newrows['userreview']; ?> </td>
                           </tr>
                        <?php
                    }
                ?>
            </table>
      </div>
      </div>
      <br/>
      <br/>
      <br/>
		  <div align="center" class ="gallery">
                <h1>Entertainment you just can't miss! </h1>
                <br/>
                <!-- Display the first entertainementvideo  -->
                    <h2> Below are videos of past events we participated in:</h2>
                <br/>
                <!-- Display the first entertainementvideo  -->
        <iframe src="https://www.youtube.com/embed/5G8vX9OVbK8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
            
                <!-- Display the second entertainementvideo  -->
        <iframe src="https://www.youtube.com/embed/804uNConaDg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
                <br>
                <h2>Events suited for children!</h2>
                <br/>

                <!-- Display the bubble video  -->
        <iframe id="_ytid_62635" src="https://www.youtube.com/embed/KvBlZENkF5E">https://www.youtube.com/watch?enablejsapi=1&autoplay=0&cc_load_policy=0&iv_load_policy=1&loop=0&modestbranding=0&rel=1&showinfo=1&fs=1&playsinline=0&controls=2&autohide=2&theme=dark&color=red&" class="__youtube_prefs__" title="YouTube player"  allow="autoplay; encrypted-media" allowfullscreen data-no-lazy="1" data-skipgform_ajax_framebjll="">
        </iframe>
                <br/>
                <br/>
                <h2>Here are some photos that will blow your mind!</h2>
                <br/>
        </div>
        <br/>
        <br/>
        <br/>
        <!-- Display downlaodable images  -->
        <div align="center" class="gallery">
          <ul>
          <?php
            $galleryQuery="SELECT id, image_title, image_description, image_name FROM `gallery`";
            $galleryResultSet = mysqli_query($conn, $galleryQuery);
            $x = 1;
            while($rows = mysqli_fetch_array($galleryResultSet ) ) {
              $x +=  1;
              // add a new line
              if ( $x == 3 || $x == 5){
                ?>
                <br/>
                <br/>
                <?php
                }
                ?>
   	            <li>		
		            <a class="image-link" href="http://localhost/image-gallery/uploads/<?php echo $rows["image_name"];?>"><img src="<?php echo $rows["image_name"];?>" width="200px" height="200px"/></a>
                </li>
              <?php
                }
            ?>
           </ul>
        <br/>
        <a href="http://bubble-entertainment.com/wp-content/uploads/2017/05/300x225xIMG_1554-300x225.jpg.pagespeed.ic.8rsIJzV3VT.webp"> <img class="alignnone size-medium wp-image-811" src="http://bubble-entertainment.com/wp-content/uploads/2017/05/300x225xIMG_1554-300x225.jpg.pagespeed.ic.8rsIJzV3VT.webp" alt="IMG 1554 300x225 Welcome to Bubble Entertainment & Shows!" width="300" height="225" srcset="http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1554-300x225.jpg 300w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1554-768x576.jpg 768w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1554-1024x768.jpg 1024w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1554-500x375.jpg 500w" sizes="(max-width: 300px) 100vw, 300px" title="Welcome to Bubble Entertainment & Shows!" />
        <a href="http://bubble-entertainment.com/wp-content/uploads/2017/05/300x225xIMG_2083-2-300x225.jpg.pagespeed.ic.uIbmyr_qu5.webp"> <img class="alignnone size-medium wp-image-1104" src="http://bubble-entertainment.com/wp-content/uploads/2017/05/300x225xIMG_2083-2-300x225.jpg.pagespeed.ic.uIbmyr_qu5.webp" alt="IMG 2083 2 300x225 Welcome to Bubble Entertainment & Shows!" width="300" height="225" srcset="http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_2083-2-300x225.jpg 300w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_2083-2-768x576.jpg 768w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_2083-2-1024x768.jpg 1024w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_2083-2-500x375.jpg 500w" sizes="(max-width: 300px) 100vw, 300px" title="Welcome to Bubble Entertainment & Shows!" pagespeed_url_hash="1451329191" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"/>
        </br/>
        <br/>
        <a href="http://bubble-entertainment.com/wp-content/uploads/2017/05/300x225xIMG_1158-300x225.jpg.pagespeed.ic.dkDdTqdp8-.webp"> <img class="alignnone size-medium wp-image-732" src="http://bubble-entertainment.com/wp-content/uploads/2017/05/300x225xIMG_1158-300x225.jpg.pagespeed.ic.dkDdTqdp8-.webp" alt="IMG 1158 300x225 Welcome to Bubble Entertainment & Shows!" width="300" height="225" srcset="http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1158-300x225.jpg 300w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1158-768x576.jpg 768w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1158-1024x768.jpg 1024w, http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1158-500x375.jpg 500w" sizes="(max-width: 300px) 100vw, 300px" title="Welcome to Bubble Entertainment & Shows!" pagespeed_url_hash="3921839144" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"/>
        <a href="http://bubble-entertainment.com/wp-content/uploads/2019/06/300x300x300x300xIMG_4571-300x300.jpg,Mic.XznKaXwoND.jpg.pagespeed.ic.vFUTBRezIU.webp"> <img class="size-medium wp-image-1466 aligncenter" title="Bienvenue chez Bulles Animations &amp; Spectacles !" src="http://bubble-entertainment.com/wp-content/uploads/2019/06/300x300x300x300xIMG_4571-300x300.jpg,Mic.XznKaXwoND.jpg.pagespeed.ic.vFUTBRezIU.webp" sizes="(max-width: 300px) 100vw, 300px" srcset="http://bubble-entertainment.com/wp-content/uploads/2019/06/IMG_4571-300x300.jpg 300w, http://bubble-entertainment.com/wp-content/uploads/2019/06/IMG_4571-150x150.jpg 150w, http://bubble-entertainment.com/wp-content/uploads/2019/06/IMG_4571-768x768.jpg 768w, http://bubble-entertainment.com/wp-content/uploads/2019/06/IMG_4571-500x500.jpg 500w, http://bubble-entertainment.com/wp-content/uploads/2019/06/IMG_4571-100x100.jpg 100w, http://bubble-entertainment.com/wp-content/uploads/2019/06/IMG_4571.jpg 1000w" alt="300x300xIMG 4571 300x300.jpg.pagespeed.ic.XznKaXwoND Welcome to Bubble Entertainment & Shows!" width="300" height="300" pagespeed_url_hash="1190694800" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"/>
        <br/>
        <br/>
        <a href="http://bubble-entertainment.com/wp-content/uploads/2017/09/300x225xIMG_1227-300x225.jpg.pagespeed.ic.zvoFu6RsIF.webp"> <img class="alignnone size-medium wp-image-634" src="http://bubble-entertainment.com/wp-content/uploads/2017/09/300x225xIMG_1227-300x225.jpg.pagespeed.ic.zvoFu6RsIF.webp" alt="IMG 1227 300x225 Welcome to Bubble Entertainment & Shows!" width="300" height="225" srcset="http://bubble-entertainment.com/wp-content/uploads/2017/09/IMG_1227-300x225.jpg 300w, http://bubble-entertainment.com/wp-content/uploads/2017/09/IMG_1227-768x576.jpg 768w, http://bubble-entertainment.com/wp-content/uploads/2017/09/IMG_1227-1024x768.jpg 1024w, http://bubble-entertainment.com/wp-content/uploads/2017/09/IMG_1227-500x375.jpg 500w" sizes="(max-width: 300px) 100vw, 300px" title="Welcome to Bubble Entertainment & Shows!" pagespeed_url_hash="880034947" onload="pagespeed.CriticalImages.checkImageForCriticality(this);"/>
        </a>
        </br>
        </div>

        <br/>
        
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
