<?php
    require "header.php";
    //0should include the following into the sign up page
    //<a href="reset-password.php">Forgot your Password?</a> 
    ?>

    <main>
        <div class="wrapper-main">
            <section class="section-default">
                <h1>Reset your password</h1>
                <p>Ab e-mail will be send to you with instructions on how to reset your password.</p>
                <form action="includes/reset-request.inc.php" method="post">
                <input type="text" name="email" placeholder="Enter your e-mail address.">
                <button type="submit" name="reset-request-submit">Receive new password by e-mail</button>

                </form>
                <?php
                if (isset($_GET["reset"])){
                    if($_GET["reset"]=="success"){
                        echo '<p class="signupsuccess">Check your e-mail!</p>';
                    }
                }
                ?>
            </section>
        </div>
    </main>

<?php

    require "footer.php";
    ?>