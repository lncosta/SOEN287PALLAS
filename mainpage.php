<?php
include_once('connect.php');
//Retrives reviews submitted by the users from another table:
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
    <title>PALLAS Entertainment</title>

    <!--Google Fonts-->
    <!--Luckiest Guy || Montserrat-->
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet" />

    <!--Manual CSS-->
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>" />

    <!--Icons-->
    <script src="https://kit.fontawesome.com/ba7a137c00.js" crossorigin="anonymous"></script>

    <style type="text/css">
        .large-button {
            padding: .5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: .3rem;
        }

        button {
            background-color: #343a40;
            border: 1px solid #343a40;
            color: white;
            padding: .5rem 1rem;
            font-size: 1.25rem;
            line-height: 1.5;
            border-radius: .3rem;
        }

        button:hover {
            background-color: black;
        }

        .fit-button {
            display: block;
            width: 100%;
        }

        .colored-section {
            padding: 20px;
        }
    </style>
    <script type="text/javascript">
        var slideIndex = [1, 1];
        var slideId = ["mySlide1", "mySlide2"]
        showSlides(1, 0);
        showSlides(1, 1);

        function plusSlides(n, no) {
            showSlides(slideIndex[no] += n, no);
        }

        function showSlides(n, no) {
            var i;
            var x = document.getElementsByClassName(slideId[no]);
            if (n > x.length) {
                slideIndex[no] = 1
            }
            if (n < 1) {
                slideIndex[no] = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex[no] - 1].style.display = "block";
        }
    </script>

</head>

