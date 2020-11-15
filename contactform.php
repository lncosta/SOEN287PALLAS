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
    -->
    

    <head>
        <style type="text/css">

            body{
                background-image: url(media/images/pattern2.jpg);
            }
            footer{
                background-color: #fff;
            }        
            main{
                color: white;
                padding: 20px;
                font-size: 1.1em;
            }

            .colortext{
                font-size: 2em;
                color: lightcyan;
            }
            form{
                font-size: 1.05em;
                font-family: "Montserrat";
            }
            select{
                border-radius: 10px;
                border: 2px solid whitesmoke;
                font-size: 1.05em;
                font-family: "Montserrat";
            }
            .quote{
                border: 5px solid whitesmoke;
                text-align: left;
                padding: 20px;
                margin: 15px;
            }

            input, textarea{
                border-radius: 10px;
                font-size: 1em;
                border: 2px solid whitesmoke;
                font-family: "Montserrat";
            }


            .submitbutton{
                border-radius: 10px;
                border: 2px solid whitesmoke;
                font-size: 1.1em;
                font-family: "Montserrat";
            }

            .close{
                text-align: right;
            }

            .modal-title{
                color: black;
            }

            td.tdclosebutton{
                margin-left: 2em;
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

            function getQuote(){
                var totalQuote = 0;

                var eventType = document.getElementById("eventtypes").value;
                var priceMultiplier = 1;
                if(eventType == "intimate"){
                    priceMultiplier = 1;
                }
                else if(eventType == "medium"){
                    priceMultiplier = 2;
                }
                else if(eventType == "large"){
                    priceMultiplier = 3;
                }
                else if(eventType == "public"){
                    priceMultiplier = 4;
                }
                var performancesMultiplier = 55;
                var counter = 0;
                if (document.getElementById("abubbles").checked == true){
                    performancesMultiplier+= 10;
                    counter++;
                }
                if (document.getElementById("acontorsion").checked == true){
                    performancesMultiplier+= 10;
                    counter++;
                }
                if (document.getElementById("amagic").checked == true){
                    performancesMultiplier+= 10;
                    counter++;
                }
                if (document.getElementById("amusic").checked == true){
                    performancesMultiplier+= 10;
                    counter++;
                }

                totalQuote = priceMultiplier*performancesMultiplier;
                if (document.getElementById("bgreeting").checked == true){
                    totalQuote+= 100;
                }
                if (document.getElementById("bkids").checked == true){
                    totalQuote+= 500;
                }
                if (document.getElementById("bmc").checked == true){
                    totalQuote+= 500;
                }
                if(counter == 0){
                    alert("Please select one of our performances before proceeding.");
                }
                else{
                    //alert("The total quote for your event is estimated to be $"+ totalQuote+".00");
                    document.getElementById("quoteRequestResult").innerHTML = "The total quote for your event is estimated to be $"+ totalQuote+".00";
                    document.getElementById("quote").value = totalQuote;
                    
                    showModal();
                }
            }

            function validateForm(){
                if (document.getElementById("fname").value == ""){
                    return false;
                }
                if (document.getElementById("lname").value == ""){
                    return false;
                }
                if (document.getElementById("email").value == ""){
                    return false;
                }
                if (document.getElementById("phone").value == ""){
                    return false;
                }
                if (document.getElementById("eventdate").value == null){
                    return false;
                }
                return true;
            }

            function reviewForm(){
                if (validateForm()){
                    getQuote();
                }
                else{
                    alert("Please make sure that all form elements are filled adequately.");
                }
            }

            function submitQuote(){
                document.forms["myform"].submit();
                alert("Quote has been sumitted");
            }
        </script>

    <meta charset="utf-8" />

    <script type="text/javascript" src="script.js"></script>

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
    
    <main>
        <h1>Contact us!</h1>
        <p class="colortext">Fill in the form below for a quote estimation, or send us a message in one of our many channels.</p>

        <div class ="quote">
            <form id="myform" action="saveform.php" method="post">
                <label>Name:</label>
                <input type="text" id="fname" name="fname" placeholder="First Name"/>
                <input type="text" id="lname" name="lname" placeholder="Last Name"/>
                <br/>
                <br/>
                <label>Email Address:</label>
                <input type="text" id="email" name="email" placeholder="email@address.com"/>
                <br/>
                <br/>
                <label>Phone Number:</label>
                <input type="number" id="phone" name="phone" placeholder="123-456-7890"/>
                <br/>
                <br/>
                <label>Event Date:</label> <!--Check if available-->
                <input type="date" id="eventdate" name="date"/>
                <br/>
                <br/>
                <label>Event Type:</label>
                <select name="eventtype" id="eventtypes">
                    <option value="intimate">Intimate - birthdays, family celebrations, or less than 10 people</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                    <option value="public">Public</option>
                </select>
                <br/>
                <br/>
                <label>Budget:</label>
                <input type="number" id="budget" name="budget"min="1" step="any" placeholder="$$$.$$"/>
                <br/>
                <br/>
                <label>Check which of our acts you want us to perform:</label> 
                <br/>
                <label><input type="checkbox" name="performances[]" id="abubbles" value="Bubbles"/> Bubble Blowing</label>
                <br/>
                <label><input type="checkbox" name="performances[]" id="acontorsion" value="Contorsion"/> Contorsion</label>
                <br/>
                <label><input type="checkbox" name="performances[]" id="amagic" value="Magic"/> Magic Show</label>
                <br/>
                <label><input type="checkbox" name="performances[]" id="amusic" value="Music"/> Musical Performance</label>
                <br/>
                <br/>
                <label>Optional Services:</label>
                <br/>
                <label><input type="checkbox" name="options[]" id="bgreeting" value="PersonalizedGreeting"/> Personalized Greeting </label>
                <br/>
                <label><input type="checkbox" name="options[]" id="bkids" value="KidsSpecialPackage"/> Kids Special Package</label>
                <br/>
                <label><input type="checkbox" name="options[]" id="bmc" value="MC"/> MC - Master of Cerimonies</label>
                <br/>
                <br/>
                <label>Additional Information:</label>
                <br/>
                <textarea id="addinfo" name="message" rows=4 cols="50" placeholder="Please add any additional requests or considerations here"></textarea>
                <br/>
                <br/>
                <input type="hidden" name="quote" id="quote" value=""/>
                <button type="button" name="submitForm" onclick="reviewForm()" class="submitbutton">Request Quote </button>
                <input type="reset" class="submitbutton">
            </form>
            <br/>
            <br/>
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
                <button type="button" name = "submitForm2" class="submitbutton" onclick="">Book Now!</button>
                <button type="button" name = "submitForm" class="submitbutton" onclick="submitQuote()">Request Quota via Email and Close.</button>
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
