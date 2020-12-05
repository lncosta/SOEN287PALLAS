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

        <style type="text/css">

          main{
            padding: 20px;
            margin: 10px;
          }
          .bubbles{
            margin: 20px;
            padding: 10px;
            color: white;
            border-radius: 8px;
            background-image: url("media/images/pattern.jpg");
            border-radius: 10px;
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .3);
          }
          .contorsion{
            margin: 20px;
            padding: 10px;
   
            border-radius: 5px;
            background-image: url("media/images/pattern.jpg");
            border-radius: 10px;
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .3);
          }
          .magic{
            margin: 20px;
            padding: 10px;
      
            border-radius: 5px;
            background-image: url("media/images/pattern.jpg");
            border-radius: 10px;
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .3);
          }
          .music{
            margin: 20px;
            padding: 10px;
     
            border-radius: 5px;
            background-image: url("media/images/pattern.jpg");
            border-radius: 10px;
            box-shadow: 1px 2px 4px rgba(0, 0, 0, .3);
          }
         .white{
            color: white;
          }
          
        </style>
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
    

    </head>

    <body>
     <?php include("navbar.php"); ?>
            <main>
                <br/>
                <h2>Who we are:</h2>
                <p>PALLAS Entertainment is made of the stuff of dreams.</p>
                <p>We are a Montreal-based entertainment company that provides acts and performances to bring life to events big and small.</p>
                <p>The name Pallas is the given epithet of Ancient Greek goddess Athena, associated with wisdom and handicraft.</p>
                <h2>Meet our performers!</h2>
                <div class="bubbles">
                  <h3>Florian - Bubble Art and Juggling</h3>
                  <br/>
                  <br/>
                  <p class = "white">My name is Florian and I have been practicing different types of juggling and bubble art and science for almost 15 years.</p>
                  <img src="http://bubble-entertainment.com/wp-content/uploads/2017/06/Flo-Bulle42w-300x200.png" alt="Florian" width = "25%" height = "25%">
                  <br/>
                  <br/>
                  <p class = "white">Regarding my juggling skills, I focus on gyroscopic juggling being a type of object manipulation using objects spinning around an axis, such as the diabolo and the devil stick.</p>
                  <p class = "white">There is also bubble art and science which consists in manipulating soap bubbles. Basically, a soap bubble is made up of three layers, being a layer of water between two layers of soap. Soap bubbles tend to become spherical no matter what their original shape was, and this can be explained due to the fact that they want to minimize their surface area. With this last property we can understand that when two soap bubbles meet, they will merge and a wall will appear.</p>
                  <p class = "white">Consequently, with those principles we can create a countless number of visual effects.</p>
                </div>
                <div class="contorsion">
                  <h3 class = "white">Sabrina - Contorsion </h3>
                  <br/>
                  <br/>
                  <p class = "white">My name is Sabrina and I have been a contorsionist since I was ten.</p>
                  <img src="media/images/contortion.jpg" alt="Sabrina" width="25%" height="25%"/>
                  <!--Image source: https://www.flickr.com/photos/85128884@N00/4887329420/in/photostream/-->
                  <br/>
                  <br/>
                  <p class = "white">I started my career in rythmic gymnastics, then transitioned into more circus-oriented activities in my early teens. I enjoy combining music, visuals, and athleticism into my performances.</p>
                </div>
                <div class="magic">
                  <h3 class = "white">Andrew - Magic and Illusions </h3>
                  <br/>
                  <br/>
                  <p class = "white">Greetings! I am Andrew, master of illusions.</p>
                  <img src="media/images/magician.jpg" alt="Andrew" width="25%" height="25%"/>
                  <!--Image source: https://www.needpix.com/photo/1841513/magician-letters-magic-top-hat-poker-hand-surprise-card-cards-->
                  <br/>
                  <br/>
                  <p class = "white">Specialized in Children's Magic and Parlour Illusions. I have already participated in several courses in Theater, Magic, Hypnosis, Storytelling, as well as performed in over 7000 events nation-wide!</p>
                </div>
                <div class="music">
                  <h3 class = "white">Steven - Musician </h3>
                  <br/>
                  <br/>
                  <p class = "white">Well, hi! I'm Steven, professional melody creator.</p>
                  <img src="media/images/GuitarPlayer.jpg" alt="Andrew" width="30%" height="30%"/>
                  <br/>
                  <br/>
                  <p class = "white">I am the person to call for all your musical needs. Singing, guitar, cello, drumming, or even DJ-ing - you name the instrument, and I will play it!</p>
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