<body>
    <?php include("navbar.php");?>
    <section class="colored-section" id="title">
        <div class="container">
            <div class="grid-row">
                <div class="column-large">
                    <h1 class="big-heading">
                        Making your Celebrations - Amazing and Perfect.
                    </h1>
                </div>
                <div class="column-large">
                    <img class="title-image" src="http://bubble-entertainment.com/wp-content/uploads/2017/05/IMG_1554-300x225.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <!--Gathering-->
    <section class="white-section" id="gatherings">
        <div class="container">
            <h2 class="section-heading">Make Lifetime Memories</h2>
            <div class="container">
                <div class="grid-row">
                    <div class="column gathering-box">
                        <i class="gathering-icon fas fa-birthday-cake fa-4x"></i>
                        <h3 class="gathering-title">Birthday Parties</h3>
                        <p>Theme Based Birthday Parties with gathering up to 50 People.</p>
                    </div>

                    <div class="column gathering-box">
                        <i class="gathering-icon fas fa-gifts fa-4x"></i>
                        <h3 class="gathering-title">Weddings</h3>
                        <p>Make your special day a memorable one.</p>
                    </div>

                    <div class="column gathering-box">
                        <i class="gathering-icon fas fa-glass-cheers fa-4x"></i>
                        <h3 class="gathering-title">Other Celebrations</h3>
                        <p>
                            Entertain the guests at your Celebrations. For all events such as
                            Baby Showers, Wedding Anniversaries etc.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Performances Section-->
    <!--Carousel-->
    <section class="colored-section" id="performances">
        <div class="slideshow-container">
            <div class="mySlide1 fade active container">
                <h2 class="testimonial-text">Bubble Show</h2>
                <div class="text">Performer 1</div>
            </div>
            <div class="mySlide1 fade container">
                <h2 class="testimonial-text">Magic Show</h2>
                <div class="text">Performer 2</div>
            </div>
            <div class="mySlide1 fade container">
                <h2 class="testimonial-text">Musical Performance</h2>
                <div class="text">Performer 2</div>
            </div>
            <a class="prev" onclick="plusSlides(-1,0)">&#10094;</a>
            <a class="next" onclick="plusSlides(1,0)">&#10095;</a>
        </div>
    </section>

    <!--Features Section-->
    <section class="white-section" id="features">
        <div class="container">
            <div class="grid-row">
                <div class="column feature-box">
                    <i class="feature-icon fas fa-check-circle fa-4x"></i>
                    <h3 class="feature-title">Easy to Book.</h3>
                    <p>Book now for Great Performances at your Parties.</p>
                </div>

                <div class="column feature-box">
                    <i class="feature-icon fas fa-bullseye fa-4x"></i>
                    <h3 class="feature-title">Elite Performers</h3>
                    <p>
                        We serve for various individual performers and group performers.
                    </p>
                </div>

                <div class="column feature-box">
                    <i class="feature-icon fas fa-hand-holding-usd fa-4x"></i>
                    <h3 class="feature-title">Reasonable Prices</h3>
                    <p>World Class Entertainment taking care of your Pocket.</p>
                </div>
            </div>
        </div>
    </section>

    <!--Reviews Section-->
    <!--Carousel-->
    <section class="colored-section" id="reviews">
        <div class="container">
            <?php
            $i = 0;
            while ($newrows = mysqli_fetch_assoc($newresult)) { //Fetches user reviews from database and displays them in a table format:
                if ($newrows['rating'] == 5 && $i < 5) { //Only displays reviews of 5 stars.
            ?>
                    <div class="mySlide2 fade container">
                        <h2 class="review-text"><?php echo $newrows['rating']; ?>/5</h2>
                        <h2 class="review-text"><?php echo $newrows['userreview']; ?></h2>
                        <div class="text"><?php echo $newrows['fname']; ?></div>
                    </div>
            <?php
                    $i++;
                }
            }
            ?>
            <a class="prev" onclick="plusSlides(-1,1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1,1)">&#10095;</a>
        </div>
    </section>

    <!-- Pricing -->
    <section class="white-section" id="pricing">
        <h2 class="section-heading">Packages for Every Parties' Needs</h2>
        <p>Simple and affordable price plans for your Parties.</p>
        <div class="container">
            <div class="grid-row">
                <div class="column pricing-column">
                    <div class="display-card">
                        <div class="display-card-header">
                            <h3>Bronze Package</h3>
                        </div>
                        <div class="display-card-body">
                            <h2 class="price-text">$</h2>
                            <p>Any 1 Performance</p>
                            <p>Personalized Greetings</p>
                            <p>*Choose any 1 Performance</p>
                            <p>*You can customize the Greetings.</p>
                            <button type="button" class="dark-button">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>

                <div class="column pricing-column">
                    <div class="display-card">
                        <div class="display-card-header">
                            <h3>Gold Package</h3>
                        </div>
                        <div class="display-card-body">
                            <h2 class="price-text">$</h2>
                            <p>2 Performances</p>
                            <p>Personalized Greetings</p>
                            <p>Kids Show</p>
                            <p>*You can customize the Greetings.</p>
                            <button type="button" class="dark-button">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>

                <div class="column pricing-column">
                    <div class="display-card">
                        <div class="display-card-header">
                            <h3>Diamond Pack</h3>
                        </div>
                        <div class="display-card-body">
                            <h2 class="price-text">$</h2>
                            <p>All 3 Performances</p>
                            <p>Personalized Greetings</p>
                            <p>Kids Show</p>
                            <p>*A Special Surprise Performance</p>
                            <button type="button" class="dark-button">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Tagline-->
    <section class="colored-section" id="tagline">
        <div class="container">
            <h3 class="big-heading">
                Great Performance at your Parties!! Just a Click away.
            </h3>
            <button type="button" class="dark-button">
                Book Now
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="white-section" id="footer">
        <div class="container">
            <i class="footer-icon fab fa-twitter"></i>
            <i class="footer-icon fab fa-facebook-f"></i>
            <i class="footer-icon fab fa-instagram"></i>
            <i class="footer-icon fas fa-envelope"></i>
            <p>© Copyright 2020 PALLAS Entertainment</p>
        </div>
    </footer>
</body>

</html>